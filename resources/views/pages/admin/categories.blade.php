<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Categories') }}
        </h2>
    </x-slot>

    @section('breadcrumbs')
        <x-breadcrumb current_page="Manage Categories" />
    @endsection

    <div class="pb-10 mx-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-auth-session-status class="mb-7 text-center"/>

            <!-- New Category form --->
            <section>
                <div class="px-4 py-2 text-sm text-indigo-600 font-bold">
                    Add New Category
                </div>
                <div class="bg-white px-4 py-6 overflow-hidden shadow-sm sm:rounded-lg">
                    <form action="{{ route('admin.category.store') }}" method="POST">
                        @csrf
                        <div class="block sm:grid sm:grid-cols-8">
                            <div class="col-span-5 sm:col-span-2 md:col-span-1">
                                <x-label for="name" class="font-semibold pb-3" :value="__('Category Name')" />
                            </div>
                            <div class="col-span-4">
                                <x-input type="text" id="name" name="name" class="block w-full" placeholder="Enter the name of a new task category" value="{{ old('name') }}"/>
                                <x-form-input-error :inputName="$error = 'name'" />
                            </div>

                            <div class="col-span-2 mx-auto pt-2">
                                <x-button class="w-full sm:w-auto justify-center">
                                    {{ __('Send') }}
                                </x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

            <section class="mt-7 ">
                <div class="px-4 py-2 text-sm text-indigo-600 font-bold">
                    Category list
                </div>
                <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="pb-7 border-b">
                        <h3 class="text-xl font-semibold">{{ __('Showing the list of all existing categories.') }}</h3>
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
                                        Status
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($categories->count() < 1)
                                    <tr>
                                        <td class="py-4 px-6 font-semibold text-purple-500 whitespace-nowrap text-center" colspan="2">
                                            No Category has been created for tasks
                                        </td>
                                    </tr>
                                @else
                                    @foreach($categories as $category)
                                        <tr>
                                            <th scope="row" class="border-b border-slate-100 py-4 px-6 font-medium text-gray-900 whitespace-nowrap">{{ $category->name }}</th>

                                            <td class="border-b border-slate-100 py-4 px-6">
                                            <span class="bg-{{ statusColor($category->is_active) }}-100 text-{{statusColor($category->is_active)}}-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                                                {{ statusValue($category->is_active) }}
                                                <form action="{{ route('admin.category.update-status', $category->slug) }}" method="post" class="inline mt-1">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="inline cursor-pointer ml-2"
                                                            title="{{ $category->is_active ? 'Deactivate' : 'Activate' }}"
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
