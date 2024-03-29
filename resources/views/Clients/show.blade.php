<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-4">
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{ $client->name }}
                        </h3>
                        <p class="mt-2 text-sm text-gray-500">
                            {{ $client->nip }}
                        </p>

                        @foreach ($projects as $project)
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                {{ $project->name }}
                        </h3>
                        <p class="mt-2 text-sm text-gray-500">
                            {{ $project->description }}
                        </p>
                        @endforeach

                        <p class="mt-2 text-sm text-gray-500">
                            <a href="/clients/edit/{{ $client->id }}">Edit</a>
                        </p>
                        <form action="/clients/delete/{{ $client->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
       </div>
    </div>
</x-app-layout>
