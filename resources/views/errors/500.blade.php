
@extends('layouts.app')

@section('content')
    <h1>Something went wrong</h1>

    <p>Sorry, our application encountered an unexpected error. Please try again later.</p>

    <a href="{{ route('movies.index') }}">Back to the list</a>
@endsection
