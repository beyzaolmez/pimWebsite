<?php
    include "languages/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Translate </title>
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
        <div class="change2">
            <img class="img" src="img/translate-icon.png" alt="text">
            <a class="link" href="translateText.php"><p class="link"><?php echo $lang['text']; ?></p></a>
        </div>
        <div class="connect2">
            <img class="img" src="img/talking-head.png" alt="connect">
            <a class="link" href="translate.php"><p class="link"><?php echo $lang['connect']; ?></p></a>
        </div>
    </div>


    <div id="translator">
        <div id="translate">
            <div class="languages">
                <p class="text"><?php echo $lang['lang_en']; ?></p>
            </div>
            <form method="POST" action="http://localhost:5000/conn_pim">
                <div class="texts">
                    <textarea class="englishText2" name="english" placeholder="Type to translate"></textarea>
                </div>
                <input type="submit" name="submit" value="Translate!">
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
        <span class="option-text"><a class="option-text" href="translate.php?lang=en"><?php echo $lang['lang_en']; ?></a></span>
        </li>
        <li class="option">
        <span class="option-text"><a class="option-text" href="translate.php?lang=nl"><?php echo $lang['lang_nl']; ?></a></span>
        </li>
    </ul>
    </div>
    <p> <?php echo $lang['footer']; ?> </p>
    </footer>

</div>
</body>
<script src="dropdown.js"></script>
</html>

