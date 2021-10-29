@props(['styles' => '', 'scripts' => ''])

<x-base-layout>
    <x-slot name="styles">
        <style type="text/css" media="screen">
            body {
                padding-top: 4.5rem;
            }
        </style>
        {{ $styles }}
    </x-slot>
    @include('layouts.navigation')
    <div class="container">
        {{ $slot }}
    </div>
    <x-slot name="scripts">
        {{ $scripts }}
    </x-slot>
</x-base-layout>