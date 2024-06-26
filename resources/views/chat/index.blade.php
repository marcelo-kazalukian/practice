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
                    <div id="messages"></div>
                    <div>
                        <x-text-input id="message"></x-text-input>
                        <x-primary-button id="send-button">Send</x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('send-button').addEventListener('click', function () {
            // Get the CSRF token from the meta tag
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const message = document.getElementById('message').value;

            const data = {
                message: message,
            };

            fetch('{{route('chat.store')}}', {
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
            window.Echo.channel('messages')
                .listen('MessageSent', (e) => {
                    const newMessage = document.createElement('p');
                    newMessage.textContent = e.text;
                    document.getElementById('messages').appendChild(newMessage);
                })
        });
    </script>
</x-app-layout>
