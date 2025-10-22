<?php

namespace App\Http\Controllers;

use App\Models\Spin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index()
    {
        // Tổng số lượt quay
        $totalSpins = Spin::count();
        
        // Tổng số người chơi
        $totalUsers = User::count();
        
        // Thống kê phần thưởng
        $prizeStats = Spin::select('reward as result', DB::raw('count(*) as total'))
            ->groupBy('reward')
            ->orderBy('total', 'desc')
            ->get()
            ->map(function($item) {
                return (object)[
                    'result' => $item->result,
                    'total' => $item->total
                ];
            });
            
        // Lượt quay 30 ngày gần nhất cho biểu đồ đường
        $dailyStats = Spin::select(
                DB::raw('DATE(created_at) as date'), 
                DB::raw('count(*) as total')
            )
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date', 'asc') // Sắp xếp tăng dần cho biểu đồ
            ->get();

        // Chuẩn bị dữ liệu cho biểu đồ
        $chartData = [
            'labels' => $dailyStats->pluck('date')->map(function($date) {
                return date('d/m', strtotime($date));
            }),
            'spins' => $dailyStats->pluck('total'),
        ];

        // Thống kê theo giờ trong ngày
        $hourlyStats = Spin::select(
                DB::raw('HOUR(created_at) as hour'), 
                DB::raw('count(*) as total')
            )
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('hour')
            ->orderBy('hour', 'asc')
            ->get();

        // Chuẩn bị dữ liệu biểu đồ theo giờ
        $hourlyData = array_fill(0, 24, 0); // Khởi tạo mảng 24 giờ với giá trị 0
        foreach ($hourlyStats as $stat) {
            $hourlyData[$stat->hour] = $stat->total;
        }

        // Lấy 7 ngày gần nhất cho bảng
        $recentDailyStats = $dailyStats->take(-7)->map(function($item) {
            $item->date = date('d/m/Y', strtotime($item->date));
            return $item;
        });

        return view('statistics.index', compact(
            'totalSpins',
            'totalUsers',
            'prizeStats',
            'recentDailyStats',
            'chartData',
            'hourlyData'
        ));
    }
}