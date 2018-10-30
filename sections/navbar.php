<nav>
    <div class="navbarcontainer">
    	<div class="navlogo">
        	<a href="dashboard.php">Social Network</a>
      	</div>
      	<div class="navuserinfo">
      		<a href="profile.php"><img class="navuserimg" src="img/<?php echo $_SESSION['SlikaKorisnika'];?>" /></a>
      		<a href="profile.php"><?php echo $_SESSION['lastname']." ".$_SESSION['name']; ?></a>
      		<a href="index.php"><button class="navbtn">Logout</button></a>
      	</div>
    </div>
</nav>