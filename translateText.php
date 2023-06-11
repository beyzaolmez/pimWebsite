<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $english = filter_input(INPUT_POST, "english", FILTER_SANITIZE_SPECIAL_CHARS);
        $dutch = filter_input(INPUT_POST, "dutch", FILTER_SANITIZE_SPECIAL_CHARS);
    }
    include "languages/config.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Translate text</title>
    <link rel="stylesheet" href="css/translate.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
<div id="container">
    <header>
		<div id="headerContainer">
			<div id="logo">
				<img src="img/logo.png" alt="logo">
				<p> A.I. P.I.M. </p>
			</div>
			<div class="select-menu">
				<div class="select-btn">
					<img src="img/globe-icon.jpg" alt="logo">
					<span class="sBtn-text">English</span>
					<i class="bx bx-chevron-down"></i>
				</div>
				<ul class="options">
					<li class="option">
						<span class="option-text"><a class="option-text" href="aboutUs.php?lang=en"><?php echo $lang['lang_en'] ?></a></span>
					</li>
					<li class="option">
						<span class="option-text"><a class="option-text" href="aboutUs.php?lang=nl"><?php echo $lang['lang_nl'] ?></a></span>
					</li>
				</ul>
			</div>
			<ul class="nav">
				<li class="pages"> <a class="page-link" href="translateText.php"> <?php echo $lang['translate']; ?> </a> </li>
				<li class="pages"> <a class="page-link" href="aboutUs.php"> <?php echo $lang['about us']; ?> </a> </li>
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
            <form method="POST" action="Translate-text.php">
                <div class="texts">
                    <textarea name="english" class="englishText" placeholder="Type to translate"></textarea>
                    <textarea name="dutch" class="dutchText"></textarea>
                </div>
                <input type="submit" name="submit" value="Translate!">
            </form>
        </div>
    </div>
    <footer>
        <p> brought to you by team A </p>
    </footer>
</div>
<script src="dropdown.js"></script>
</body>
</html>

