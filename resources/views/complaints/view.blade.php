<x-app-layout>
    <x-slot name="header">

        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $complaint->title }}
            </h2>
        </div>
    </x-slot>



    <div class="max-w-[600px] mx-auto">
        <ul>
            <li>Title: {{ $complaint->title }}</li>
            <li>Date: {{ $complaint['observed_date'] }}</li>
            <li>Details: {{ $complaint['details'] }}</li>
        </ul>

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
        <form action="/complaints/{{$complaint->id}}/log" method='post'>
            @csrf
            <div class="mb-6 mt-10">
                <x-input-label for="comment" :value="__('Details')" />
                <x-textarea id="comment" class="block mt-1 w-full" name="comment" :value="old('comment')" required autocomplete="comment" />
            </div>
            <x-primary-button type="submit">
                Update Progress
            </x-primary-button>
        </form>

        <!-- Display the logs here -->

        <h2 class="mt-6 mb-3">Progress Log</h2>
        @if (count($logs) > 0)
        <ul>
            @foreach ($logs as $log)
            <li class="my-3"><small>{{$log->created_at}}</small>
                <p>{{$log->comment}}</p>
            </li>
            @endforeach
        </ul>
        @else
        <p>No logs so far</p>
        @endif
        @endif
    </div>



</x-app-layout>