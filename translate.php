<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Translate </title>
    <link rel="stylesheet" href="css/translate.css">
</head>

<body>
<div id="container">

    <div id="intro">
        <h2>Welcome,</h2>
        <h1>What do you want to translate?</h1>
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
            <div class="languages">
                <p class="text">English</p>
            </div>
            <form method="POST" action="http://localhost:5000/conn_pim">
                <div class="texts">
                    <textarea class="englishText2" name="english" placeholder="Type to translate"></textarea>
                </div>
                <input type="submit" name="submit" value="Translate!">
            </form>
        </div>
    </div>
</div>
</body>
</html>

