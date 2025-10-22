<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'spin_id',
        'manager_spin_id',
        'result',
        'spin_time'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function spin()
    {
        return $this->belongsTo(Spin::class);
    }

    public function managerSpin()
    {
        return $this->belongsTo(ManagerSpin::class);
    }
}
