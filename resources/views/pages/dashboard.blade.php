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
                            <p class="text-slate-500 my-2 uppercase font-semibold items-center">{{__("Tasks not Started")}}</p>
                            <span class="font-bold text-yellow-500 text-2xl">{{ $count['not_started'] ?? 0 }}</span>
                        </div>
                    </div>
                    <div class="md:col-span-4 bg-white mb-10 px-6 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="py-3 pl-4 pr-0 flex justify-between">
                            <p class="text-slate-500 my-2 uppercase font-semibold items-center">{{__("Ongoing Tasks")}}</p>
                            <span class="font-bold text-indigo-600 text-2xl">{{ $count['ongoing'] ?? 0 }}</span>
                        </div>
                    </div>
                    <div class="md:col-span-4 bg-white mb-10 px-6 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="py-3 pl-4 pr-0  flex justify-between items-center">
                            <p class="text-slate-500 my-2 uppercase font-semibold">{{__("Completed Tasks")}}</p>
                            <span class="font-bold text-green-600 text-2xl">{{ $count['completed'] ?? 0 }}</span>
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
                        <div class="overflow-x-auto relative  rounded-md">
                            <table class="min-w-max md:w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        S/N
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Title
                                    </th>
                                    <th>
                                        Category
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Deadline
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Status
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($recents->count() < 1)
                                    <tr>
                                        <td class="py-4 px-6 font-semibold text-purple-500 whitespace-nowrap text-center" colspan="5">
                                            No Task has been added yet.
                                        </td>
                                    </tr>
                                @else
                                    @php
                                        $n = 0;
                                    @endphp
                                    @foreach($recents as $task)
                                        @php $n++ @endphp
                                        <tr>
                                            <th scope="row" class="border-b border-slate-100 py-4 px-6 font-medium text-gray-900 whitespace-nowrap">{{ $n }}</th>

                                            <td class="border-b border-slate-100 py-4 px-6">{{ $task->title }}</td>
                                            <td class="border-b border-slate-100 py-4 px-6">
                                                <span class="bg-indigo-500 text-white font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">{{ $task->category->name }}</span>
                                            </td>
                                            <td class="border-b border-slate-100 py-4 px-6">{{ $task->deadline->format('Y-m-d H:i') }}</td>
                                            <td class="border-b border-slate-100 py-4 px-6">
                                                <span class="bg-{{ statusColor($task->status) }}-100 text-{{statusColor($task->status)}}-800 text-xs font-semibold inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                                                    {{ $task->status }}
                                                </span>
                                            </td>

                                            <td class="border-b border-slate-100 py-4 px-6">
                                                <x-link-button href="{{ route('tasks.edit', $task->slug) }}" class="mx-2 p-1">{{ __('Update') }}</x-link-button>
                                                <form action="{{ route('tasks.delete', $task->slug) }}" method="post" class="inline mt-1">
                                                    @method('DELETE')
                                                    @csrf
                                                    <a onclick="event.preventDefault();
                                                this.closest('form').submit();" class="btn btn-link inline-flex justify-center items-center px-4 bg-red-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none cursor-pointer focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150 mx-2 p-1" color="red">Delete</a>

                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</x-app-layout>
