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

    @else

    <h2>All the complaints have been assigned!</h2>

    @endif


    <h1 class="text-3xl mt-10 text-center">Dashboard Stats</h1>


    <div class="grid grid-cols-2 mt-12 gap-4 max-w-[600px] mx-auto">

        <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow text-center">
            <h5 class="mb-2 text-6xl font-thin tracking-tight text-gray-900">{{$stats->totalComplaints}}</h5>
            <p class="font-bold text-gray-700 dark:text-gray-400">Total Complaints</p>
        </div>

        <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow text-center">
            <h5 class="mb-2 text-6xl font-thin tracking-tight text-gray-900">{{$stats->totalResolvedComplaints}}</h5>
            <p class="font-bold text-gray-700 dark:text-gray-400">Total Resolved Complaints</p>
        </div>


    </div>

    <div class="grid grid-cols-2 mt-12 gap-4 max-w-[600px] mx-auto">

        <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow text-center">
            <h5 class="mb-2 text-6xl font-thin tracking-tight text-gray-900">{{$stats->totalComplaintsThisMonth}}</h5>
            <p class="font-bold text-gray-700 dark:text-gray-400">Total Complaints in last 30 days</p>
        </div>

        <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow text-center">
            <h5 class="mb-2 text-6xl font-thin tracking-tight text-gray-900">{{$stats->totalResolvedComplaintsThisMonth}}</h5>
            <p class="font-bold text-gray-700 dark:text-gray-400">Total Resolved Complaints in last 30 days</p>
        </div>



    </div>



</x-app-layout>
