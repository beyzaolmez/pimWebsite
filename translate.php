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
    <header>
        <div id="headerContainer">
            <div id="logo">
            <img src="img/logo.png" alt="logo">
                <p> A.I. P.I.M. </p>
            </div>
            <ul>
                <li> <a href="translateText.php"> translate  </a> </li>
                <li> <a href="aboutUs.html"> about us  </a> </li>
            </ul>
        </div>
    </header>
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
            <form method="POST" action="translate.php">
                <div class="texts">
                    <textarea class="englishText2" placeholder="Type to translate"></textarea>
                </div>
                <input type="submit" name="submit" value="Translate!">
            </form>
            </div>
    </div>
    <footer>
        <p> brought to you by team A </p>
    </footer>
</div>
</body>
</html>

