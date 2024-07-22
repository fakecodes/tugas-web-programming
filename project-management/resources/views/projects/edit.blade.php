@extends('layouts.app')

@section('content')
    <h1>Edit Project</h1>
    <form method="POST" action="{{ route('projects.update', $project) }}">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $project->name }}" required>
        <textarea name="description">{{ $project->description }}</textarea>
        <input type="date" name="due_date" value="{{ $project->due_date }}">
        <button type="submit">Update</button>
    </form>
@endsection
