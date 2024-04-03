<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invoices') }}
        </h2>
    </x-slot>
    <a href="{{ route('invoices.create') }}">Create new invoice</a>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-4">
                @foreach ($invoices as $invoice)
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{ $invoice->id }}
                        </h3>
                        <a href="/invoices/{{ $project->id }}">Details</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    
</x-app-layout>
