<?php
    include "languages/config.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title> A.I.P.I.M. | About Us </title>
	<link rel="stylesheet" href="css/aboutUs.css">
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
						<span class="option-text"><a class="option-text" href="aboutUs.php?lang=en"><?php echo $lang['lang_en']; ?></a></span>
					</li>
					<li class="option">
						<span class="option-text"><a class="option-text" href="aboutUs.php?lang=nl"><?php echo $lang['lang_nl']; ?></a></span>
					</li>
				</ul>
			</div>
			<ul class="nav">
				<li class="pages"> <a class="page-link" href="translateText.php"> <?php echo $lang['translate']; ?> </a> </li>
				<li class="pages"> <a class="page-link" href="aboutUs.php"> <?php echo $lang['about us']; ?> </a> </li>
			</ul>
		</div>
	</header>

	<h1> <?php echo $lang['h1']; ?> </h1>
	<div id="sectionOne">
		<div class="flex-item-left">
			<img src="https://fakeimg.pl/600x400/D9D9D9/909090?text=placeholder&font=noto-serif" alt="placeholder">
		</div>
		<div class="flex-item-right">
			<p> <?php echo $lang['p1']; ?> </p> 
			<p> <?php echo $lang['p2']; ?> </p>
		</div>
	</div>

	<div id="frame">  
		<p> <?php echo $lang['p3'] ?> </p>
		<img src="https://fakeimg.pl/600x400/D9D9D9/909090?text=placeholder&font=noto-serif" alt="placeholder">
	</div>
	<p id="paragraphOne"> <?php echo $lang['p4']; ?> </p>

	<h2> <?php echo $lang['h2']; ?> </h2>
	<p class="paragraphTwo"> <?php echo $lang['p5']; ?> </p> 
	<p class="paragraphTwo"> <?php echo $lang['p6']; ?> </p>

	<h3> <?php echo $lang['h3']; ?> About team A </h3>
	<div class="flex-item-left-2">
		<p> <?php echo $lang['p7']; ?> </p> 
		<p> <?php echo $lang['p8']; ?> </p>
	</div>
	<div class="flex-item-right-2">
		<img src="img/stendenlogo.jpg" alt="nhl">
	</div>

	<footer>
		<p> <?php echo $lang['footer']; ?> </p>
	</footer>
</div>
<script src="dropdown.js"></script>
</body>
</html>