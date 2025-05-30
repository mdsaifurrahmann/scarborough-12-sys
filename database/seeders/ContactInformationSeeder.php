<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactInformation; // Ensure this is the correct namespace for your model

class ContactInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'facebook_username' => 'Scarboroughfolkfest',
            'linkedin_username' => 'paramparacanada',
            'instagram_username' => 'paramparacanada',
            'youtube_username' => '@scarboroughfolkfest',
            'phone' => '647-780-0785',
            'email' => 'info@paramparacanada.ca',
            'location' => 'Scarborough, ON'
        ];

        foreach ($data as $key => $value) {

            $exists = ContactInformation::where('key', $key)->exists();

            if (!$exists) {
                ContactInformation::updateOrCreate(
                    ['key' => $key],
                    ['value' => is_array($value) ? json_encode($value) : $value]
                );
            }
        }
    }
}
