<x-app-layout>

    @section('page-style')
        <style>
            .bg-yellow-100 {
                background-color: #fdf9c3 !important;
            }
        </style>
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

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

            <x-auth-session-status class="mb-7 text-center"/>

            <div class="bg-white p-6 mt-7 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="pt-4 pb-7 border-b sm:flex justify-between items-center block">
                    <h3 class="text-xl font-semibold">{{__('Showing all users registered on the platform.')}}</h3>

                    <div class="pr-0 md:pr-6 pt-4 md:pt-0">
                        <div class="inline-block cursor-pointer ">
                            <x-dropdown align="left">
                                <x-slot:trigger>
                                    <x-link-button class="px-7 p-3 sm:p-3 font-bold">
                                        {{ request()->has('status') ? __(ucfirst(request('status'))) : __('Filter By') }}
                                        <span class="pl-2"><x-dropdown-svg /></span>
                                    </x-link-button>
                                </x-slot:trigger>
                                <x-slot:content>
                                    <x-dropdown-link href="{{ route('manage-users', ['status' => 'pending'])}}"
                                                     class="font-semibold text-yellow-600 hover:bg-yellow-100 focus:bg-yellow-100"
                                    >
                                        Pending Users
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('manage-users', ['status' => 'active'])}}"
                                                     class="font-semibold text-green-700 hover:bg-green-100 focus:bg-green-100"
                                    >
                                        Active Users
                                    </x-dropdown-link>
                                </x-slot:content>
                            </x-dropdown>
                        </div>

                        <div class="inline-block">
                            <x-link-button href="{{ route('manage-users') }}" class="ml-2 px-7 p-3 sm:p-3 bg-slate-400 hover:bg-slate-600 font-bold">
                                {{ __('Clear Filter') }}
                            </x-link-button>
                        </div>
                    </div>
                </div>

                <div class="pt-6 mt-4 mb-3">
                    <div class="overflow-x-auto relative  rounded-md">
                        <table class="min-w-max md:w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Name
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Email
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Phone
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Status
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Date Registered
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($users->count() < 1)
                                <tr>
                                    <td class="py-4 px-6 font-semibold text-purple-500 whitespace-nowrap text-center" colspan="5">
                                        {{ request()->has('status') ? 'No user is currently ' . ucfirst(request('status')): 'No user has been registered on this platform.' }}
                                    </td>
                                </tr>
                            @else
                                @foreach($users as $user)
                                    <tr>
                                        <th scope="row" class="border-b border-slate-100 py-4 px-6 font-medium text-gray-900 whitespace-nowrap">{{ $user->full_name }}</th>

                                        <td class="border-b border-slate-100 py-4 px-6">{{ $user->email }}</td>

                                        <td class="border-b border-slate-100 py-4 px-6">{{ $user->phone }}</td>

                                        <td class="border-b border-slate-100 py-4 px-6">
                                            <span class="bg-{{statusColor($user->status)}}-100 text-{{statusColor($user->status)}}-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">

                                                  {{ ucfirst($user->status) }}

                                                <form action="{{ route('update-status') }}" method="post" class="inline mt-1">
                                                    @csrf
                                                    <input type="hidden" value="{{ $user->email }}" name="email">
                                                    <button type="submit" class="inline cursor-pointer ml-2"
                                                            title="{{ $user->status == 'pending' ? 'Activate' : 'Make Pending' }}"
                                                    >
                                                        <x-rotate-svg />
                                                    </button>
                                                </form>

                                            </span>
                                        </td>

                                        <td class="border-b border-slate-100 py-4 px-6">{{ $user->created_at->format('d-m-Y G:i') }}</td>
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
</x-app-layout>
