<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 mx-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="sm:flex justify-between items-center block bg-white mb-10 px-6 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="py-6 pl-4 pr-0">
                    <p>{{__('Hello')}} <span class="font-bold">{{ ucwords(auth()->user()->full_name) }}</span>!</p>
                    <p class="text-slate-600 mt-1">{{__("You can now send messages to the Admin.")}}</p>
                </div>

                <div>
                    <x-link-button href="{{ route('create-message') }}" class="m-3 p-4 px-6 sm:p-3">{{ __('New Message') }}</x-link-button>
                </div>
            </div>

            <x-auth-session-status class="text-center"/>

            <div class="py-6 mt-7">
                <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="pt-3 pb-7 border-b">
                        <h3 class="text-xl font-semibold">{{__('Showing all your messages sent to the Admin.')}}</h3>
                    </div>
                    <div class="pt-6 mt-4 mb-3">
                        <div class="overflow-x-auto relative rounded-md">
                            <table class="min-w-max md:w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th scope="col" class="py-3 px-6">Date & Time</th>
                                    <th scope="col" class="py-3 px-6">Message</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($messages->count() < 1)
                                    <tr>
                                        <td class="py-4 px-6 font-semibold text-purple-500 whitespace-nowrap text-center" colspan="2">You have not sent any message to the Admin.</td>
                                    </tr>
                                @else
                                    @foreach($messages as $message)
                                        <tr>
                                            <th scope="row" class="py-4 px-6 border-b border-slate-100 font-medium text-gray-900 whitespace-nowrap">{{ $message->created_at->format('d-m-Y G:i') }}</th>

                                            <td class="border-b border-slate-100 py-4 px-6">{{ $message->body }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>