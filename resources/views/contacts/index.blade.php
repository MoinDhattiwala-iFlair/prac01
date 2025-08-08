<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Contacts') }}
            </h2>
            <div class="flex items-center space-x-2">
                <a href="{{ route('contacts.import.form') }}"
                    class="inline-block px-4 py-2 text-sm font-medium text-white transition bg-green-600 rounded hover:bg-green-700">
                    Import
                </a>
                <a href="{{ route('contacts.create') }}"
                    class="inline-block px-4 py-2 text-sm font-medium text-white transition bg-blue-600 rounded hover:bg-blue-700">
                    Create
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Name</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Phone number</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Created at.</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($contacts as $contact)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900 break-words whitespace-normal">
                                    {{ e($contact->name) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 break-words whitespace-normal">
                                    {{ $contact->phone_number }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                    {{ $contact->created_at->diffForHumans() }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                    <div class="flex items-center space-x-4">
                                        <!-- Edit Link -->
                                        <a href="{{ route('contacts.edit', $contact->id) }}"
                                            class="text-blue-600 hover:underline">
                                            {{ __('Edit') }}
                                        </a>
                                        <!-- Delete Form -->
                                        <form method="POST" action="{{ route('contacts.destroy', $contact->id) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this contact?');">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button>
                                                {{ __('Delete') }}
                                            </x-danger-button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-6 py-4 text-sm text-center text-gray-900" colspan="4">
                                    {{ __('No contacts found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
