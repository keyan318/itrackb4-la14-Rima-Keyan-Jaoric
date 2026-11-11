<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

 
class MovieController extends Controller
{
    public function index(Request $request)
{
    DB::enableQueryLog();

    $genre = $request->query('genre');
    $year = $request->query('year');

    $genres = Genre::all();

    DB::flushQueryLog();

    $query = Movie::with('genre');

    if ($genre) {
        $query->where('genre_id', $genre);
    }

    if ($year) {
        $query->where('year', $year);
    }

    $items = $query->get();

    return view('movies.index', compact('items', 'genre', 'year', 'genres'));
}

    public function create()
    {  
         $genres= Genre::all();

        return view('movies.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $validated=$request->validate([
            'title' =>'required|string|min:5|max:100',
            'genre_id' =>'required|exists:genres,id',
            'year' =>'required|integer|min:1888|max:2100',
            'director'=>['required','string','min:5','max:100','regex:/^[A-Za-z .,\'-]+$/'],
            'rating'=>'required|numeric|min:0|max:10',
            'duration'=>['required','regex:/^\d{1,2}h\s?\d{1,2}m$/'],
        ],[
            'title.min' =>'The title must be at least 5 characters.',
            'title.max' =>'The title must not be longer than 100 characters.',
            'director.min' =>'The director must be at least 5 characters.',
            'director.regex' =>'The director may only contain letters, spaces, periods, commas, apostrophes and hyphens.',
            'duration.regex' =>'The duration must look like 2h 28m.',
        ]);

        $validated['year']=(int)$validated['year'];
        $validated['rating']=(float)$validated['rating'];

        $movie = Movie::create($validated);

         Log::info('Movie saved', [
        'id' => $movie->id,
        ]);

    return redirect()
    ->route('movies.index')
    ->with('success', 'Movie added successfully.');
    }

   public function show(Movie $movie)
{
    return view('movies.show', ['item' => $movie]);
}

    public function edit(Movie $movie)
   {
    $genres = Genre::all();
    return view('movies.edit', compact('movie', 'genres'));
   }

    public function update(Request $request, Movie $movie)
    {
    $validated = $request->validate([
        'title' => 'required|string|min:5|max:100',
        'genre_id' => 'required|exists:genres,id',
        'year' => 'required|integer|min:1888|max:2100',
        'director' => ['required','string','min:5','max:100','regex:/^[A-Za-z .,\'-]+$/'],
        'rating' => 'required|numeric|min:0|max:10',
        'duration' => ['required','regex:/^\d{1,2}h\s?\d{1,2}m$/'],
    ], [
        'title.min' => 'The title must be at least 5 characters.',
        'title.max' => 'The title must not be longer than 100 characters.',
        'director.min' => 'The director must be at least 5 characters.',
        'director.regex' => 'The director may only contain letters, spaces, periods, commas, apostrophes and hyphens.',
        'duration.regex' => 'The duration must look like 2h 28m.',
    ]);

    $validated['year'] = (int) $validated['year'];
    $validated['rating'] = (float) $validated['rating'];

    $movie->update($validated);

    return redirect()->route('movies.index')->with('success', 'Movie updated successfully.');
    }

   
public function destroy(Movie $movie)
{
    abort_if($movie->genre->movies()->count() === 1, 403);

    $movie->delete();

    return redirect()->route('movies.index');
}

    public function featured()
    {
        $item = Movie::where('is_featured', true)->firstOrFail();
        return view('movies.show', ['item' => $item]);
    }
}
