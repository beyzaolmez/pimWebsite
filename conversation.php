<?php
    include "languages/config.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> A.I.P.I.M. | Chat </title>
    <link rel="stylesheet" href="css/conversation.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
<div id="container">

<?php include_once "header.php"; ?>

    <div id="intro">
        <h2><?php echo $lang['welcome']; ?></h2>
        <h1><?php echo $lang['what2']; ?></h1>
    </div>
    <div id="buttons">
        <div class="connect">
            <img class="img" src="img/talk-icon.png" alt="connect">
            <a class="link" href="translate.php"><p class="link"><?php echo $lang['connect']; ?></p></a>
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
    <footer>
    <div class="select-menu">
    <div class="select-btn">
        <img src="img/globe-icon.jpg" alt="logo">
        <span class="sBtn-text">English</span>
        <i class="bx bx-chevron-up"></i>
    </div>
    <ul class="options">
        <li class="option">
        <span class="option-text"><a class="option-text" href="conversation.php?lang=en"><?php echo $lang['lang_en']; ?></a></span>
        </li>
        <li class="option">
        <span class="option-text"><a class="option-text" href="conversation.php?lang=nl"><?php echo $lang['lang_nl']; ?></a></span>
        </li>
    </ul>
    </div>
    <p> <?php echo $lang['footer']; ?> </p>
    </footer>
</div>

<script src="dropdown.js"></script>
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
        // Create a new chat bubble for the user's message
        const userMessageBubble = document.createElement("div");
        userMessageBubble.classList.add("message", "user-message", "active");
        userMessageBubble.innerHTML = `<p>${userInput}</p>`;
        conversationContainer.append(userMessageBubble);

        // Scroll to the bottom of the conversation container to show the latest message
        conversationContainer.animate({ scrollTop: conversationContainer.prop("scrollHeight") }, 300);

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
                conversationContainer.append(assistantMessageBubble);

                // Scroll to the bottom of the conversation container to show the latest message
                conversationContainer.animate({ scrollTop: conversationContainer.prop("scrollHeight") }, 300);
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
