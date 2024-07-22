@extends('layouts.app')

@section('content')
    <h1>Create Project</h1>
    <form method="POST" action="{{ route('projects.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Project Name" required>
        <textarea name="description" placeholder="Project Description"></textarea>
        <input type="date" name="due_date">
        <button type="submit">Create</button>
    </form>
@endsection
