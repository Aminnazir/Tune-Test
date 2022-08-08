<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserLogs;
use Illuminate\Database\Seeder;
use File;

class UserLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserLogs::truncate();

        $json = File::get("database/data/logs.json");
        $usersLogs = json_decode($json);

        foreach ($usersLogs as $key => $value) {
            UserLogs::create([
                "type" => $value->type,
                "user_id" => $value->user_id,
                "revenue" => $value->revenue,
                "created_at" => $value->time,
            ]);
        }
    }
}
