<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\RemarkRequest;
use App\Http\Controllers\Controller;
use App\Remark;
use App\CGI2G_CJ;
use App\CGI3G_CJ;
use DB, Input, Response, Auth, Redirect, Session, Carbon;
use Excel;

class RemarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $remark = remark::all();
        return view('admin.remark.index', compact('remark'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //POC_NAME
        $CLUSTER_BICC_CJ = DB::table('CLUSTER_BICC_CJ')->select('POC_NAME')->distinct()->get();

        return view('admin.remark.create', compact('CLUSTER_BICC_CJ'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $remarks = new Remark();
        $remarks->bscrnc = Input::get('bscrnc');
        $remarks->cell = Input::get('cell');
        $remarks->area = Input::get('area');
        $remarks->kpi = Input::get('kpi');
        $remarks->kategori = Input::get('kategori');
        $remarks->date_ex = Input::get('datex');
        $remarks->date_close = Input::get('datec');
        $remarks->remark = Input::get('remark');
        $remarks->status = Input::get('status');
        $remarks->created_by = Auth::user()->name;
        $remarks->save();

        return redirect('remark');
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
        $remark = remark::findOrFail($id);
        $CLUSTER_BICC_CJ = DB::table('CLUSTER_BICC_CJ')->select('POC_NAME')->distinct()->get();

        return view('admin.remark.edit', compact('remark', 'CLUSTER_BICC_CJ'));
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
        $remark = Remark::find($id);
        $remark->bscrnc = Input::get('bscrnc');
        $remark->cell = Input::get('cell');
        $remark->area = Input::get('area');
        $remark->kpi = Input::get('kpi');
        $remark->kategori = Input::get('kategori');
        $remark->date_ex = date("y-m-d", strtotime(Input::get('datex')));
        $remark->date_close = date("y-m-d", strtotime(Input::get('datec')));
        $remark->remark = Input::get('remark');
        $remark->status = Input::get('status');
        $getUser = Auth::user()->name;
        $remark->update_by = $getUser;
        $remark->save();

        return redirect('remark');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        remark::destroy($id);

        return redirect('remark');
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
        return view('admin.remark.excel');
    }

    public function uploadExcel()
    {
        try
        {
            Excel::load(Input::file('file'), function($reader) {
                $reader->each(function($sheet) {
                    foreach ($sheet->toArray() as $row) {
                        Remark::firstOrCreate($row);
                    }
                });
            });
            Session::flash('message', 'Import File telah sukses.');
            return Redirect::to('remark');
        }
        catch (\Exception $e)
        {
            Session::flash('message', 'Import File Error');//$e->getMessage()
            Session::flash('alert-class', 'alert-danger');
            return Redirect::to('import/remark');
        }
    }

    public function downloadSample()
    {
        return Redirect::to('/file/remark.xls');
    }

    public function lineChart()
    {
        $capacity = Remark::select(DB::raw('count(*) as capacity'))
            ->where('kategori', '=', 'capacity')
            ->where('status', '=', 'on progress')
            //->whereMonth('date_ex', '=', date('m'))
            ->whereDay('date_ex', '=', date('d'))
            //->whereDay('date_ex', '=', date('d'))
            ->orderBy('date_ex')
            //->groupBy('kategori')
            ->groupBy(DB::raw("day(date_ex)"))
            ->get()->toArray();
        $capacity = array_column($capacity, 'capacity');

        $core = Remark::select(DB::raw('count(*) as core'))
            ->where('kategori', '=', 'core')
            ->where('status', '=', 'on progress')
            //->whereMonth('date_ex', '=', date('m'))
            ->whereDay('date_ex', '=', date('d'))
            //->whereDay('date_ex', '=', date('d'))
            ->orderBy('date_ex')
            //->groupBy('kategori')
            //->groupBy(DB::raw("month(date_ex)"))
            ->groupBy(DB::raw("day(date_ex)"))
            ->get()->toArray();
        $core = array_column($core, 'core');

        $coverage = Remark::select(DB::raw('count(*) as coverage'))
            ->where('kategori', '=', 'coverage')
            ->where('status', '=', 'on progress')
            //->whereMonth('date_ex', '=', date('m'))
            ->whereDay('date_ex', '=', date('d'))
            //->whereDay('date_ex', '=', date('d'))
            ->orderBy('date_ex')
            //->groupBy('kategori')
            //->groupBy(DB::raw("month(date_ex)"))
            ->groupBy(DB::raw("day(date_ex)"))
            ->get()->toArray();
        $coverage = array_column($coverage, 'coverage');

        $hardware = Remark::select(DB::raw('count(*) as hardware'))
            ->where('kategori', '=', 'HARDWARE/INSTALLATION/ALARM')
            ->where('status', '=', 'on progress')
            //->whereMonth('date_ex', '=', date('m'))
            ->whereDay('date_ex', '=', date('d'))
            //->whereDay('date_ex', '=', date('d'))
            ->orderBy('date_ex')
            //->groupBy('kategori')
            //->groupBy(DB::raw("month(date_ex)"))
            ->groupBy(DB::raw("day(date_ex)"))
            ->get()->toArray();
        $hardware = array_column($hardware, 'hardware');

        $transmission = Remark::select(DB::raw('count(*) as transmission'))
            ->where('kategori', '=', 'transmission')
            ->where('status', '=', 'on progress')
            //->whereMonth('date_ex', '=', date('m'))
            ->whereDay('date_ex', '=', date('d'))
            //->whereDay('date_ex', '=', date('d'))
            ->orderBy('date_ex')
            //->groupBy('kategori')
            //->groupBy(DB::raw("month(date_ex)"))
            ->groupBy(DB::raw("day(date_ex)"))
            ->get()->toArray();
        $transmission = array_column($transmission, 'transmission');

//        $date = Remark::select('date_ex as date')
//                ->whereMonth('date_ex', '=', date('m'))
//                ->orderBy('date_ex')
//                ->groupBy(DB::raw("day(date_ex)"))
//                ->get()->toArray();
//        $date = array_column($date, 'date');

        return view('admin.index')
            ->with('capacity',json_encode($capacity,JSON_NUMERIC_CHECK))
            ->with('core',json_encode($core,JSON_NUMERIC_CHECK))
            ->with('coverage',json_encode($coverage,JSON_NUMERIC_CHECK))
            ->with('hardware',json_encode($hardware,JSON_NUMERIC_CHECK))
            ->with('transmission',json_encode($transmission,JSON_NUMERIC_CHECK));
//            ->with('date',json_encode($date,JSON_NUMERIC_CHECK));
    }

    public function reportRemark()
    {
        $from = '2016-08-03';
        $to = Input::get('to');
        
            Excel::create('Report Remark Data', function($excel) use ($from, $to) {
            // Set the title
            $excel->setTitle('Report Remark Data');
            // Chain the setters
            $excel->setCreator('Abid Muhamad Ismi')
                ->setCompany('AerWork');
            // Call them separately
            $excel->setDescription('Report Remark Data');

            $excel->sheet('Report Remark Data', function ($sheet) use ($from, $to) {
            // $from = Input::get('from');
            // $to = Input::get('to');
                // $reportRemark = DB::table('optimcj_remarks')
                //     ->select('bscrnc', 'cell', 'area', 'kpi', 'kategori', 'date_ex', 'date_close', 'remark', 'status')
                //     ->whereBetween('date_ex', ['$from','$to'])
                //     ->get();
                $reportRemark = DB::select("SELECT bscrnc, cell, area, kpi, kategori, date_ex, date_close, remark, status, created_by, update_by FROM optimcj_remarks WHERE date_ex BETWEEN '$from' AND '$to' ORDER BY date_ex ASC");
                $column = array(
                    'BSCRNC',
                    'Cell',
                    'Area',
                    'KPI',
                    'Kategori',
                    'Date Executed',
                    'Date Close',
                    'Remark',
                    'Status'
                );

                $sheet->appendRow($column);

                // getting last row number (the one we already filled and setting it to bold
                $sheet->row($sheet->getHighestRow(), function ($row) {
                    $row->setFontWeight('bold');
                });

                // putting customers data as next rows
                foreach ($reportRemark as $value) {
                    $sheet->appendRow(array(
                        $value->bscrnc,
                        $value->cell,
                        $value->area,
                        $value->kpi,
                        $value->kategori,
                        $value->date_ex,
                        $value->date_close,
                        $value->remark,
                        $value->status
                    ));
                }
            });            
        })->export('xls');
        
    }
}
