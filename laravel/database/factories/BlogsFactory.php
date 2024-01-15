<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Blogs;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\AppointmentData>
 */
final class BlogsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blogs::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $users = User::all();

        return [
            'gebruikersId' => $this->faker->randomElement($users)->id,
            'titel' => $this->faker->words(6, true),
            'inhoud' => $this->faker->paragraphs(3, true),
        ];
    }
}