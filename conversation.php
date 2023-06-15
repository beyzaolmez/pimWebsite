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
        <div class="change2">
            <img class="img" src="img/translate-icon.png" alt="text">
            <a class="link" href="translateText.php"><p class="link">Text</p></a>
        </div>
        <div class="connect2">
            <img class="img" src="img/talking-head.png" alt="connect">
            <a class="link" href="translate.php"><p class="link">Connect to Pim</p></a>
        </div>
    </div>


    <div id="translator">
        <div id="translate">
            <form id="messageForm" method="POST" action="http://localhost:5000/conn_pim">
                <div class="texts">
                    <div class="border">
                        <form action="conversation.php">
                            <input type="text" placeholder="Start typing...">
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</div>
</body>
</html>