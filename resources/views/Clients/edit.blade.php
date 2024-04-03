<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clients') }}
        </h2>
    </x-slot>

    <form method="POST" action="/clients/{{ $client->id }}">
        @csrf
        @method('PUT')
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$client->name ?? old('name')"  required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="$client->address ?? old('address')"  required autofocus autocomplete="address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- NIP -->
        <div class="mt-4">
            <x-input-label for="nip" :value="__('NIP')" />
            <x-text-input id="nip" class="block mt-1 w-full" type="text" name="nip" :value="$client->nip ?? old('nip')"  required autofocus autocomplete="nip" maxlength="10" />
            <x-input-error :messages="$errors->get('nip')" class="mt-2" />
        </div>

        <!-- REGON -->
        <div class="mt-4">
            <x-input-label for="regon" :value="__('REGON')" />
            <x-text-input id="regon" class="block mt-1 w-full" type="text" name="regon" :value="$client->regon ?? old('regon')"  autofocus autocomplete="regon" maxlength="14" />
            <x-input-error :messages="$errors->get('regon')" class="mt-2" />
        </div>

        <!-- KRS -->
        <div class="mt-4">
            <x-input-label for="krs" :value="__('KRS')" />
            <x-text-input id="krs" class="block mt-1 w-full" type="text" name="krs" :value="$client->krs ?? old('krs')"  autofocus autocomplete="krs" maxlength="10" />
            <x-input-error :messages="$errors->get('krs')" class="mt-2" />
        </div>

        <!-- Owner First Name -->
        <div class="mt-4">
            <x-input-label for="owner_first_name" :value="__('Owner First Name')" />
            <x-text-input id="owner_first_name" class="block mt-1 w-full" type="text" name="owner_first_name" :value="$client->owner_first_name ?? old('owner_first_name')"  autofocus autocomplete="owner_first_name" />
            <x-input-error :messages="$errors->get('owner_first_name')" class="mt-2" />
        </div>

        <!-- Owner Last Name -->
        <div class="mt-4">
            <x-input-label for="owner_last_name" :value="__('Owner Last Name')" />
            <x-text-input id="owner_last_name" class="block mt-1 w-full" type="text" name="owner_last_name" :value="$client->owner_last_name ?? old('owner_last_name')" autofocus autocomplete="owner_last_name" />
            <x-input-error :messages="$errors->get('owner_last_name')" class="mt-2" />
        </div>

        <!-- Owner Email -->
        <div class="mt-4">
            <x-input-label for="owner_email" :value="__('Owner Email')" />
            <x-text-input id="owner_email" class="block mt-1 w-full" type="email" name="owner_email" :value="$client->owner_email ?? old('owner_email')"  autofocus autocomplete="owner_email" />
            <x-input-error :messages="$errors->get('owner_email')" class="mt-2" />
        </div>

        <!-- Owner Phone -->
        <div class="mt-4">
            <x-input-label for="owner_phone" :value="__('Owner Phone')" />
            <x-text-input id="owner_phone" class="block mt-1 w-full" type="tel" name="owner_phone" :value="$client->owner_phone ?? old('owner_phone')"  autofocus autocomplete="owner_phone" />
            <x-input-error :messages="$errors->get('owner_phone')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('clients.index') }}">
                {{ __('Back to Clients') }}
            </a>

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <x-primary-button class="ms-4">
                {{ __('Edit Client') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
