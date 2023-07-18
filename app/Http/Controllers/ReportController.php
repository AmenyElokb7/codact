<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    function CreateReport(Request $request)
    {
        $report = Report::create([
            'message' => $request->input('message'),
        ]);
        return redirect()->back();

    }
        
    //
}
