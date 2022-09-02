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

                        <x-task-list :tasks="$tasks" />
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
