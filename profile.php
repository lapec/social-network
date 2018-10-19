<?php session_start();
    if (!isset($_SESSION['user']) || !$_SESSION['user']) {
        header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>social-network</title>
	<link href="css/profile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
</head>
<body>
    <?php
    include "sections/navbar.php"; 
    include "config/db_config.php";
    include "profilecode.php";
    ?>
<div class="container">
    <main class="box">

        <div class="row2">
        <div class="column">
    	<img id src="img/<?php echo $userpic; ?>" height="300px" ><br><br>
        <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="image" /><br>
                <input class = "dropdownbtn" type="submit" value="UPLOAD IMAGE" />
            </form><br>
        </div>
            
  <div  class="column">
        <form action="" method="post">
        <input class="input-field" type="text" name="name" value="<?php echo $name; ?>" autocomplete="off"><br>
        <input class="input-field" type="text" name="lastname" value="<?php echo $lastname; ?>" autocomplete="off"><br>
        <input class="input-field" type="text" name="username" value="<?php echo $username; ?>" autocomplete="off"><br>
        <input type="submit" name="updateuserinfo" value = "UPDATE" class = "dropdownbtn">
    </form>
    </div>
    </div>
    <div class="hiddendiv">
    </div>
    <div class="row2">
        <div style="align: center;" class="column">

        <h4>Izmena postojećih statusa</h4>
        <br>
        <div id="vl">
        <form action="" method="post">
        <?php writePosts(); ?>
        <input type="submit" name="changeposts" value = "UPDATE" class = "dropdownbtn">
    </form>
</div>
</div>
<div style="text-align: center;" class="column">

    <h4>Promena lozinke</h4>
    <br>
    <form action="" method="post">
        <input class="input-field" type="text" name="currpass" placeholder="Unesite važeću lozinku" autocomplete="off">
    <br>
        <input class="input-field" type="text" name="newpass" placeholder="Unesite novu lozinku" autocomplete="off">
    <br>
        <input class="input-field" type="text" name="confirmpass" placeholder="Potvrdite novu lozinku" autocomplete="off">
    <br>
        <input type="submit" name="changepassword" value = "UPDATE" class = "dropdownbtn">
    </form>
    <h4 style="color: red"><?php echo $passerrorverify; ?><?php echo $passerrorconfirm; ?> <span style="color: limegreen"><?php echo $passsuccess; ?></span></h4>
</div>
</div>
    </main>
</div>
</body>
</html>