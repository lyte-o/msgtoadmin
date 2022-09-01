@props(['status' => null])

@if (session()->has(['status', 'success']))
    <div id="status-alert" {{ $attributes->merge(['class' => 'p-4 mb-4 text-sm font-semibold text-green-700 bg-green-100 rounded-lg']) }} role="alert">
        {{ session('status') ?? session('success') }}
        <button type="button" class="float-right" onclick="$('#status-alert').hide()" aria-label="Close">x</button>
    </div>
@endif

@if (session()->has('error'))
    <div id="error-alert" {{ $attributes->merge(['class' => 'p-4 mb-4 text-sm font-semibold text-red-700 bg-red-100 rounded-lg']) }} role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close float-right" onclick="$('#error-alert').hide()" aria-label="Close">x</button>
    </div>
@endif

