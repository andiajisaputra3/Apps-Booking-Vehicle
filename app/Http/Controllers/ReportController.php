<?php

namespace App\Http\Controllers;

use App\Models\BookingHistories;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $reports = BookingHistories::orderBy('created_at', 'desc')->get();

        return view('reports.index', compact('reports'));
    }
}
