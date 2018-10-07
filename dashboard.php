<!DOCTYPE html>
<html>
<head>
	<title>social network</title>
	<link href="css/dashboard.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
</head>
<body>
	<?php include "navbar.php"; ?>
	<div align="center" id="insertPost">
	    <img src="img/profile.gif"/>
	    <input type="text" placeholder="Whats on your mind ?"/>
	    <input type="submit" name="insertPost" value="Kreiraj post" />
	</div>

	<div align="center" id="printText">
		<div class="row">
			<img src="img/profile2.png">
			<span id="fullName">John Smith</span>
			<div id="postTxt">lorem ipsum dolor amet</div>
			<br><div id="like">Like Comment</div>
		</div>
	</div>

	<div align="center" id="printText">
		<div class="row">
			<img src="img/female-profile-img.jpg">
			<span id="fullName">Tricia Teahan</span>
			<div id="postTxt">lorem ipsum dolor amet</div>
			<br><div id="like">Like Comment</div>
		</div>
	</div>
</body>
</html>