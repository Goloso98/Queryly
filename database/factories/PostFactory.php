<?php

namespace Database\Factories;

use App\Models\User;
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
    public function definition()
    {
        $user = User::all()->random();
        // App\Models\Post::where('posttype', 'like', 'question')->get()
        return [
            'userid' => $user->id,
            'postdate' => $this->faker->dateTimeBetween($startDate = $user->birthday, $endDate = 'now', $timezone = null),
            'posttype' => 'question',
            'title' => $this->faker->sentence,
            'posttext' => $this->faker->paragraph
        ];
    }
}
