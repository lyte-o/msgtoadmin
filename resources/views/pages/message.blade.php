<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Message') }}
        </h2>
    </x-slot>

    <div class="min-h-screen flex flex-col items-center pt-16 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-16 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('send-message') }}">
            @csrf

            <!-- Message -->
                <div>
                    <x-label for="message" class="font-semibold pb-3" :value="__('Enter Message')" />

                    <textarea id="message" class="block mt-1 w-full @error('message') border-red-600 focus:border-red-300 focus:ring-red-200 @enderror rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                              type="message"
                              name="message"
                              required autofocus
                    >{{old('message')}}</textarea>
                </div>
                <x-form-input-error :inputName="$error = 'message'" />

                <div class="flex items-center justify-end mt-4">

                    <x-button class="ml-3">
                        {{ __('Send') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
