<?php

namespace Database\Factories;

use App\Models\Blogs;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReactiesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all();
        $blogs = Blogs::all();

        return [
            'gebruikersId' => $this->faker->randomElement($users)->id,
            'blogId' => $this->faker->randomElement($blogs)->id,
            'inhoud' => $this->faker->paragraphs(3, true),
        ];
    }
}
