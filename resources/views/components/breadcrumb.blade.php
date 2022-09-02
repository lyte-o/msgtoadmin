@props(['current_page' => '', 'previous_pages' => []])

<div class="max-w-7xl mx-auto pt-4 px-4 sm:px-6 lg:px-16">
    <nav class="flex justify-end" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li aria-current="page">
                <div class="flex items-center">
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $current_page }}</span>
                </div>
            </li>
            @if(!empty($previous_pages))
                @foreach($previous_pages as $page)
                    <li>
                        <div class="flex items-center">
                            ::
                            <a href="{{ $page['link'] }}" class="ml-1 text-sm font-medium text-indigo-700 hover:text-indigo-900 md:ml-2">{{ $page['name'] }}</a>
                        </div>
                    </li>
                @endforeach
            @endif
        </ol>
    </nav>
</div>
