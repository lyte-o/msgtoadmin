@props(['type' => null])

@if($type == 'res')
    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-responsive-nav-link>
    <x-responsive-nav-link :href="route('contact-admin')" :active="request()->routeIs('contact-admin', 'create-message')">
        {{ __('Contact Admin') }}
    </x-responsive-nav-link>
    <x-responsive-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.index', 'tasks.create')">
        {{ __('Tasks') }}
    </x-responsive-nav-link>
@else
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>
    <x-nav-link :href="route('contact-admin')" :active="request()->routeIs('contact-admin', 'create-message')">
        {{ __('Contact Admin') }}
    </x-nav-link>
    <x-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.index', 'tasks.create')">
        {{ __('Tasks') }}
    </x-nav-link>
@endif
