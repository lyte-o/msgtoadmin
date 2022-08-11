@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600']) }}>
        {{ $status }}
    </div>
@elseif (session()->has('error'))
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-red-600']) }}>
        {{ session('error') }}
    </div>
@endif
