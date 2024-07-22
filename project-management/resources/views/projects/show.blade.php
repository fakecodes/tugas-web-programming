@extends('layouts.app')

@section('content')
    <h1>{{ $project->name }}</h1>
    <p>{{ $project->description }}</p>
    <p>Due Date: {{ $project->due_date }}</p>
    <a href="{{ route('projects.edit', $project) }}">Edit Project</a>
    <form method="POST" action="{{ route('projects.destroy', $project) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Project</button>
    </form>

    <h2>Tasks</h2>
    <form method="POST" action="{{ route('projects.tasks.store', $project) }}">
        @csrf
        <input type="text" name="name" placeholder="Task Name" required>
        <textarea name="description" placeholder="Task Description"></textarea>
        <select name="status">
            <option value="not started">Not Started</option>
            <option value="in progress">In Progress</option>
            <option value="completed">Completed</option>
        </select>
        <input type="date" name="due_date">
        <button type="submit">Add Task</button>
    </form>
    <ul>
        @foreach($project->tasks as $task)
            <li>
                <form method="POST" action="{{ route('projects.tasks.update', [$project, $task]) }}">
                    @csrf
                    @method('PUT')
                    <input type="text" name="name" value="{{ $task->name }}" required>
                    <textarea name="description">{{ $task->description }}</textarea>
                    <select name="status">
                        <option value="not started" @if($task->status == 'not started') selected @endif>Not Started</option>
                        <option value="in progress" @if($task->status == 'in progress') selected @endif>In Progress</option>
                        <option value="completed" @if($task->status == 'completed') selected @endif>Completed</option>
                    </select>
                    <input type="date" name="due_date" value="{{ $task->due_date }}">
                    <button type="submit">Update</button>
                </form>
                <form method="POST" action="{{ route('projects.tasks.destroy', [$project, $task]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

    <canvas id="projectProgressChart"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('projectProgressChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Not Started', 'In Progress', 'Completed'],
                datasets: [{
                    data: [
                        {{ $project->tasks->where('status', 'not started')->count() }},
                        {{ $project->tasks->where('status', 'in progress')->count() }},
                        {{ $project->tasks->where('status', 'completed')->count() }}
                    ],
                    backgroundColor: ['#f00', '#ff0', '#0f0']
                }]
            },
            options: {}
        });
    </script>
@endsection
