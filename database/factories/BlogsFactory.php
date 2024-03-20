<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blogs>
 */
class BlogsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $filename = 'example_image_' . time() . '.jpg';

        // Download the image from the URL
        $imageUrl = $this->faker->imageUrl();
        $imageContent = file_get_contents($imageUrl);

        // Save the image to the public/uploads directory
        $imagePath = 'uploads/' . $filename;
        file_put_contents(public_path($imagePath), $imageContent);
        
        return [
            'title' =>  $this->faker->words(3, true),
            'image' => $filename,
            'description' => $this->faker->paragraph,
            'category_id' => \App\Models\Category::all()->random()->id,

        ];

    }
}
