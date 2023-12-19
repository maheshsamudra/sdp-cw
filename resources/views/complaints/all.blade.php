<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('All Complaints')  }}
            </h2>
            <x-secondary-link href="/complaints" class="ms-auto me-3">
                {{ __('Back') }}
            </x-secondary-link>

        </div>
    </x-slot>

    @if (count($complaints) > 0)
    <h2 class="text-xl mt-6 mb-3">All Complaints</h2>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
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
                        {{$complaint->id}}
                    </td>
                    <td class="px-6 py-4">
                        @if (!!$complaint->completed_at)
                        Completed
                        @else
                        In Progress
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        {{$complaint->observed_date}}
                    </td>
                    <td class="px-6 py-4">
                        <a href="/complaints/{{$complaint->id}}">View</a>
                    </td>
                </tr> @endforeach

            </tbody>
        </table>
    </div>

    @else

    <h2 class="text-xl">You don't have any active complaints.</h2>


    @endif

</x-app-layout>
