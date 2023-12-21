<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User - ') . $user->name }}
            </h2>
            <x-secondary-link href="{{ route('users') }}" class="ms-auto">
                {{ __('Back') }}
            </x-secondary-link>
            @if (!$user->deleted_at)
            <x-primary-link href="/users/{{$user->id}}/suspend" class="ms-3 bg-red-600">
                {{ __('Suspend') }}
            </x-primary-link>
            @else
            <x-primary-link href="/users/{{$user->id}}/reactivate" class="ms-3 bg-green-600">
                {{ __('Reactivate') }}
            </x-primary-link>
            @endif
        </div>
    </x-slot>

    <div class=" max-w-[600px] mx-auto">

        <div class="relative overflow-x-auto my-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <tbody>
                    <tr class="bg-white border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            Name:
                        </th>
                        <td class="px-6 py-4">
                            {{ $user->name }}
                        </td>
                    </tr>
                    @if ($user->role == 'staff')
                    <tr class="bg-white border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            Department:
                        </th>

                        <td class="px-6 py-4">
                            {{ $department->name }}
                        </td>
                    </tr>
                    @endif
                    <tr class="bg-white border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            Email:
                        </th>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>







</x-app-layout>
