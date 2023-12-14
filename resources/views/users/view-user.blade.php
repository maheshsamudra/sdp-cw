<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User - ') . $user->name }}
            </h2>
            <x-secondary-link href="{{ route('users') }}" class="ms-auto">
                {{ __('Back') }}
            </x-secondary-link>
        </div>
    </x-slot>







</x-app-layout>