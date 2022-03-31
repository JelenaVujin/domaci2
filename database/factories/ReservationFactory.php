<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'book_id'=>Book::factory(),
            'user_id'=>User::factory(),
            'member_id'=>Member::factory()
        ];
    }
}
