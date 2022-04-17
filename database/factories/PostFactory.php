<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model= Post::class;
    public function definition()
    {
        return [
            'title'=>$this->faker->text(10),
            'writer_id'=>rand(1,100),
            'description'=>$this->faker->text
        ];
    }
}
