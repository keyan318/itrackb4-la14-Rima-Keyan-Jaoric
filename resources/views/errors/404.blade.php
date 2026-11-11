
@extends('layouts.app')

@section('content')
    <h1>Page not found</h1>

    <p>Sorry, the movie page you are looking for does not exist.</p>

    <a href="{{ route('movies.index') }}">Back to the list</a>
@endsection
