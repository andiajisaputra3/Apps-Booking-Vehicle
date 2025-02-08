<?php

namespace App\Http\Controllers;

use App\Models\BookingHistories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $histories = BookingHistories::selectRaw('
            MONTH(booking_date) as month,
            MONTHNAME(booking_date) as month_name,
            SUM(CASE WHEN overall_approval_status = "approved" THEN 1 ELSE 0 END) as approved_count,
            SUM(CASE WHEN overall_approval_status = "rejected" THEN 1 ELSE 0 END) as rejected_count,
            COUNT(*) as count
            ')
            ->whereYear('booking_date', date('Y'))
            ->groupByRaw('MONTH(booking_date), MONTHNAME(booking_date)')
            ->orderByRaw('MONTH(booking_date)')
            ->get();

        $months = collect([
            "January" => ['count' => 0, 'approved_count' => 0, 'rejected_count' => 0],
            "February" => ['count' => 0, 'approved_count' => 0, 'rejected_count' => 0],
            "March" => ['count' => 0, 'approved_count' => 0, 'rejected_count' => 0],
            "April" => ['count' => 0, 'approved_count' => 0, 'rejected_count' => 0],
            "May" => ['count' => 0, 'approved_count' => 0, 'rejected_count' => 0],
            "June" => ['count' => 0, 'approved_count' => 0, 'rejected_count' => 0],
            "July" => ['count' => 0, 'approved_count' => 0, 'rejected_count' => 0],
            "August" => ['count' => 0, 'approved_count' => 0, 'rejected_count' => 0],
            "September" => ['count' => 0, 'approved_count' => 0, 'rejected_count' => 0],
            "October" => ['count' => 0, 'approved_count' => 0, 'rejected_count' => 0],
            "November" => ['count' => 0, 'approved_count' => 0, 'rejected_count' => 0],
            "December" => ['count' => 0, 'approved_count' => 0, 'rejected_count' => 0],
        ]);

        foreach ($histories as $item) {
            $months[$item->month_name] = [
                'count' => $item->count,
                'approved_count' => $item->approved_count,
                'rejected_count' => $item->rejected_count,
            ];
        }

        $chartData = $months->map(function ($data, $month) {
            return [
                'month_name' => \Carbon\Carbon::parse($month)->format('M'), // "January" -> "Jan"
                'count' => $data['count'],
                'approved_count' => $data['approved_count'],
                'rejected_count' => $data['rejected_count'],
            ];
        })->values();

        return view('dashboard.index', compact('chartData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}