<?php

namespace App\Http\Controllers;

use App\Services\Rushmore;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(Rushmore $api)
    {
        //$reports = $api->getReports();
        return view('reports.index');
    }

    public function show($reportType, $reportId, Rushmore $api)
    {
        try {
            //get data by id and type or fire exception and redirect to index?
            //$reportConfig = $api->getReportConfig($reportType, $reportId);
            //$reportData = $api->getReportConfig($reportType, $reportId);
            $createUrl = route('reports.create', ['reportType' => $reportType]);
            $saveUrl = route('reports.save', ['reportType' => $reportType, $reportId => $reportId]);

            return view('reports.show', [
                'saveUrl'   => $saveUrl,
                'createUrl' => $createUrl,
            ]);
        } catch (\Exception $e) {

            return redirect()->route('reports.index');
        }

    }

    public function save($reportType, $reportId)
    {
        return view('reports.show');
    }

    public function create($reportType)
    {
        return view('reports.show');
    }
}
