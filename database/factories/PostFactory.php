<?php

namespace Database\Factories;

use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $availableIds = Website::pluck('id');

        return [
            'website_id'        =>  $availableIds[rand(0, count($availableIds) - 1)],
            'title'             =>  $this->faker->text(30),
            'description'       =>  $this->faker->paragraph(5)
        ];
    }
}
