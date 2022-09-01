<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Categories') }}
        </h2>
    </x-slot>

    <div class="py-10 mx-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-auth-session-status class="mb-7 text-center"/>

            <!-- New Category form --->
            <div class="bg-white p-6 mt-7 overflow-hidden shadow-sm sm:rounded-lg">

            </div>

            <div class="bg-white p-6 mt-7 overflow-hidden shadow-sm sm:rounded-lg">
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
                                                {{ $category->is_active ? 'ACTIVE' : 'INACTIVE' }}
                                                <form action="{{ route('update-status') }}" method="post" class="inline mt-1">
                                                    @csrf
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
        </div>
    </div>
</x-app-layout>
