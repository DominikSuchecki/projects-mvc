<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($project->name) }}
        </h2>
    </x-slot>
    <a href="{{ route('tasks.create', [$project->id]) }}">Create new task</a>


    <h1>Backlog</h1>
    @forelse ($project->tasks->where('status', 'backlog') as $task)
        <div class="card mt-4">
            <div class="card-header">
            <h3 class="card-title">{{ $task->name }}</h3>
            </div>
            <div class="card-body">
            <p class="card-text">{{ $task->description }}</p>
            <ul class="list-group">
                <li class="list-group-item">Start Date: {{ $task->start_date }}</li>
                <li class="list-group-item">End Date: {{ $task->end_date }}</li>
                <li class="list-group-item">Priority: {{ $task->priority }}</li>
            </ul>
            <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-primary">Details</a>
            <a href="{{ route('tasks.assignView', $task->id) }}" class="btn btn-primary">Assign employee</a>
            </div>
        </div>
        @empty
            <p>No tasks with "backlog" status found.</p>
        @endforelse
    
</x-app-layout>
