<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <a href="/tasks/create">Create new task</a>
    assign new employee

    {{ $project->name }}

    {{ $project->tasks}}
    
</x-app-layout>
