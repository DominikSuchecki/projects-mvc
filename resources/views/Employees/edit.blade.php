<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="/employees/{{ $employee->id }}">
            @csrf
            @method('PUT')

            <!-- Position -->
            <div class="mt-4">
                <x-input-label for="position" :value="__('Position')" />

                <select id="position" name="position" class="block mt-1 w-full" required>
                    <option value="">-Select position-</option>
                    <option value="ui designer">UI Designer</option>
                    <option value="frontend">Frontend</option>
                    <option value="backend">Backend</option>
                    <option value="fullstack">Fullstack</option>
                    <option value="devops">DevOps</option>
                </select>

                <x-input-error :messages="$errors->get('position')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <x-primary-button class="ms-4">
                    {{ __('Edit employee') }}
                </x-primary-button>
            </div>
        </form>
    </div>
    </div>
</x-app-layout>