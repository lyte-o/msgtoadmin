<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between bg-white px-6 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{__('Hello')}} <span class="font-bold">{{ ucwords(auth()->user()->full_name) }}</span>!
                </div>


                <x-link-button href="{{ route('create-message') }}" class="m-3">{{ __('Create New Message') }}</x-link-button>
            </div>
        </div>
    </div>

    <x-auth-session-status class="mb-4 text-center"/>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="pt-3 pb-7 border-b">
                    <h3 class="text-xl font-semibold">{{__('Showing all your messages sent to the Admin.')}}</h3>
                </div>
                <div class="pt-6">
                    <div class="mt-4 -mb-3">
                        <div class="not-prose relative bg-slate-50 rounded-xl overflow-hidden /25">
                            <div class="absolute inset-0 bg-grid-slate-100 [mask-image:linear-gradient(0deg,#fff,rgba(255,255,255,0.6))] dark:bg-grid-slate-700/25 dark:[mask-image:linear-gradient(0deg,rgba(255,255,255,0.1),rgba(255,255,255,0.5))]"></div>

                            <div class="relative rounded-xl overflow-auto">
                                <div class="shadow-sm overflow-hidden my-8">
                                    <table class="border-collapse table-auto w-full text-sm">
                                        <thead>
                                        <tr class="font-medium border-b">
                                            <th class="p-4 pl-8 pt-0 pb-3 text-slate-700  text-left">Date & Time</th>
                                            <th class="p-4 pr-8 pt-0 pb-3 text-slate-700  text-left">Message</th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white ">
                                            @if($messages->count() < 1)
                                                <tr>
                                                    <td class="border-b border-slate-100 text-center p-4 italic text-indigo-500" colspan="2">You have not sent any message to the Admin.</td>
                                                </tr>
                                            @else
                                                @foreach($messages as $message)
                                                    <tr>
                                                        <td class="border-b border-slate-100  p-4 text-slate-500 ">{{ $message->created_at->format('d-m-Y G:i') }}</td>
                                                        <td class="border-b border-slate-100  p-4 pr-8 text-slate-500 ">{{ $message->body }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="absolute inset-0 pointer-events-none border border-black/5 rounded-xl dark:border-white/5"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
