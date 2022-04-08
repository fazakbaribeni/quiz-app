<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $admin = new  User();
        $admin->name = "admin";
        $admin->email = "admin@test.com";
        $admin->password = bcrypt("password");
        $admin->email_verified_at = NOW();
        $admin->is_admin = 1;
        $admin->phone = "01126 222145";
        $admin->save();
    }
}
