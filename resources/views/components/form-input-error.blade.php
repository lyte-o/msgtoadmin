@props(['inputName'])
@error($inputName)

    <span {{ $attributes->merge(['class' => 'text-danger']) }}>{{ $message }}</span>

@enderror
