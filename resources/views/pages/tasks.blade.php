<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-10 mx-3">
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
                            <x-link-button href="{{ route('create-message') }}" class="m-3 p-4 px-6 sm:p-3">{{ __('Add New Task') }}</x-link-button>
                        </div>
                    </div>
                    <div class="pt-6 mt-4">
                        <div class="overflow-x-auto relative  rounded-md">
                            <table class="min-w-max md:w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        Title
                                    </th>
                                    <th>
                                        Category
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Status
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Deadline
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
                                    @foreach($tasks as $task)
                                        <tr>
                                            <th scope="row" class="border-b border-slate-100 py-4 px-6 font-medium text-gray-900 whitespace-nowrap">{{ $task->title }}</th>

                                            <td class="border-b border-slate-100 py-4 px-6">{{ $task->category->name }}</td>
                                            <td class="border-b border-slate-100 py-4 px-6">
                                                <span class="bg-{{ statusColor($task->is_active) }}-100 text-{{statusColor($task->is_active)}}-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                                                    {{ statusValue($task->is_active) }}
                                                    <form action="{{ route('admin.category.update-status', $task->slug) }}" method="post" class="inline mt-1">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="inline cursor-pointer ml-2"
                                                                title="{{ $task->is_active ? 'Deactivate' : 'Activate' }}"
                                                        >
                                                            <x-icon />
                                                        </button>
                                                    </form>
                                                </span>
                                            </td>

                                            <td class="border-b border-slate-100 py-4 px-6">
                                                <form action="{{ route('update-status') }}" method="post" class="inline mt-1">
                                                    @csrf
                                                    <span onclick="event.preventDefault();
                                                this.closest('form').submit();" class="text-red-600 hover:text-red-400 hover:underline">Delete</span>
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
