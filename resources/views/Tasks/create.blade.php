<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create task') }}
        </h2>
    </x-slot>

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
                {{ __('Create task') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
