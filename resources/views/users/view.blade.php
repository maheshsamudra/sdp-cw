<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
            <x-primary-link href="{{ route('add_manager') }}" class="ms-auto">
                {{ __('Add Manager') }}
            </x-primary-link>
            <x-primary-link href="{{ route('add_staff') }}" class="ms-3">
                {{ __('Add Staff Member') }}
            </x-primary-link>
        </div>
    </x-slot>



    <h2 class="text-xl mb-3 mt-6">Staff Members</h2>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($staff as $user)
                <tr class="bg-white border-b ">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{$user->name}}
                        @if ($user->deleted_at)
                        (Suspended)
                        @endif
                    </th>
                    <td class="px-6 py-4">
                        {{$user->email}}
                    </td>
                    <td class="px-6 py-4">
                        <a href="/users/{{$user->id}}">Edit</a>
                    </td>
                </tr> @endforeach

            </tbody>
        </table>
    </div>



    <h2 class="text-xl mb-3 mt-6">Managers</h2>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($managers as $user)
                @if (Auth::user()->id != $user->id)
                <tr class="bg-white border-b ">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{$user->name}}
                    </th>
                    <td class="px-6 py-4">
                        {{$user->email}}
                    </td>
                    <td class="px-6 py-4">
                        <a href="/users/{{$user->id}}">Edit</a>
                    </td>
                </tr>
                @endif
                @endforeach

            </tbody>
        </table>
    </div>



</x-app-layout>
