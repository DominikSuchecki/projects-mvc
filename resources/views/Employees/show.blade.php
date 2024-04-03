<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $employee->first_name . " " . $employee->last_name}}
        </h2>
    </x-slot>
    
    <a href="/employees/{{ $employee->id }}/edit">Edit employee</a>
    
    <form method="POST" action="{{ route('employees.destroy', $employee->id) }}">
        @csrf  @method('DELETE')  <button type="submit" onclick="return confirm('Are you sure you want to delete this employee?')">Delete Employee</button>
    </form>

    <div class="grid grid-cols-3 gap-4">
        @forelse ($employee->projects as $project) <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ $project->name }} </h3>
            <p class="mt-2 text-sm text-gray-500">
                <a href="/projects/{{ $project->id }}">Details</a>
            </p>
            </div>
        </div>
        @empty
            <p>This employee is not currently assigned to any projects.</p>
        @endforelse
    </div>

    

    
</x-app-layout>
