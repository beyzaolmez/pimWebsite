<?php
    include "languages/config.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title> A.I.P.I.M. | About Us </title>
	<link rel="stylesheet" href="css/aboutUs.css">
	<link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
<div id="container">

<?php include_once "header.php"; ?>

	<h1> <?php echo $lang['h1']; ?> </h1>
	<div id="sectionOne">
		<div class="flex-item-left">
			<img src="img/blenderSketch.jpeg" alt="placeholder">
		</div>
		<div class="flex-item-right">
			<p> <?php echo $lang['p1']; ?> </p> 
			<p> <?php echo $lang['p2']; ?> </p>
		</div>
	</div>

	<div id="frame">  
		<p> <?php echo $lang['p3'] ?> </p>
		<img src="img/PIM%20final.jpeg" alt="placeholder">
	</div>
	<p id="paragraphOne"> <?php echo $lang['p4']; ?> </p>

	<h2> <?php echo $lang['h2']; ?> </h2>
	<p class="paragraphTwo"> <?php echo $lang['p5']; ?> </p> 
	<p class="paragraphTwo"> <?php echo $lang['p6']; ?> </p>

	<h3> <?php echo $lang['h3']; ?> </h3>
	<div class="flex-item-left-2">
		<p> <?php echo $lang['p7']; ?> </p> 
		<p> <?php echo $lang['p8']; ?> </p>
	</div>
	<div class="flex-item-right-2">
		<img src="img/stendenlogo.jpg" alt="nhl">
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
        <span class="option-text"><a class="option-text" href="aboutUs.php?lang=en"><?php echo $lang['lang_en']; ?></a></span>
        </li>
        <li class="option">
        <span class="option-text"><a class="option-text" href="aboutUs.php?lang=nl"><?php echo $lang['lang_nl']; ?></a></span>
        </li>
    </ul>
    </div>
    <p> <?php echo $lang['footer']; ?> </p>
    </footer>

</div>
</body>
<script src="dropdown.js"></script>
</html>