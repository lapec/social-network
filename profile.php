<?php session_start();
    if (!isset($_SESSION['user']) || !$_SESSION['user']) {
        header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>social-network</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <div class="content">
    <main>
        <div class="gornjideo">
        <div class="levideo">
    	<img class="userimage" src="img/<?php echo $userpic; ?>">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="image" id="picker" class="dropdownbtn browsebtn"/>
            <label for="picker">ODABERITE SLIKU</label>
            <input class="dropdownbtn imgbutton" type="submit" value="UPLOAD" />
        </form>
        <div class="alert"><?php echo $imgerror; ?></div>
        </div>
            
  <div  class="desnideo">
        <form action="" method="post">
        <input class="input-field" type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" autocomplete="off">
        <input class="input-field" type="text" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>" autocomplete="off">
        <input class="input-field" type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" autocomplete="off">
        <input type="submit" name="updateuserinfo" value = "UPDATE" class = "dropdownbtn">
    </form>
    <div class="alert"><?php echo $infoerror; ?></div>
    </div>
    </div>
    <div class="belalinija">
    </div>
    <div class="donjideo">
        <div class="donjilevideo">
        <h4>Izmena postojećih statusa</h4>
        <br>
        <form action="" method="post">
        <?php writePosts(); ?>
        <input type="submit" name="changeposts" value = "UPDATE" class = "dropdownbtn" <?php echo $hideupdatebutton; ?> >
    </form>
</div>
<div id="vl"></div>
<div class="donjidesnideo">

    <h4>Promena lozinke</h4>
    <br>
    <form action="" method="post">
        <input class="input-field" type="password" name="currpass" placeholder="Unesite važeću lozinku" autocomplete="off"><br>
        <input class="input-field" type="password" name="newpass" placeholder="Unesite novu lozinku" autocomplete="off"><br>
        <input class="input-field" type="password" name="confirmpass" placeholder="Potvrdite novu lozinku" autocomplete="off"><br>
        <input type="submit" name="changepassword" value = "UPDATE" class = "dropdownbtn">
    </form>
    <div class="alert"><?php echo $passerror; ?></div>
</div>
</div>
    </main>
</div>
</div>

</body>
</html>