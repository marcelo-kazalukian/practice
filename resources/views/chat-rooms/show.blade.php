<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chat Room') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div id="messages">
                        @foreach($chatRoom->messages as $message)
                            <div class="mb-2 @if($chatRoom->user_id != $message->user_id) text-right @endif">
                                <span class="font-bold">{{ $message->user->name }}</span>
                                <p>{{ $message->content }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <x-text-input id="message"></x-text-input>
                        <x-primary-button id="send-button">Send</x-primary-button>
                        <input type="hidden" id="chat-room-id" value="{{$chatRoom->id}}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/html" id="message-template">
        <div class="_POSITION_">
            <div class="font-bold">_SENDER_</div>
            <p>MESSAGE</p>
        </div>
    </script>

    <script>
        document.getElementById('send-button').addEventListener('click', function () {
            // Get the CSRF token from the meta tag
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const message = document.getElementById('message').value;
            let chatRoomId = document.getElementById('chat-room-id').value;

            const data = {
                message: message,
                chat_room_id: chatRoomId
            };

            fetch('{{route('chat-messages.store')}}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify(data)
            })
            .then(data => {
                document.getElementById('message').value = '';
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        });

        window.addEventListener('DOMContentLoaded', function () {
            let chatRoomId = document.getElementById('chat-room-id').value;
            window.Echo.private('chat-room.' + chatRoomId)
                .listen('MessageSent', (e) => {
                    const newMessage = document.createElement('p');
                    newMessage.textContent = e.chatMessage.content;
                    document.getElementById('messages').appendChild(newMessage);
                })
        });
    </script>
</x-app-layout>
