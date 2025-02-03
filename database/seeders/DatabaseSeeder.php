<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(2)->create();

        //import Listing
        Listing::factory(20)->create();

        //this run method in database seeder will create 2 users and 20 listings
        //Now run a fresh migration since we change our table and also sees the database


    }
}
