<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //in this array we can pass all the properties our listing table need 
            'user_id' => fake()->randomElement([1,2]), //the value of user id either one or two at the moment we dont have a user
            'title' => fake()->sentence(10),
            'desc' => fake()->paragraph(12),
            'email' => fake()->email(),
            'link' => fake()->url(),
            'tags' => fake()->randomElement([
                'dev,game',
                'game',
                'biz,tech',
                'tech,game,biz',
            ]),
            'approved' => 1
            //1 means true
            // we will have them all approved
            //image that can be null 

            //So this is out listing factory we can use it in the database seeder 
        ];
    }
}
