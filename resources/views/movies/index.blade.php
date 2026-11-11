@extends('layouts.app')

@section('title', 'Movie List')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Movie List</h2>
        <a href="{{ route('movies.create') }}" class="btn btn-success">+ Add Movie</a>
    </div>

   

    {{-- Genre filter links --}}
    <div class="mb-2">
        <span class="fw-semibold me-2">Genre:</span>
        @foreach($genres as $g)
            <a href="{{ route('movies.index', array_filter(['genre' => $g->id, 'year' => $year])) }}"
               class="btn btn-sm me-1 {{ (string)$genre === (string)$g->id ? 'btn-primary' : 'btn-outline-primary' }}">
                {{ $g->name }}
            </a>
        @endforeach
    </div>

    {{-- Year filter links --}}
    <div class="mb-4">
        <span class="fw-semibold me-2">Year:</span>
        @foreach([1999, 2008, 2010, 2014, 2021] as $y)
            <a href="{{ route('movies.index', array_filter(['genre' => $genre, 'year' => $y])) }}"
               class="btn btn-sm me-1 {{ (string)$year === (string)$y ? 'btn-secondary' : 'btn-outline-secondary' }}">
                {{ $y }}
            </a>
        @endforeach
    </div>

    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Genre</th>
                <th>Year</th>
                <th>Director</th>
                <th>Rating</th>
                <th>Duration</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($items as $movie)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('movies.show', $movie) }}" class="fw-bold text-decoration-none">
                            {{ $movie->title }}
                        </a>
                    </td>
                    <td>{{ $movie->genre->name ?? '—' }}</td>
                    <td>{{ $movie->year }}</td>
                    <td>{{ $movie->director }}</td>
                    <td>
                        {{ $movie->rating }}
                        @if ($movie->rating >= 8.5)
                            <span class="badge bg-success">Top Rated</span>
                        @endif
                    </td>
                    <td>{{ $movie->duration }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('movies.edit', $movie) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('movies.destroy', $movie) }}" method="POST"
                              onsubmit="return confirm('Delete this record?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No movies found yet — add some to see them here.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection