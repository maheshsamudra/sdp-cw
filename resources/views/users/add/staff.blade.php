<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Staff Member') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('add_staff') }}" class="mx-auto max-w-[400px]">
        @csrf

        <div class="mt-4">
            @foreach ($departments as $department)
            <div class="flex items-center mb-4">
                <input id="department-{{$department->id}}" type="radio" value="{{$department->id}}" name="departmentId" required class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500  focus:ring-2 ">
                <label for="department-{{$department->id}}" class="ms-2 text-sm font-medium text-gray-900">{{ $department->name }}</label>
            </div>
            @endforeach


        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-secondary-link href="{{ route('users') }}" class="me-auto">
                {{ __('Back') }}
            </x-secondary-link>
            <x-primary-button class="ms-3">
                {{ __('Add') }}
            </x-primary-button>
        </div>
    </form>

</x-app-layout>