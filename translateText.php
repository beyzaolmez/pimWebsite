<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        <div id="translate">
            <div class="languages">
                <p>English</p>
                <img class="lang" src="img/switch.png" alt="switch">
                <p>Dutch</p>
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
        <p> brought to you by team A </p>
    </footer>
</div>

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
        formData.append('english', text);

        console.log(text)

        var response = await fetch('http://localhost:5000/web_translate', {
            method: 'POST',
            body: formData
        });

        var result = await response.json();
        return result.translated_text;
    }


</script>



</body>
</html>
