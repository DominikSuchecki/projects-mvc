<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create task') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('tasks.store', $projectId) }}" enctype="multipart/form-data">
        @csrf

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
        
        <!-- Priority -->
        <div class="mt-4">
            <x-input-label for="priority" :value="__('Priority')" />

            <select id="priority" name="priority" class="block mt-1 w-full" required>
                <option value="">-Set priority-</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>

            <x-input-error :messages="$errors->get('priority')" class="mt-2" />
        </div>

        <!-- Status -->
        <div class="mt-4">
            <x-input-label for="status" :value="__('Status')" />

            <select id="status" name="status" class="block mt-1 w-full" required>
                <option value="">-Select status-</option>
                <option value="backlog">Backlog</option>
                <option value="to do">To do</option>
                <option value="in progress">In progress</option>
                <option value="code review">Code review</option>
                <option value="done">Done</option>
            </select>

            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>

        <!-- Attachement -->
        <div class="mt-4">
            <x-input-label for="attachement_path" :value="__('Attachement (.zip, .rar - max. 50MB)')" />
            <x-text-input id="attachement_path" class="block mt-1 w-full" type="file" name="attachement_path" :value="old('attachement_path')" />
            <x-input-error :messages="$errors->get('attachement_path')" class="mt-2" />
        </div>


        <!-- Assigned employees -->
        <div class="mt-4">
            <x-input-label for="attachement_path" :value="__('Assign employees')" />
            <select id="assigned_users" name="assigned_users[]" class="form-select rounded-md shadow-sm w-full" multiple required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->first_name . " " . $user->last_name . " - " . $user->position . " - " . $user->role}}</option>
                @endforeach
            </select>
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
                {{ __('Create task') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
