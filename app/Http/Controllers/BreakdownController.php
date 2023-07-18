<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Breakdown;



class BreakdownController extends Controller
{
    function BreakdownAlert(Request $request)
    {
        $BreakdownAlert = Breakdown::create([
            'reference' => $request->input('reference'),
            'message' => $request->input('message'),
        ]);
        return redirect()->back();

    }
}
