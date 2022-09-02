<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    @section('breadcrumbs')
        <x-breadcrumb current_page="Tasks" />
    @endsection

    <div class="pb-10 pt-2 mx-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-auth-session-status class="mb-7 text-center"/>

            <section class="mt-7 ">
                <div class="px-4 py-2 text-sm text-indigo-600 font-bold">
                    List of Tasks
                </div>
                <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="sm:flex justify-between items-center pb-4 block border-b">
                        <div>
                            <h3 class="text-xl font-semibold">{{ __('Showing the list of all your tasks.') }}</h3>
                        </div>
                        <div>
                            <x-link-button href="{{ route('tasks.create') }}" class="my-3 sm:mx-3 p-4 px-6 sm:p-3">{{ __('Add New Task') }}</x-link-button>
                        </div>
                    </div>
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
                                @if($tasks->count() < 1)
                                    <tr>
                                        <td class="py-4 px-6 font-semibold text-purple-500 whitespace-nowrap text-center" colspan="5">
                                            No Task has been added yet.
                                        </td>
                                    </tr>
                                @else
                                    @php
                                        $n = 0;
                                    @endphp
                                    @foreach($tasks as $task)
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
                                                this.closest('form').submit();" class="btn btn-link inline-flex justify-center items-center px-4 bg-red-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none cursor-pointer focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150 mx-2 p-1">Delete</a>

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
