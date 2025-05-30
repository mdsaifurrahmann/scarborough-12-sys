<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventDetails;

class EventDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'countdown_to' => '2025-07-26',
            'event_date' => 'July 26 & 27',
            'event_title' => 'SFF2025',
            'location_link' => '',
            'location_name' => 'Thomson Memorial Park',
            'location_desc' => 'located at 1005 Brimley Rd, Scarborough, ON M1P 3E9',
            'hero_bg' => null, // Placeholder for image file
            'sponsors' => null, // Placeholder for image file
        ];

        foreach ($data as $key => $value) {
            $exists = EventDetails::where('key', $key)->exists();
            if (!$exists) {
                EventDetails::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
        }
    }
}
