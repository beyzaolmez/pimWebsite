<?php
    include "languages/config.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Select quiz</title>
    <link rel="stylesheet" href="css/selectQuiz.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>

    <body>
        <div id="container">

            <?php include_once "header.php"; ?>

            <div id="intro">
                <h2 class="first"><?php echo $lang['welcome']; ?></h2>
                <h1 class="second"><?php echo $lang['what3']; ?></h1>
            </div>
            <div class="checkLevel">
                <h2><?php echo $lang['check']; ?></h2>
                <div class="box1">
                    <h3><?php echo $lang['check-h3']; ?></h3>
                    <p><?php echo $lang['level']; ?></p>
                </div>
            </div>
            <div class="levelQuiz">
                <h2><?php echo $lang['take']; ?></h2>
                <div class="box2">
                    <h3><?php echo $lang['take-h3']; ?></h3>
                    <ul>
                        <li><?php echo $lang['beginner']; ?></li>
                        <li><?php echo $lang['mid']; ?></li>
                        <li><?php echo $lang['advanced']; ?></li>
                    </ul>
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
                <span class="option-text"><a class="option-text" href="selectQuiz.php?lang=en"><?php echo $lang['lang_en']; ?></a></span>
                </li>
                <li class="option">
                <span class="option-text"><a class="option-text" href="selectQuiz.php?lang=nl"><?php echo $lang['lang_nl']; ?></a></span>
                </li>
            </ul>
            </div>
            <p> <?php echo $lang['footer']; ?> </p>
            </footer>

        </div>
    </body>
    <script src="dropdown.js"></script>
</html>
