@props(['status'])

@if (session()->has('status'))
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600']) }}>
        {{ session('status') }}
    </div>
@endif

@if (session()->has('error'))
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-red-600']) }}>
        {{ session('error') }}
    </div>
@endif
