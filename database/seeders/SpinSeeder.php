<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SpinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('manager_spins')->insert([
            [
                'name' => '+ 20.000đ',
                'reward' => 20000,
                'rate' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '+ 77.777đ',
                'reward' => 77777,
                'rate' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '+ 6.666đ',
                'reward' => 6666,
                'rate' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '+ 222.222đ',
                'reward' => 222222,
                'rate' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '+ 22.000đ',
                'reward' => 22000,
                'rate' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '+ 1.000.000đ',
                'reward' => 1000000,
                'rate' => 0.1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '+ 11.111đ',
                'reward' => 11111,
                'rate' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '+ 99.999đ',
                'reward' => 99999,
                'rate' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '+ 30.000đ',
                'reward' => 30000,
                'rate' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '+ 500.000đ',
                'reward' => 500000,
                'rate' => 0.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '+ 100.000đ',
                'reward' => 100000,
                'rate' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '+ 100đ',
                'reward' => 100,
                'rate' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '+ 2.000đ',
                'reward' => 2000,
                'rate' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '+ 50.000đ',
                'reward' => 50000,
                'rate' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '+ 10.000đ',
                'reward' => 10000,
                'rate' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
