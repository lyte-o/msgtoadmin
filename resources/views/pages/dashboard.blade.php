<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 mx-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-4 py-2 text-sm text-slate-600">
                <p>{{__('Hello')}} <span class=" font-bold">{{ ucwords(auth()->user()->full_name) }}</span>!</p>
                <p class="mt-2">Welcome to your task Manager.</p>
            </div>

            <section class="mt-5">
                <div class="px-4 py-2 text-sm text-indigo-600 font-bold">
                    Total Tasks
                </div>
                <div class="block md:grid md:grid-cols-12 gap-3 lg:gap-10 items-center">

                    <div class="md:col-span-4 bg-white mb-10 px-6 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="py-3 pl-4 pr-0 flex justify-between">
                            <p class="text-slate-500 my-2 uppercase font-semibold items-center">{{__("Pending Tasks")}}</p>
                            <span class="font-bold text-yellow-500 text-2xl">{{ $count['pending'] ?? 0 }}</span>
                        </div>
                    </div>
                    <div class="md:col-span-4 bg-white mb-10 px-6 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="py-3 pl-4 pr-0  flex justify-between items-center">
                            <p class="text-slate-500 my-2 uppercase font-semibold">{{__("Done Tasks")}}</p>
                            <span class="font-bold text-green-600 text-2xl">{{ $count['done'] ?? 0 }}</span>
                        </div>
                    </div>
                    <div class="md:col-span-4 bg-white mb-10 px-6 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="py-3 pl-4 pr-0 flex justify-between">
                            <p class="text-slate-500 my-2 uppercase font-semibold items-center">{{__("Overdue Tasks")}}</p>
                            <span class="font-bold text-red-600 text-2xl">{{ $count['overdue'] ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </section>

            <x-auth-session-status class="text-center"/>

            <section class="">
                <div class="px-4 py-2 text-sm text-indigo-600 font-bold">
                    Recent Tasks
                </div>
                <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="pt-6 mt-4">
                        <x-task-list :tasks="$recents" />
                    </div>
                </div>
            </section>

        </div>
    </div>
</x-app-layout>
