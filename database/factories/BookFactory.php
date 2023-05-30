<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'isbn' => $this->faker->isbn13,
            'title' => $this->faker->text(50),
            'author_id' => rand(1, 5),
            'image_path' => $this->faker->imageUrl(),
            'publisher' => $this->faker->company,
            'category' => $this->faker->text(50),
            'pages' => rand(1, 2000),
            'language' => $this->faker->locale,
            'publish_date' => $this->faker->date,
            'subjects' => $this->faker->text(50),
            'desc' => $this->faker->paragraph,
        ];
    }
}
