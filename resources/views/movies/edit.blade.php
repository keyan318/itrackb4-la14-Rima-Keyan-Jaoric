@extends('layouts.app')

@section('title', 'Edit Movie')

@section('content')

    <h2 class="mb-3">Edit Movie</h2>

    <form action="{{ route('movies.update', $movie) }}" method="POST">
    @csrf
    @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" value="{{ old('title', $movie->title) }}" class="form-control">
            @error('title') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Genre</label>
            <select name="genre_id" class="form-select">
                <option value="">-- Select --</option>
                @foreach($genres as $g)
                    <option value="{{ $g->id }}" @selected(old('genre_id', $movie->genre_id) == $g->id)>{{ $g->name }}</option>
                @endforeach
            </select>
            @error('genre_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Year</label>
            <input type="text" name="year" value="{{ old('year', $movie->year) }}" class="form-control">
            @error('year') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Director</label>
            <input type="text" name="director" value="{{ old('director', $movie->director) }}" class="form-control">
            @error('director') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Rating (0 - 10)</label>
            <input type="text" name="rating" value="{{ old('rating', $movie->rating) }}" class="form-control">
            @error('rating') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Duration (e.g. 2h 28m)</label>
            <input type="text" name="duration" value="{{ old('duration', $movie->duration) }}" class="form-control">
            @error('duration') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('movies.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>

@endsection