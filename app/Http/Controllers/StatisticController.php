<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistic;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Thống kê tổng quát
        $totalSpins = Statistic::count();
        $totalUsers = Statistic::whereNotNull('user_id')->distinct('user_id')->count();

        // Thống kê theo phần thưởng
        $prizeStats = Statistic::select('result', DB::raw('count(*) as total'))
            ->groupBy('result')
            ->get();

        // Thống kê theo thời gian (7 ngày gần nhất)
        $dailyStats = Statistic::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->whereBetween('created_at', [now()->subDays(7), now()])
            ->groupBy('date')
            ->get();

        return view('statistics.index', compact('totalSpins', 'totalUsers', 'prizeStats', 'dailyStats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $statistic = Statistic::with(['user', 'spin', 'managerSpin'])->findOrFail($id);
        return view('statistics.show', compact('statistic'));
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
    }
}
