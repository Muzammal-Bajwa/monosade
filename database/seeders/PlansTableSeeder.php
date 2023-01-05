<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name' => 'Free Plan',
            'trial_days' => 7,
            'max_workspaces' => 1,
            'max_users' => 5,
            'max_clients' => 5,
            'max_projects' => 5,
            'image' => 'free_plan.png',
            'status' => 1,
        ]);
    }
}
