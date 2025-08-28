<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Basic',
                'type' => 'agency',
                'price' => 99.00,
                'duration_days' => 30,
                'max_agents' => 5,
                'is_active' => true
            ],
            [
                'name' => 'Premium',
                'type' => 'agency',
                'price' => 199.00,
                'duration_days' => 30,
                'max_agents' => 15,
                'is_active' => true
            ],
            [
                'name' => 'Pro',
                'type' => 'agency',
                'price' => 349.00,
                'duration_days' => 30,
                'max_agents' => 60, // Unlimited
                'is_active' => true
            ],

            // Agent Plans (AUD)
            [
                'name' => 'Basic',
                'type' => 'agent',
                'price' => 29.00,
                'duration_days' => 30,
                'max_agents' => null,
                'is_active' => true
            ],
            [
                'name' => 'Premium',
                'type' => 'agent',
                'price' => 49.00,
                'duration_days' => 30,
                'max_agents' => null,
                'is_active' => true
            ],
            [
                'name' => 'Pro',
                'type' => 'agent',
                'price' => 79.00,
                'duration_days' => 30,
                'max_agents' => null,
                'is_active' => true
            ]
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}