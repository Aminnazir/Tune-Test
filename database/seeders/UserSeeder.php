<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use File;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $json = File::get("database/data/users.json");
        $users = json_decode($json);

        foreach ($users as $key => $value) {
            User::create([
                "id" => $value->id,
                "name" => $value->name,
                "avatar" => $value->avatar,
                "occupation" => $value->occupation,
                "email" => "fake".$key."@fakedomain.com",
                "password" => bcrypt($value->name),
            ]);
        }
    }
}
