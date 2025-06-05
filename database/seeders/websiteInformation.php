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
            'vision_desc' => "To create a world-class cultural festival that celebrates the rich diversity of Scarborough, fostering connections through music, art, and traditions from around the globe. Guided by Parampara Canada's mission to preserve and promote heritage, we aim to inspire unity, nurture creativity, and build a vibrant, inclusive community where all cultures are celebrated and shared.",
            'vision_image' => 'vision_image.png',
        ];


        foreach ($data as $key => $value) {
            // check if the key already exists in the database

            $exists = websiteInformationModel::where('key', $key)->exists();
            if (!$exists) {
                websiteInformationModel::updateOrCreate(
                    ['key' => $key],
                    ['value' => is_array($value) ? json_encode($value) : $value]
                );
            }
        }
    }
}
