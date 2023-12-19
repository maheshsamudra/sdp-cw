<x-app-layout>
    <x-slot name="header">

        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Complaint
            </h2>

            <x-secondary-link href="/dashboard" class="ms-auto me-3">
                {{ __('Back') }}
            </x-secondary-link>

        </div>
    </x-slot>



    <div class="max-w-[600px] mx-auto">


        <form method="POST" action="/complaint" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>


            <div class="mt-4">
                <x-input-label for="date" :value="__('Observed Date')" />
                <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('dob')" required autofocus autocomplete="date" />
                <x-input-error :messages="$errors->get('date')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="details" :value="__('Details')" />
                <x-textarea id="details" class="block mt-1 w-full" name="details" :value="old('details')" required autocomplete="details" />
                <x-input-error :messages="$errors->get('details')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="file-input" class="sr-only">Select Images</label>
                <input type="file" name="images[]" id="file-input" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:bg-gray-50 file:border-0 file:bg-gray-100 file:me-4 file:py-3 file:px-4" multiple accept="image/png, image/jpeg">
            </div>



            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    {{ __('Add') }}
                </x-primary-button>
            </div>
        </form>


    </div>



</x-app-layout>
