<?php
    include "languages/config.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Translate text</title>
    <link rel="stylesheet" href="css/translate.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
<div id="container">

    <?php include_once "header.php"; ?>

    <div id="intro">
        <h2><?php echo $lang['welcome']; ?></h2>
        <h1><?php echo $lang['what']; ?></h1>
    </div>
    <div id="buttons">
        <div class="change">
            <img class="img" src="img/translate-icon.png" alt="text">
            <a class="link" href="translateText.php"><p class="link"><?php echo $lang['text']; ?></p></a>
        </div>
        <div class="connect">
            <img class="img" src="img/talking-head.png" alt="connect">
            <a class="link" href="translate.php"><p class="link"><?php echo $lang['connect']; ?></p></a>
        </div>
    </div>
    <div id="translator">
        <div id="translate">
            <div class="languages">
                <p><?php echo $lang['lang_en']; ?></p>
                <img class="lang" src="img/switch.png" alt="switch">
                <p><?php echo $lang['lang_nl']; ?></p>
            </div>
            <form method="POST" action="translateText.php">
                <div class="texts">
                    <textarea name="english" class="englishText" placeholder="Type to translate"></textarea>
                    <div class="dutchText"></div>
                </div>
                <input type="submit" name="submit" value="Translate!" onclick="runTypewriterEffect(event)">
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
        <span class="option-text"><a class="option-text" href="translateText.php?lang=en"><?php echo $lang['lang_en']; ?></a></span>
        </li>
        <li class="option">
        <span class="option-text"><a class="option-text" href="translateText.php?lang=nl"><?php echo $lang['lang_nl']; ?></a></span>
        </li>
    </ul>
    </div>
    <p> <?php echo $lang['footer']; ?> </p>
</footer>
</div>
<script src="dropdown.js"></script>
<script type="text/javascript">
    // This is for the typewriter effect
    async function runTypewriterEffect(event) {
        event.preventDefault(); // Prevent form submission

        var textarea = document.querySelector(".englishText");
        var text = textarea.value;

        var translatedDiv = document.querySelector(".dutchText");
        translatedDiv.textContent = ""; // Clear previous text

        var translatedText = await translateText(text); // Wait for translation to complete

        var i = 0;

        var intervalId = setInterval(function () {
            if (i < translatedText.length) {
                translatedDiv.textContent += translatedText.charAt(i);
                i++;
            } else {
                clearInterval(intervalId);
            }
        }, 50);

        return false; // Prevent form submission
    }

    async function translateText(text) {
        var formData = new FormData();
        formData.append('text', text);

        console.log(text)

        var response = await fetch('http://127.0.0.1:5000/translate', {
            method: 'POST',
            body: formData
        });

        var result = await response.json();
        return result.data;
    }
</script>
</body>
</html>
