<?php


    if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['user_name'];
        $isLoggedIn = true;
    } else {
        $isLoggedIn = false;
    }
?>

<?php
    include "languages/config.php";
?>

<header>
	<div id="headerContainer">
			<p id="logo"> A.I. P.I.M. </p>
			<nav>
				<ul>
					<li> <a href="translateText.php"> <?php echo $lang["Translate"]; ?></a></li>
					<li> <a href="selectQuiz.php"> <?php echo $lang["Quiz"]; ?></a></li>
					<li> <a href="conversation.php"> <?php echo $lang["Chat"]; ?></a></li>
					<li> <a href="aboutUs.php"> <?php echo $lang["About"]; ?></a></li>
				</ul>
			</nav>
			<div class="profile">
				<?php 
					if ($isLoggedIn) {
				?>
				<p> <?php echo $lang["welcome"]; ?> <br> <?php echo $user_name; ?></p>
				<?php 
					} else {
				?>
				<a href="signIn.php"> <?php echo $lang["signIn"]; ?></a>
				<?php 
					} 
				?>
				<img src="img/profile-icon.png" alt="user icon">
			</div>
			<div class="mobilebutton"><span onclick="openMenu()"> <img src="img/menu.png" alt="menu icon"> </span></div>
	</div>
</header>
<div id="menu" class="menu">
	<a href="javascript:void(0)" class="close" onclick="closeMenu()">✖</a>
	<a href="translate.php"> <?php echo $lang["Translate"]; ?></a>
	<a href="test.php"> <?php echo $lang["Quiz"]; ?></a>
	<a href="conversation.php"> <?php echo $lang["Chat"]; ?></a>
	<a href="aboutUs.php"> <?php echo $lang["About"]; ?></a>
	<br>
	<div class="profile">
		<?php 
			if ($isLoggedIn) {
		?>
		<p> <?php echo $lang["welcome"]; ?> <br> <?php echo $user_name; ?></p>
		<?php 
			} else {
		?>
		<a href="signIn.php"> <?php echo $lang["signIn"]; ?></a>
		<?php 
			} 
		?>
		<img src="img/profile-icon.png" alt="user icon">
	</div>
</div>

<script>
function openMenu() {
	document.getElementById("menu").style.width = "auto";
}

function closeMenu() {
	document.getElementById("menu").style.width = "0";
}
</script>
