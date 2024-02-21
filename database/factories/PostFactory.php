<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use App\Models\Priority;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    
    protected $model = Post::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'body' => $this->faker->sentence(),
            'check' => $this->faker->boolean(),
            'deadline' => $this->faker->dateTime(),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'priority_id' =>Priority::factory()
        ];
    }
}
