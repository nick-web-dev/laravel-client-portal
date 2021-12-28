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
            $saveAsModalTitle = [
                'inventory' => 'Save As New Inventory Report',
                'sales-orders' => 'Save As New Sales Orders Report',
                'returns' => 'Save As New Returns Report',
            ][$reportType];

            return view('reports.show', [
                'saveUrl'   => $saveUrl,
                'createUrl' => $createUrl,
                'saveAsModalTitle' => $saveAsModalTitle,
            ]);
        } catch (\Exception $e) {

            return redirect()->route('reports.index');
        }

    }

    public function save($reportType, $reportId, Request $request)
    {
        $data = $request->all();
        return response()->json('done');
    }

    public function create($reportType, Request $request)
    {
        $data = $request->all();
        return response()->json('done');
    }
}
