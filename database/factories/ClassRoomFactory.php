<?php

namespace Database\Factories;

use App\Models\ClassRoom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ClassRoom>
 */
class ClassRoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'class_name' => fake()->randomElement([
                'X RPL 1',
                'X RPL 2',
                'XI TKJ 1',
                'XI TKJ 2',
            ]),
        ];
    }
}
