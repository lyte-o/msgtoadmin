<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10 mx-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="sm:flex justify-between items-center block bg-white mb-10 px-6 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="py-6 pl-4 pr-0">
                    <p class="font-semibold">{{__('Hello Admin!')}}</p>
                    <p>To see the list of registered users and their status, go to <em class="italic font-semibold">Manage Users</em></p>
                </div>
            </div>

            <x-auth-session-status class="text-center"/>

            <div class="py-6 mt-7">
                <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="pt-3 pb-7 border-b">
                        <h3 class="text-xl font-semibold">{{ __('Showing all messages received from the latest.') }}</h3>
                    </div>
                    <div class="pt-6 mt-4 mb-3">
                        <div class="overflow-x-auto relative rounded-md">
                            <table class="min-w-max md:w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th scope="col" class="py-3 px-6">Name</th>
                                    <th scope="col" class="py-3 px-6">Date & Time</th>
                                    <th scope="col" class="py-3 px-6">Message</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($messages->count() < 1)
                                    <tr>
                                        <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap" colspan="3">You have not received any message from users.</td>
                                    </tr>
                                @else
                                    @foreach($messages as $message)
                                        <tr>
                                            <th scope="row" class="border-b border-slate-100 py-4 px-6 font-medium text-gray-900 whitespace-nowrap">{{ $message->user->full_name }}</th>

                                            <td class="border-b border-slate-100 py-4 px-6">{{ $message->created_at->format('d-m-Y G:i') }}</td>

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
