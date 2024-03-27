<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Avatar') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Make sure to smile :)
        </p>
    </header>

    <form method="post" action="{{ route('profile.updateAvatar') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        @if (Auth::user()->avatar_path != null)
            <img class="w-20 h-20 rounded-full bg-center bg-no-repeat bg-cover" src="storage/{{Auth::user()->avatar_path}}"/>
        @endif

        <div class="mt-4">
            <x-input-label for="avatar_path" :value="__('Avatar')" />
            <x-text-input id="avatar_path" class="block mt-1 w-full" type="file" name="avatar_path" :value="old('avatar_path')" />
            <x-input-error :messages="$errors->get('avatar_path')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'avatar-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
