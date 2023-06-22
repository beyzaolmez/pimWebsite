<?php
    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['user_name'];
        $isLoggedIn = true;
    } else {
        $isLoggedIn = false;
    }
?>
<header>
	<div id="headerContainer">
			<p id="logo"> A.I. P.I.M. </p>
			<nav>
				<ul>
					<li> <a href="">Translate</a></li>
					<li> <a href="">Quiz</a></li>
					<li> <a href="">Chat</a></li>
					<li> <a href="">About</a></li>
				</ul>
			</nav>
			<div class="profile">
				<?php 
					if ($isLoggedIn) {
				?>
				<p>Welcome, <br> <?php echo $user_name; ?></p>
				<?php 
					} else {
				?>
				<a href="signIn.php">Sign in</a>
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
	<a href="">Translate</a>
	<a href="">Quiz</a>
	<a href="">Chat</a>
	<a href="">About</a>
	<br>
	<div class="menu-profile">
		<!-- this is shown when user isn't logged in -->
		<a href="">Sign in</a>
		<!-- this is shown when user is logged in 
		<p> Welcome, <br> User </p> -->
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
