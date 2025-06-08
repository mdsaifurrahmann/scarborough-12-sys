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
            'title' => 'Scarborough Folk Fbest',
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
            'join_us_description' => '<p>Be part of a world-class cultural festival celebrating Scarborough’s rich diversity through music, art, and community!</p><p class="bg-primary rounded-sm py-px">Now accepting applications for Vendors, Volunteers, Artists, and Sponsors for Scarborough Folk Fest 2025.</p><p>Don’t miss your chance to get involved — apply today!</p>',
            'careers_description' => '<p class="font-ysabeau px-2 text-center text-xl lg:ml-14 lg:px-0 lg:text-right">Parampara Canada is always looking for new talents. Jobs are generally posted on the professional platforms like linkedin, indeed or glassdoor. Also you can email at <a href="mailto:info@parampara.ca"><span class="bg-primary rounded-sm py-px">info@paramparacanada.ca</span></a> for any openings.</p>',
            'artists_text' => 'Showcase your talent at Scarborough Folk Fest! Share your music, art, and cultural expressions with a diverse audience. Be part of a global celebration of creativity and tradition.',
            'volunteers_text' => 'Be part of the festival magic! Join as a volunteer to help create an unforgettable cultural experience. Connect with artists, organizers, and the community while making a difference.',
            'vendors_text' => 'Bring your unique products to a global audience! Apply as a vendor to share your crafts, food, or merchandise. Engage with festival-goers and expand your reach in a vibrant setting.',
            'sponsors_text' => 'Support a world-className cultural event! Partner with us to celebrate diversity and foster community connections. Gain visibility while making a meaningful impact on cultural enrichment.'
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
