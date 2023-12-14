<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Managers dashboard') }}
        </h2>
    </x-slot>

    <h2 class="text-xl mb-3 mt-6">Unassigned Complaints</h2>

    @if (count($complaints) > 0)
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Observed Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($complaints as $complaint)
                <tr class="bg-white border-b ">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{$complaint->title}}
                    </th>
                    <td class="px-6 py-4">
                        {{$complaint->observed_date}}
                    </td>
                    <td class="px-6 py-4">
                        <a href="/complaints/{{$complaint->id}}">Assign</a>
                    </td>
                </tr> @endforeach

            </tbody>
        </table>
    </div>

    @endif



</x-app-layout>