<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create invoice') }}
        </h2>
    </x-slot>

    <!-- Client ID -->
    <div>
        <x-input-label for="client_id" :value="__('Client')" />

        <select id="client_id" name="client_id" class="block mt-1 w-full" :value="old('client_id')">
            <option value="">-Select client-</option>
            @foreach ($clients as $client)
                <option value="{{ $client->id }}">{{ $client->name }}</option>
            @endforeach
        </select>

        <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('projects.index') }}">
            {{ __('Back to Invoices') }}
        </a>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <x-primary-button class="ms-4">
            {{ __('Create Invoice') }}
        </x-primary-button>
    </div>
</x-app-layout>

<script>
]
</script>