<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\websiteInformation as websiteInformationModel; // Ensure this is the correct namespace for your model

class websiteInformation extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            'title' => 'Scarborough Folk Fest',
            'logo' => 'logo.png',
            'thumbnail' => 'thumbnail.png',
            'favicon' => 'favicon.ico',
            'description' => 'Scarborough Folk Festival is a celebration of music, culture, and community. Join us for a weekend of folk music, workshops, and family-friendly activities.',
            'keywords' => [
                "Scarborough",
                "Folk Festival",
                "Music",
                "Culture",
                "Community"
            ],
            'url' => 'https://scarboroughfolkfest.com',
        ];

        
        foreach ($data as $key => $value) {
            websiteInformationModel::updateOrCreate(
                ['key' => $key],
                ['value' => is_array($value) ? json_encode($value) : $value]
            );
        }
        
        
    }
}
