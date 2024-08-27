<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    
    public function definition(): array
    {
        return [
            'books' => Book::all()->random(),
            'title' => fake()->text(50),
            'parent_id' => NULL,
            'description' => fake()->text(200),
            'content' => fake()->text(200),
            'order' => fake()->numberBetween(1,10),
            'level' => 1
        ];
    }
}
