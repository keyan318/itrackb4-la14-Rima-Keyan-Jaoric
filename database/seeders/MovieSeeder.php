<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $action = Genre::create(['name' => 'Action']);
        $scifi  = Genre::create(['name' => 'Science Fiction']);
        $hero   = Genre::create(['name' => 'Superhero']);

        Movie::create([
            'title' => 'The Matrix',
            'genre_id' => $scifi->id,
            'year' => 1999,
            'director' => 'Lana Wachowski, Lilly Wachowski',
            'rating' => 8.7,
            'duration' => '2h 16m',
            'is_featured' => true,
        ]);

        Movie::create([
            'title' => 'The Dark Knight',
            'genre_id' => $action->id,
            'year' => 2008,
            'director' => 'Christopher Nolan',
            'rating' => 9.0,
            'duration' => '2h 32m',
        ]);

        Movie::create([
            'title' => 'Inception',
            'genre_id' => $scifi->id,
            'year' => 2010,
            'director' => 'Christopher Nolan',
            'rating' => 8.8,
            'duration' => '2h 28m',
        ]);

        Movie::create([
            'title' => 'Interstellar',
            'genre_id' => $scifi->id,
            'year' => 2014,
            'director' => 'Christopher Nolan',
            'rating' => 8.7,
            'duration' => '2h 49m',
        ]);

        Movie::create([
            'title' => 'Spider-Man: No Way Home',
            'genre_id' => $hero->id,
            'year' => 2021,
            'director' => 'Jon Watts',
            'rating' => 8.2,
            'duration' => '2h 28m',
        ]);

        Movie::create([
            'title' => 'Avengers: Doomsday',
            'genre_id' => $hero->id,
            'year' => 2026,
            'director' => 'Anthony Russo, Joe Russo',
            'rating' => 9.0,   // not released yet, so no rating
            'duration' => '2h 30m',
        ]);
    }
}