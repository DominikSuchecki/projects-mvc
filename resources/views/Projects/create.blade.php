<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('projects.store') }}">
        @csrf

        <!-- Client ID -->
        <div>
            <x-input-label for="client_id" :value="__('Client')" />

            <select id="client_id" name="client_id" class="block mt-1 w-full">
                <option value="">-Select client-</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>

            <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Description -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <textarea id="description" class="block mt-1 w-full" name="description" required>{{ old('description') }}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!-- Start Date -->
        <div class="mt-4">
            <x-input-label for="start_date" :value="__('Start Date')" />
            <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="old('start_date')" required autofocus autocomplete="start_date" />
            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
        </div>

        <!-- End Date -->
        <div class="mt-4">
            <x-input-label for="end_date" :value="__('End Date')" />
            <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" :value="old('end_date')" autofocus autocomplete="end_date" />
            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
        </div>

        <!-- Status -->
        <div class="mt-4">
            <x-input-label for="status" :value="__('Status')" />

            <select id="status" name="status" class="block mt-1 w-full" required>
                <option value="">-Select status-</option>
                <option value="planned">Planned</option>
                <option value="in progress">In progress</option>
                <option value="completed">Completed</option>
                <option value="suspended">suspended</option>
                <option value="cancelled">Cancelled</option>
            </select>

            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>

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
                {{ __('Create Project') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
