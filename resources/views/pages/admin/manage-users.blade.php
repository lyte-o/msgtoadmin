<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <x-auth-session-status class="mb-4 pt-6 text-center"/>

    @php
        function statusColor(string $status): string {
            return match ($status) {
                'pending' => 'yellow',
                'active'  => 'green',
            };
        }
    @endphp

    <div class="py-10 mx-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="pt-3 pb-7 border-b">
                    <h3 class="text-xl font-semibold">{{__('Showing the latest messages recieved.')}}</h3>
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
                                            <th class="p-4 pl-8 pt-0 pb-3 text-slate-700  text-left">Name</th>
                                            <th class="p-4 pl-8 pt-0 pb-3 text-slate-700  text-left">Email</th>
                                            <th class="p-4 pl-8 pt-0 pb-3 text-slate-700  text-left">Phone</th>
                                            <th class="p-4 pl-8 pt-0 pb-3 text-slate-700  text-left">Status</th>
                                            <th class="p-4 pr-8 pt-0 pb-3 text-slate-700  text-left">Date Registered</th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white ">
                                            @if($users->count() < 1)
                                                <tr>
                                                    <td class="border-b border-slate-100 text-center p-4 italic text-indigo-500" colspan="5">You have not sent any message to the Admin.</td>
                                                </tr>
                                            @else
                                                @foreach($users as $user)
                                                    <tr>
                                                        <td class="border-b border-slate-100  p-4 pr-8 text-slate-500 ">{{ $user->full_name }}</td>

                                                        <td class="border-b border-slate-100  p-4 pr-8 text-slate-500 ">{{ $user->email }}</td>

                                                        <td class="border-b border-slate-100  p-4 pr-8 text-slate-500 ">{{ $user->phone }}</td>

                                                        <td class="border-b border-slate-100  p-4 pr-8 text-white ">
                                                            <span class="bg-{{statusColor($user->status)}}-100 text-{{statusColor($user->status)}}-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2 dark:bg-{{statusColor($user->status)}}-200 dark:text-{{statusColor($user->status)}}-900">

                                                                  {{ ucfirst($user->status) }}

                                                                <span class="cursor-pointer ml-2" title="{{ $user->status == 'pending' ? 'Activate' : 'Make Pending' }}">
                                                                    <x-rotate-svg />
                                                                </span>
                                                            </span>
                                                        </td>

                                                        <td class="border-b border-slate-100  p-4 text-slate-500 ">{{ $user->created_at->format('d-m-Y G:i') }}</td>
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
