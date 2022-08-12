@props(['inputName'])
@error($inputName)

    <span {{ $attributes->merge(['class' => 'text-red-600']) }}>{{ $message }}</span>

@enderror
