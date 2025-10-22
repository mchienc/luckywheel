<?php

namespace App\Repositories;

use App\Models\ManagerSpin;
use App\Models\Spin;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SpinRepository
{
    /**
     * Get member collection paginate.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */

    public function getAll()
    {
        return Spin::orderBy('created_at', 'desc');
    }

    public function getSpin()
    {
        return ManagerSpin::where('status', 'show')->get();
    }

    public function getRandomWeightedElement($weightedValues)
    {
        $rand = mt_Rand(1, (int) array_sum($weightedValues));
        foreach ($weightedValues as $key => $value) {
            $rand -= $value;
            if ($rand <= 0) {
                return $key;
            }
        }
    }

    public function store($content)
    {
        $spin_history = new Spin();
        $spin_history->reward = $content;
        $spin_history->save();
    }

    public function timeAgo($time_ago)
    {
        $time_ago   = strtotime($time_ago);
        $cur_time   = Carbon::now()->timestamp;
        $time_elapsed   = $cur_time - $time_ago;
        $seconds    = $time_elapsed ;
        $minutes    = round($time_elapsed / 60);
        $hours      = round($time_elapsed / 3600);
        $days       = round($time_elapsed / 86400);
        $weeks      = round($time_elapsed / 604800);
        $months     = round($time_elapsed / 2600640);
        $years      = round($time_elapsed / 31207680);
        // Seconds
        if ($seconds <= 60) {
            return "$seconds ".'giây trước';
        }
        //Minutes
        elseif ($minutes <= 60) {
            return "$minutes ".'phút trước';
        }
        //Hours
        elseif ($hours <= 24) {
            return "$hours ".'giờ trước';
        }
        //Days
        elseif ($days <= 7) {
            if ($days == 1) {
                return 'Hôm qua';
            } else {
                return "$days ".'ngày trước';
            }
        }
        //Weeks
        elseif ($weeks <= 4.3) {
            return "$weeks ".'tuần trước';
        }
        //Months
        elseif ($months <= 12) {
            return "$months ".'tháng trước';
        }
        //Years
        else {
            return "$years ".'năm trước';
        }
    }
}
