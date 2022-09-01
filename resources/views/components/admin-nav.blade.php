@props(['type' => null])

@if('type' == 'res')
    <x-responsive-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')">
        {{ __('Admin Dashboard') }}
    </x-responsive-nav-link>

    <x-responsive-nav-link :href="route('manage-users')" :active="request()->routeIs('manage-users')">
        {{ __('Manage Users') }}
    </x-responsive-nav-link>

    <x-responsive-nav-link :href="route('admin.category.index')" :active="request()->routeIs('admin.category.index')">
        {{ __('Manage Categories') }}
    </x-responsive-nav-link>
@else
    <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')">
        {{ __('Admin Dashboard') }}
    </x-nav-link>

    <x-nav-link :href="route('manage-users')" :active="request()->routeIs('manage-users')">
        {{ __('Manage Users') }}
    </x-nav-link>

    <x-nav-link :href="route('admin.category.index')" :active="request()->routeIs('admin.category.index')">
        {{ __('Manage Categories') }}
    </x-nav-link>
@endif
