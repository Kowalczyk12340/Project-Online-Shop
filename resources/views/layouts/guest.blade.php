@props(['styles' => '', 'scripts' => ''])

<x-base-layout>
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ url('css/form.css') }}">
        {{ $styles }}
    </x-slot>    
    <div class="form">
        {{ $slot }}
    </div>
    <x-slot name="scripts">
        {{ $scripts }}
    </x-slot>
</x-base-layout>
