<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Member;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Book::truncate();
        User::truncate();
        Member::truncate();
        Reservation::truncate();
        User::factory()->create();
        $this->call([
            BookSeeder::class,
            MemberSeeder::class,
            ReservationSeeder::class
        ]);
       

        
    }
}
