<nav>
  <span class="brand"><a href="dashboard.php">Social-network</a></span>
  <a href="index.php" style="float:right; margin-right: 5%; margin-top: 12px;">Logout</a>
  <a href="profile.php" style="float:right; margin-right: 2%;">
    <img src="img/<?php echo $_SESSION['SlikaKorisnika'];?>" />
    	<?php echo $_SESSION['lastname']." ".$_SESSION['name']; ?> 
  </a>
</nav>