<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Contacts') }}
            </h2>
            <a href="{{ route('contacts.index') }}"
                class="inline-block px-4 py-2 text-sm font-medium text-white transition bg-red-600 rounded hover:bg-blue-700">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                Import Contacts
                            </h2>
                        </header>
                        <form method="post" action="{{ route('contacts.import') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <x-input-label for="title" :value="__('Upload XML File')" />
                                <x-text-input id="title" name="file" type="file" class="block w-full mt-1"
                                     required autofocus accept=".xml" />
                                <x-input-error class="mt-2" :messages="$errors->get('file')" />
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Import') }}</x-primary-button>

                                @if (session('status') === 'contact-imported')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600">{{ __('Contacts imported succesfully.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
