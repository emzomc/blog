<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;

class PostFactory extends Factory
{
     /**
     * The name of the factory's corresponding model
     * 
     * @var string
     * 
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'excerpt' => '<p>' . implode($this->faker->paragraphs(2)) . '</p>',
            'body' => '<p>' . implode($this->faker->paragraphs(6)) . '</p>',
        ];
    }
}
