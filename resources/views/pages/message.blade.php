<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Message') }}
        </h2>
    </x-slot>

    @section('breadcrumbs')
        <x-breadcrumb current_page="New Message" :previous_pages="[['name' => 'Contact Admin', 'link' => route('contact-admin')]]" />
    @endsection

    <div class="min-h-screen flex flex-col items-center bg-gray-100 mx-3">

        <div class="w-full sm:max-w-md mt-6 px-18 py-4 ">
            <x-auth-session-status class="mt-5 text-center"/>

            <div class="w-full sm:max-w-md mt-10 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

                <div class="pt-3 pb-7 border-b">
                    <h3 class="text-lg font-semibold">{{__('Send a message to the Admin.')}}</h3>
                </div>

                <div class="pt-6">
                    <form method="POST" action="{{ route('send-message') }}">
                    @csrf

                    <!-- Message -->
                        <div>
                            <x-label for="message" class="font-semibold pb-3" :value="__('Enter Message')" />

                            <textarea id="message" class="block mt-1 w-full @error('message') border-red-600 focus:border-red-300 focus:ring-red-200 @enderror rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                      type="message"
                                      name="message"
                                      rows="4"
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

        </div>
    </div>
</x-app-layout>
