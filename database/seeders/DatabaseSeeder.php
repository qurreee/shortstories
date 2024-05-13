<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Genre::create(['genre_name' => 'Action']);
        Genre::create(['genre_name' => 'Romance']);
        Genre::create(['genre_name' => 'Adventure']);
        Genre::create(['genre_name' => 'Horror']);
        Genre::create(['genre_name' => 'Sci-fi']);
        Genre::create(['genre_name' => 'Mystery']);
        Genre::create(['genre_name' => 'Slice of Life']);
        Genre::create(['genre_name' => 'Fantasy']);
        Genre::create(['genre_name' => 'Comedy']);
        Genre::create(['genre_name' => 'Supernatural']);
    }
}
