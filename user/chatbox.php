<!DOCTYPE html>
<html>

<head>
    <title>Chat</title>
    <script>
    function sendMessage() {
        const toUser = document.getElementById('to_user').value;
        const message = document.getElementById('message').value;

        fetch('chat.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    to_user: toUser,
                    message: message
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('message').value = '';
                    loadMessages(toUser);
                }
            });
    }

    function loadMessages(toUser) {
        fetch(`chat.php?to_user=${toUser}`)
            .then(response => response.json())
            .then(data => {
                const chatBox = document.getElementById('chat_box');
                chatBox.innerHTML = '';
                data.forEach(chat => {
                    const messageElement = document.createElement('div');
                    messageElement.innerText = `${chat.timestamp}: ${chat.message}`;
                    chatBox.appendChild(messageElement);
                });
            });
    }

    function previewMessage() {
        const message = document.getElementById('message').value;
        document.getElementById('message_preview').innerText = message;
    }
    </script>
</head>

<body>
    <h1>Chat</h1>
    <div>
        <label for="to_user">Chat with (User ID):</label>
        <input type="text" id="to_user">
    </div>
    <div>
        <label for="message">Message:</label>
        <input type="text" id="message" oninput="previewMessage()">
        <button onclick="sendMessage()">Send</button>
    </div>
    <div id="message_preview" style="margin-top: 10px; border: 1px solid #ccc; padding: 10px;">
        <!-- Message preview will be displayed here -->
    </div>
    <div id="chat_box"></div>
</body>

</html>