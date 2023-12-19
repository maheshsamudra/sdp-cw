<x-app-layout>
    <x-slot name="header">

        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $complaint->title }}
            </h2>

            <x-secondary-link href="/dashboard" class="ms-auto me-3">
                {{ __('Back') }}
            </x-secondary-link>

            @if ($complaint->completed_at)
            <x-primary-button disabled class="opacity-50">
                {{ __('Resolved') }} on {{$complaint->completed_at}}
            </x-primary-button>
            @elseif (Auth::user()->id === $complaint->assigned_staff_user_id)
            <x-primary-link href="/complaints/{{ $complaint->id }}/complete" class="">
                {{ __('Mark as resolved') }}
            </x-primary-link>
            @endif
        </div>
    </x-slot>

    <div class="max-w-[600px] mx-auto">

        <div class="relative overflow-x-auto my-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <tbody>
                    <tr class="bg-white border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            Title:
                        </th>
                        <td class="px-6 py-4">
                            {{ $complaint->title }}
                        </td>
                    </tr>
                    <tr class="bg-white border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            Date:
                        </th>
                        <td class="px-6 py-4">
                            {{ $complaint['observed_date'] }}
                        </td>
                    </tr>
                    <tr class="bg-white border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap align-top">
                            Details:
                        </th>
                        <td class="px-6 py-4">
                            {{ $complaint['details'] }}
                        </td>
                    </tr>
                    <tr class="bg-white border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            Status:
                        </th>
                        <td class="px-6 py-4">
                            @if (!$complaint->completed_at)
                            In Progress
                            @else
                            Completed
                            @endif
                        </td>
                    </tr>

                    @if (count($images) > 0)
                    <tr class="bg-white border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap align-top">
                            Images:
                        </th>
                        <td class="px-6 py-4">

                            <div class="grid grid-cols-4 gap-4">
                                @foreach ($images as $image)
                                <div class="">
                                    <div class="col-sm-6 col-md-4 col-lg-3 item">
                                        <a href="/view-image?url={{$image}}" data-lightbox="photos">
                                            <img class="img-fluid" src="/view-image?url={{$image}}">
                                        </a>
                                    </div>
                                    <!-- <div class="thumbnail">
                                        <img src="/view-image?url={{$image}}" alt="">
                                    </div> -->
                                </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    @endif

                </tbody>
            </table>
        </div>

        @if (Auth::user()->role === 'manager' && !$complaint->assigned_staff_user_id)
        <form action="/complaints/{{$complaint->id}}/assign" method='post'>
            @csrf
            <div class="flex items-center justify-between">
                <div class="mb-6 w-9/12">
                    <label for="memberId" class="block mb-2 text-sm font-medium text-gray-900">Select Staff Member</label>
                    <select id="memberId" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required name="user_id">
                        <option value="">Please select</option>

                        @foreach ($staff as $user)
                        <option value="{{$user->id}}">{{$user->name}} ({{$user->department_name}})</option>
                        @endforeach
                    </select>
                </div>
                <x-secondary-button type="submit">
                    Assign
                </x-secondary-button>
            </div>
        </form>
        @endif

        @if (Auth::user()->role === 'staff' && !$complaint->completed_at)
        <form action="/complaints/{{$complaint->id}}/log" method='post' enctype="multipart/form-data">
            @csrf
            <div class="mb-6 mt-10">
                <x-input-label for="comment" :value="__('Progress Details')" />
                <x-textarea id="comment" class="block mt-1 w-full" name="comment" :value="old('comment')" required autocomplete="comment" />
            </div>

            <!-- <label for="file-input" class="sr-only">Choose Images</label>
            <input type="file" name="images" id="file-input" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:bg-gray-50 file:border-0 file:bg-gray-100 file:me-4 file:py-3 file:px-4" multiple accept="image/png, image/jpeg">
            <br>
            <br> -->


            <x-primary-button type=" submit">
                Update Progress
            </x-primary-button>
        </form>

        <!-- Display the logs here -->


        @endif


        @if (count($logs) > 0)

        <div class="mt-6"></div>
        <hr>
        <h2 class="mt-6 mb-3">Progress Log</h2>
        <ul>
            @foreach ($logs as $log)
            <li class="my-3"><small>{{$log->created_at}}</small>
                <p>{{$log->comment}}</p>
            </li>
            @endforeach
        </ul>
        @elseif (!!$complaint->assigned_staff_user_id)
        <h2 class="mt-6 mb-3">Progress Log</h2>
        <p>No logs so far</p>
        @endif


    </div>



</x-app-layout>
