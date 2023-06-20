<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Translate text</title>
    <link rel="stylesheet" href="css/conversation.css">
</head>
<body>

<div id="container">
    <div id="intro">
        <h2>Welcome User,</h2>
        <h1>What do you want to talk about?</h1>
    </div>
    <div id="buttons">
        <div class="change">
            <img class="img" src="img/translate-icon.png" alt="text">
            <a class="link" href="translateText.php"><p class="link">Text</p></a>
        </div>
        <div class="connect">
            <img class="img" src="img/talking-head.png" alt="connect">
            <a class="link" href="translate.php"><p class="link">Connect to Pim</p></a>
        </div>
    </div>

    <div id="translator">
        <div class="parent-box">
            <div class="smaller-box">
                <div class="conversation-wrapper">
                    <div class="conversation" id="conversation">
                        <!-- Chat bubble for the assistant's message -->
                        <div class="message bot-message">
                            <p class="typing-message">Hello, I am Pim, what do you need help with?</p>
                        </div>
                    </div>
                </div>
            </div>
            <form id="messageForm">
                <div class="texts">
                    <input type="text" id="messageInput" placeholder="Start typing...">
                    <button type="submit" id="submitBtn">
                        <img src="img/send_button.png" alt="Submit">
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const messageForm = $('#messageForm');
        const messageInput = $('#messageInput');
        const conversationContainer = $('#conversation');

        messageForm.on('submit', function(event) {
            event.preventDefault();

            const userInput = messageInput.val().trim();

            if (userInput === '') {
                return;
            }

            sendMessage(userInput);
            messageInput.val('');
        });

        function sendMessage(userInput) {
            const conversationContainer = document.getElementById("conversation");

            // Create a new chat bubble for the user's message
            const userMessageBubble = document.createElement("div");
            userMessageBubble.classList.add("message", "user-message", "active");
            userMessageBubble.innerHTML = `<p>${userInput}</p>`;
            conversationContainer.appendChild(userMessageBubble);

            // Send the message to the server using fetch
            fetch("http://127.0.0.1:5000/conversation", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `text=${encodeURIComponent(userInput)}`
            })
                .then(response => response.json())
                .then(data => {
                    // Handle the response from the server and create a chat bubble for the assistant's message
                    const assistantMessage = data.data;
                    const assistantMessageBubble = document.createElement("div");
                    assistantMessageBubble.classList.add("message", "assistant-message", "active");
                    assistantMessageBubble.innerHTML = `<p>${assistantMessage}</p>`;
                    conversationContainer.appendChild(assistantMessageBubble);

                    // Scroll to the bottom of the conversation container to show the latest message
                    conversationContainer.scrollTop = conversationContainer.scrollHeight;
                })
                .catch(error => {
                    // Handle any errors that occurred during the request
                    console.error("Error:", error);
                });

            // Clear the input field
            document.getElementById("messageInput").value = "";
        }
    });
</script>

</body>
</html>
