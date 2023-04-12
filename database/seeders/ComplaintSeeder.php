<?php

namespace Database\Seeders;

use App\Models\Complaint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $complaints = [
            [
                'full_name' => 'John Doe',
                'phone_number' => '1234567890',
                'category' => 'Double Billing',
                'description' => 'I have been charged twice for the same service.',
                'latitude' => -17.8251668,
                'longitude' => 31.0335107,
                'status' => 'Work In Progress'
            ],
            [
                'full_name' => 'Jane Smith',
                'phone_number' => '0987654321',
                'category' => 'Water Burst',
                'description' => 'There is a burst pipe outside my house.',
                'latitude' => -20.1591023,
                'longitude' => 28.5951474,
                'status' => 'Completed'
            ],
            [
                'full_name' => 'Bob Johnson',
                'phone_number' => '5551234',
                'category' => 'Sewer Blockage',
                'description' => 'The sewer is blocked and causing flooding.',
                'latitude' => -18.9700195,
                'longitude' => 32.6585047,
                'status' => 'Resolved'
            ],
            [
                'full_name' => 'Melissa Brown',
                'phone_number' => '5554321',
                'category' => 'Water Burst',
                'description' => 'There is a leak in my bathroom.',
                'latitude' => -19.4466776,
                'longitude' => 29.8206162,
                'status' => 'Completed'
            ],
            [
                'full_name' => 'Mark Lee',
                'phone_number' => '1231231234',
                'category' => 'Double Billing',
                'description' => 'I was charged for a subscription that I cancelled already.',
                'latitude' => -18.9288739,
                'longitude' => 29.8146592,
                'status' => 'Work In Progress'
            ],
            [
                'full_name' => 'Julie Chen',
                'phone_number' => '9876543210',
                'category' => 'Water Burst',
                'description' => 'The water pressure in my shower is very low.',
                'latitude' => -20.0631119,
                'longitude' => 30.8216457,
                'status' => 'Completed'
            ],
            [
                'full_name' => 'David Gonzalez',
                'phone_number' => '5555678',
                'category' => 'Sewer Blockage',
                'description' => 'The sewer is backing up into my basement.',
                'latitude' => -18.0124109,
                'longitude' => 31.0758695,
                'status' => 'Resolved'
            ],
            [
                'full_name' => 'Rachel Kim',
                'phone_number' => '5558765',
                'category' => 'Sewer Blockage',
                'description' => 'The toilet is not flushing properly.',
                'latitude' => -17.881463,
                'longitude' => 31.1474167,
                'status' => 'Work In Progress'
            ],
            [
                'full_name' => 'Erica Davis',
                'phone_number' => '1230984567',
                'category' => 'Double Billing',
                'description' => 'I was charged for a service that I never received.',
                'latitude' => -17.302212,
                'longitude' => 31.3259444,
                'status' => 'Completed'
            ],
            [
                'full_name' => 'Michael Brown',
                'phone_number' => '1112223333',
                'category' => 'Water Burst',
                'description' => 'There is a leak in my kitchen sink.',
                'latitude' => -17.3542305,
                'longitude' => 30.1819397,
                'status' => 'Resolved'
            ],
            [
                'full_name' => 'Katie Jackson',
                'phone_number' => '5557890',
                'category' => 'Sewer Blockage',
                'description' => 'The drain is clogged in my shower.',
                'latitude' => 37.8324,
                'longitude' => -122.2612,
                'status' => 'Work In Progress'
            ],
        ];
        foreach ($complaints as $complaint) {
            Complaint::create($complaint);
        }
    }
}
