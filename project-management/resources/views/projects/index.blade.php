@extends('layouts.app')

@section('content')
    <h1>Projects</h1>
    <form method="GET" action="{{ route('projects.index') }}">
        <input type="text" name="search" placeholder="Search projects">
        <button type="submit">Search</button>
    </form>
    <a href="{{ route('projects.create') }}">Create New Project</a>
    <ul>
        @foreach($projects as $project)
            <li>
                <a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a>
            </li>
        @endforeach
    </ul>
@endsection
