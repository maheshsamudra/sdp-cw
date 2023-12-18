<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Activity Log') }}
        </h2>
    </x-slot>

    @if (count($logs) > 0)
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        User
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        User Id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Details
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                <tr class="bg-white border-b ">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{$log->created_at}}
                    </th>
                    <td class="px-6 py-4">
                        {{$log->name}}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{$log->user_id}}
                    </td>

                    <td class="px-6 py-4">
                        {{$log->activity}}
                    </td>
                </tr> @endforeach

            </tbody>
        </table>
    </div>

    @endif
</x-app-layout>
