<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Antena, Site;
Use Excel, DB;


class ExportFileController extends Controller
{
    public function doExport()
    {
        Excel::create('Complete Site', function($excel) {
            // Set the title
            $excel->setTitle('Complete Site');
            // Chain the setters
            $excel->setCreator('Abid Muhamad Ismi')
                ->setCompany('AerWork');
            // Call them separately
            $excel->setDescription('Export data complete site ke excel');

            $excel->sheet('ComSite', function ($sheet) {

                $site = DB::table('optimcj_sites')
                    ->join('optimcj_antenas', function($join)
                    {
                        $join->on('optimcj_antenas.bscrnc', '=', 'optimcj_sites.bscrnc')
                            ->on('optimcj_antenas.siteid', '=', 'optimcj_sites.siteid');
                    })
                    ->get();

                $column = array(
                    'BSCRNC',
                    'SiteID',
                    'Site Name',
                    'Longitude',
                    'Latitude',
                    'Cell Type',
                    'MBC',
                    'Collocated Site',
                    'Ant Mech',
                    'Ant Ele',
                    'Ant Tot',
                    'Ant Dir',
                    'Ant Height',
                    'Ant BW',
                    'Ant Type'
                );

                $sheet->appendRow($column);

                // getting last row number (the one we already filled and setting it to bold
                $sheet->row($sheet->getHighestRow(), function ($row) {
                    $row->setFontWeight('bold');
                });

                // putting customers data as next rows
                foreach ($site as $value) {
                    $sheet->appendRow(array(
                        $value->bscrnc,
                        $value->siteid,
                        $value->sitename,
                        $value->longitude,
                        $value->latitude,
                        $value->celltype,
                        $value->mbc,
                        $value->collsite,
                        $value->mech,
                        $value->elec,
                        $value->tot,
                        $value->dir,
                        $value->height,
                        $value->bw,
                        $value->type
                    ));
                }
            });

        })->export('xls');
    }
}
