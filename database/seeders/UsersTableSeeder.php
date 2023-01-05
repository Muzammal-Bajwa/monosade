<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Workspace;
use App\Models\Utility;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = User::create([
                                      'name' => 'Admin',
                                      'email' => 'admin@example.com',
                                      'password' => Hash::make('1234'),
                                      'type' => 'admin',
                                  ] );

     User::defaultEmail();
   
        

    }
}


