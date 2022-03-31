<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'member_name' => $this->faker->name(),
            'email' => $this->faker->unique()->email(),
            'phone_number' => $this->faker->unique()->phoneNumber(),
            'book_issued'=>$this->faker->boolean()
        ];
    }
}
