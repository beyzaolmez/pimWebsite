<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $english = filter_input(INPUT_POST, "english", FILTER_SANITIZE_SPECIAL_CHARS);
    $dutch = filter_input(INPUT_POST, "dutch", FILTER_SANITIZE_SPECIAL_CHARS);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Translate text</title>
    <link rel="stylesheet" href="css/translate.css">
</head>

<body>
<div id="container">
    <div id="intro">
        <h2 class="welcome">Welcome,</h2>
        <h1 class="question">What do you want to translate?</h1>
    </div>
    <div id="buttons">
        <div class="change">
            <img class="img" src="img/translate-icon.png" alt="text">
            <a href="Translate-text.php"><p>Text</p></a>
        </div>
        <div class="connect">
            <img class="img" src="img/talking-head.png" alt="connect">
            <a href="translate.php"><p>Connect to Pim</p></a>
        </div>
    </div>
    <div id="translator">
        <div id="translate">
            <div class="languages">
                <p class="text">English</p>
            </div>
            <form method="POST" action="translate.php">
                <div class="texts">
                    <textarea class="englishText" placeholder="type to translate"></textarea>
                </div>
                <input type="submit" name="submit" value="translate">
            </form>
            </div>
    </div>
</div>

</body>
</html>

