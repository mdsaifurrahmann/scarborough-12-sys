<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\websiteInformation as WebsiteInformationSeeder;
use Database\Seeders\ContactInformationSeeder; // Ensure this is the correct namespace for your seeder

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $this->call([
            WebsiteInformationSeeder::class,
            ContactInformationSeeder::class,
        ]);

        
    }
}
