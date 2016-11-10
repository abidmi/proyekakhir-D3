<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Site;
use App\Antena;
use App\CGI2G_CJ;
use App\CGI3G_CJ;
use DB, Input, Response, Auth, Redirect, Session, View;
use Excel;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $site = site::all();
        return view('admin.site.index', compact('site'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.site.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $sites = new site();
        $sites->bscrnc = Input::get('bscrnc');
        $sites->siteid = Input::get('siteid');
        $sites->sitename = Input::get('sitename');
        $sites->longitude = Input::get('long');
        $sites->latitude = Input::get('lat');
        $sites->celltype = Input::get('celltype');
        $sites->mbc = Input::get('mbc');
        $sites->collsite = Input::get('coll');
        $sites->save();

        return redirect('site');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $site = site::findOrFail($id);

        return view('admin.site.edit', compact('site'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $sites = Site::find($id);
        $sites->bscrnc = Input::get('bscrnc');
        $sites->siteid = Input::get('siteid');
        $sites->sitename = Input::get('sitename');
        $sites->longitude = Input::get('long');
        $sites->latitude = Input::get('lat');
        $sites->celltype = Input::get('celltype');
        $sites->mbc = Input::get('mbc');
        $sites->collsite = Input::get('coll');
        $sites->save();

        return redirect('site');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        site::destroy($id);

        return redirect('site');
    }

    public function completeSite()
    {
        $site = DB::table('optimcj_sites')
                ->join('optimcj_antenas', function($join)
                {
                    $join->on('optimcj_antenas.bscrnc', '=', 'optimcj_sites.bscrnc')
                        ->on('optimcj_antenas.siteid', '=', 'optimcj_sites.siteid');
                })
                ->get();
        return view('admin.site.comsite', compact('site'));
    }

    public function autocompleteBSC()
    {
        $term = Input::get('term');
        $result = array();
        $CGI2G_CJ = DB::table('CGI2G_CJ')->select('BSC as BSCRNC')->distinct()->where('BSC', 'LIKE', '%'.$term.'%')->orWhere('SITE_ID', 'LIKE', '%'.$term.'%')->take(10);
        $CGI3G_CJ = DB::table('CGI3G_CJ')->select('RNC as BSCRNC')->distinct()->where('RNC', 'LIKE', '%'.$term.'%')->orWhere('SITE_ID', 'LIKE', '%'.$term.'%')->take(10);
        $bscrnc =  $CGI2G_CJ->union($CGI3G_CJ)->get();

        foreach($bscrnc as $query)
        {
            $result[] = ['value' => $query->BSCRNC];
        }

        return Response::json($result);
    }

    public function autocompleteSITE()
    {
        $term = Input::get('term');
        $result = array();
        $CGI2G_CJ = DB::table('CGI2G_CJ')->select('SITE_ID as SID')->distinct()->where('SITE_ID', 'LIKE', '%'.$term.'%')->take(10);
        $CGI3G_CJ = DB::table('CGI3G_CJ')->select('SITE_ID as SID')->distinct()->where('SITE_ID', 'LIKE', '%'.$term.'%')->take(10);
        $site =  $CGI2G_CJ->union($CGI3G_CJ)->get();

        foreach($site as $query)
        {
            $result[] = ['value' => $query->SID];
        }

        return Response::json($result);
    }

    public function importExcel()
    {
        return view('admin.site.excel');
    }

    public function uploadExcel()
    {
        try
        {
            Excel::load(Input::file('file'), function($reader) {
                $reader->each(function($sheet) {
                    $s = $sheet->toArray();
                    foreach ($s as $row) {
//                        Site::firstOrCreate($row);
                        if($row['bscrnc'] != '' &&  $row['siteid']!=''){
                            if(DB::table('optimcj_sites')->where(array('bscrnc' => $row['bscrnc'] , 'siteid' => $row['siteid']))->first()){
                                DB::table('optimcj_sites')->where(array('bscrnc' => $row['bscrnc'] , 'siteid' => $row['siteid']))->update($row);
                            }else{
                                DB::table('optimcj_sites')->insert($row);
                            }

                            //Site::updateOrCreate(array('bscrnc'=>$row['bscrnc'], 'siteid' => $row['siteid']) , $row);
                        }
                    }
                    //die();
                });
            });
            Session::flash('message', 'Import File telah sukses.');
            return Redirect::to('site');
        }
        catch (\Exception $e)
        {
            Session::flash('message', 'Import File Error : '.$e->getMessage());//$e->getMessage()
            Session::flash('alert-class', 'alert-danger');
            //dd($e);
            return Redirect::to('import/site');
        }
    }

    public function downloadSample()
    {
        return Redirect::to('/file/site.xls');
    }
}
