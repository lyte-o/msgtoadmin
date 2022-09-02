<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Task') }}
        </h2>
    </x-slot>

    @section('breadcrumbs')
        <x-breadcrumb current_page="Add new task" :previous_pages="[['name' => 'Tasks', 'link' => route('tasks.index')]]" />
    @endsection

    <div class="min-h-screen flex flex-col items-center bg-gray-100 mx-3">

        <div class="w-full sm:max-w-md px-18 py-2 ">

            <x-auth-session-status class="mt-5 text-center"/>

            <div class="w-full sm:max-w-md mt-10 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

                <div class="pt-3 pb-7 border-b">
                    <h3 class="text-xl font-bold text-indigo-600">{{__('Create Task.')}}</h3>
                </div>

                <div class="pt-6">
                    <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf

                    <!-- Message -->
                        <div class="mb-5">
                            <x-label for="message" class="font-semibold pb-3" :value="__('Enter Message')" />

                            <x-input type="text" id="title" name="title" class="block w-full" placeholder="Enter the title of a new task" value="{{ old('title') }}"/>
                            <x-form-input-error :inputName="$error = 'title'" />
                        </div>

                        <div class="mb-5">
                            <x-label for="category" class="font-semibold pb-3" :value="__('Category')" />

                            <select id="category" name="category" class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option selected disabled> --- Select Category---</option>
                                @if($categories->isNotEmpty())
                                    @foreach($categories as $category)
                                        <option value="{{ $category->slug }}" @if(old('status') == $category->slug) selected @endif>
                                            {{ $category->name  }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <x-form-input-error :inputName="$error = 'category'" />
                        </div>

                        <div class="mb-5">
                            <x-label for="status" class="font-semibold pb-3" :value="__('Status')" />

                            <select id="status" name="status" class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="NOT STARTED" selected> Not Started</option>
                                <option value="ONGOING" @if(old('status') == 'ONGOING') selected @endif> Ongoing</option>
                            </select>
                            <x-form-input-error :inputName="$error = 'status'" />
                        </div>

                        <div class="mb-5">
                            <x-label for="deadline" class="font-semibold pb-3" :value="__('Task Deadline')" />
                            <x-input type="datetime-local" id="deadline" name="deadline" class="block w-full"
                                     placeholder="Enter the title of a new task"
                                     value="{{ old('name') }}" min="{{ now()->format('Y-m-d\TH:i') }}"/>
                            <x-form-input-error :inputName="$error = 'deadline'" />
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <x-button class="ml-3">
                                {{ __('Submit') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
