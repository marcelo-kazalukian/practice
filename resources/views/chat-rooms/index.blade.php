<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your conversations')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div id="messages">
                        @foreach($chatRooms as $chatRoom)
                            {{--<div class="mb-2 @if($chatRoom->user_id != $message->user_id) text-right @endif">--}}
                            <div class="mb-2">
                                <a href="{{route('chat-rooms.show', $chatRoom->id)}}">{{$chatRoom->id . ' ' . $chatRoom->name}}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
