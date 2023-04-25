<?php

namespace Database\Seeders;

use App\Models\Complaint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $categories = [
            'Refuse Collection',
            'Traffic Lights',
            'Bill Enquiry',
            'Sewer Blockage',
            'Road Works',
            'Double Billing',
            'Water Burst',
            'Fire Hazards',
            'Statement Requests',
        ];
        $statuses = [
            'Pending',
            'Work In Progress',
            'Resolved',
            'Completed',
        ];
        for ($i = 0; $i < 300; $i++) {
            DB::table('complaints')->insert([
                'full_name' => $faker->name,
                'phone_number' => $faker->phoneNumber,
                'category' => $faker->randomElement($categories),
                'description' => $faker->sentence,
                'latitude' => rand(-22.5, -15.5),
          'longitude' => rand(25.5, 34),
                'status' => $faker->randomElement($statuses),
            ]);
        }

    }
}
