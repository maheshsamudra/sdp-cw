<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $complaint->title }}
        </h2>
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
    </div>



</x-app-layout>