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
                                @isset($contact->id)
                                    {{ __('Edit Contact') }}
                                @else
                                    {{ __('Create Contact') }}
                                @endif
                            </h2>
                        </header>
                        <form method="post" action="{{ isset($contact->id) ? route('contacts.update', $contact->id) : route('contacts.store') }}" class="mt-6 space-y-6">
                            @csrf
                            @isset($contact->id)
                                @method('put')
                            @endif
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="block w-full mt-1" :value="old('name', ($contact->name ?? ''))" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="phone_number" :value="__('Phone Number')" />
                                <x-text-input id="phone_number" name="phone_number" type="tel" class="block w-full mt-1" :value="old('phone_number', ($contact->phone_number ?? ''))" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>

                                @if (session('status') === 'contact-saved')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Contact saved succesfully.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
