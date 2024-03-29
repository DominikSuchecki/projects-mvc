<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assign employees') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-4">
            @foreach ($employees as $employee)
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ $employee->first_name }}
                </h3>
                <p class="mt-2 text-sm text-gray-500">
                    {{ $employee->last_name }}
                </p>
                </div>
            </div>
            @endforeach
            </div>
        </div>
    </div>

    <form method="POST" action="{{$projectId}}">
        @csrf

        <select id="assigned_users" name="assigned_users[]" class="form-select rounded-md shadow-sm w-full" multiple required>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->first_name . " " . $user->last_name . " - " . $user->position . " - " . $user->role}}</option>
            @endforeach
        </select>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('projects.index') }}">
                {{ __('Back to Projects') }}
            </a>

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <x-primary-button class="ms-4">
                {{ __('Assign employee') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
