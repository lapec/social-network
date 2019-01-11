<nav>
    <div class="navbarcontainer">
    	  <div class="navlogo">
        	<a href="dashboard.php">Social Network</a>
      	</div>
      	<div class="navuserinfo">
      		<a href="wall.php?n=<?php echo $_SESSION["KID"] ?>"><img class="navuserimg" src="img/<?php echo $_SESSION['SlikaKorisnika'];?>" /></a>
      		<a href="wall.php?n=<?php echo $_SESSION["KID"] ?>" id="navdisplayname"><?php echo $_SESSION['lastname']." ".$_SESSION['name']; ?></a>
      		<a href="index.php"><button class="navbtn"><i class="fa fa-sign-out fa-lg"></i><span id="navlogouttxt"> Logout</span></button></a>
      	</div>
    </div>
</nav>