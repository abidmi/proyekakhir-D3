<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Antena;
use App\CGI2G_CJ;
use App\CGI3G_CJ;
use DB, Input, Response, Auth, Redirect, Session;
use Excel;

class AntenaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $antena = antena::all();
        return view('admin.antena.index', compact('antena'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.antena.create');
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
        $antenas = new Antena();
        $antenas->bscrnc = Input::get('bscrnc');
        $antenas->siteid = Input::get('siteid');
        $antenas->cell = Input::get('cell');
        $antenas->mech = Input::get('mech');
        $antenas->elec = Input::get('elec');
        $antenas->tot = Input::get('tot');
        $antenas->dir = Input::get('dir');
        $antenas->height = Input::get('height');
        $antenas->bw = Input::get('bw');
        $antenas->type = Input::get('type');
        $antenas->save();

        return redirect('antena');
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
        $antena = antena::findOrFail($id);

        return view('admin.antena.edit', compact('antena'));
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
        $antenas = Antena::find($id);
        $antenas->bscrnc = Input::get('bscrnc');
        $antenas->siteid = Input::get('siteid');
        $antenas->cell = Input::get('cell');
        $antenas->mech = Input::get('mech');
        $antenas->elec = Input::get('elec');
        $antenas->tot = Input::get('tot');
        $antenas->dir = Input::get('dir');
        $antenas->height = Input::get('height');
        $antenas->bw = Input::get('bw');
        $antenas->type = Input::get('type');
        $antenas->save();

        return redirect('antena');
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
        antena::destroy($id);

        return redirect('antena');
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

    public function autocompleteCELL()
    {
        $term = Input::get('term');
        $result = array();
        $CGI2G_CJ = DB::table('CGI2G_CJ')->select('CELL as CELLS')->distinct()->where('CELL', 'LIKE', '%'.$term.'%')->orWhere('SITE_ID', 'LIKE', '%'.$term.'%')->take(10);
        $CGI3G_CJ = DB::table('CGI3G_CJ')->select('UTRANCELL as CELLS')->distinct()->where('UTRANCELL', 'LIKE', '%'.$term.'%')->orWhere('SITE_ID', 'LIKE', '%'.$term.'%')->take(10);
        $cell =  $CGI2G_CJ->union($CGI3G_CJ)->get();

        foreach($cell as $query)
        {
            $result[] = ['value' => $query->CELLS];
        }

        return Response::json($result);
    }

    public function importExcel()
    {
        return view('admin.antena.excel');
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
                            if(DB::table('optimcj_antenas')->where(array('bscrnc' => $row['bscrnc'] , 'siteid' => $row['siteid']))->first()){
                                DB::table('optimcj_antenas')->where(array('bscrnc' => $row['bscrnc'] , 'siteid' => $row['siteid']))->update($row);
                            }else{
                                DB::table('optimcj_antenas')->insert($row);
                            }

                            //Site::updateOrCreate(array('bscrnc'=>$row['bscrnc'], 'siteid' => $row['siteid']) , $row);
                        }
                    }
                    //die();
                });
            });
            Session::flash('message', 'Import File telah sukses.');
            return Redirect::to('antena');
        }
        catch (\Exception $e)
        {
            Session::flash('message', 'Import File Error');//$e->getMessage()
            Session::flash('alert-class', 'alert-danger');
            return Redirect::to('import/antena');
        }
    }

    public function downloadSample()
    {
        return Redirect::to('/file/antena.xls');
    }
}
