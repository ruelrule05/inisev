<?php

namespace Database\Seeders;

use App\Models\Subscriber;
use Faker\Factory;
use App\Models\Website;
use Illuminate\Database\Seeder;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        
        $websites = Website::all();
        
        foreach ($websites as $website)
        {
            for ($x = 0; $x < 20; $x++)
            {
                Subscriber::create([
                    'website_id'        =>  $website->id,
                    'email'             =>  $faker->email()
                ]);
            }
        }
    }
}
