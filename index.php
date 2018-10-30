<?php
require_once('config/db_config.php');
require_once('registercode.php');
// login
require_once('logincode.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Social Network</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
  <!--Main Container-->
  <div class="main-container">

    <!--Main Navigation-->
    <div class="navigation">
      <div class="logo">
        <a href="#"><h1>Social Network</h1></a>
      </div>
      <div class="login">
        <form action="" method="post">
          <input type="text" name="usernamelg" placeholder="username" class="username">
          <input type="password" name="passwordlg" placeholder="password" class="password">
          <input class="btn" type="submit" name="login" value="Login" />
        </form>
      </div>
    </div>
    <!--Main Navigation END-->

    <main class="container">
      
      <div class="box1">
        <img src="img/1.jpg" alt="social-network" class="img1">
      </div>
      <div class="box2">
      <div >
            <?php if(isset($_COOKIE['loginfail'])){
                            echo $_COOKIE['loginfail'];
                          };
            ?>
      </div>
        <img src="img/2.jpg" alt="social-network" class="img2">
        <div class="card">
        <form action="registercode.php" method='POST'>
          <input type="text" name="name" placeholder="name" class="name" required>
          <input type="text" name="lastname" placeholder="lastname" class="lastname" required>
          <input type="email" name="email" placeholder="email" class="email" required>
          <input type="text" name="username" placeholder="username" class="username2" required>
          <input type="password" name="password" placeholder="password" class="password2" required>
          <input class="btn2" type="submit" name="login" value="Sign Up" />
          </form>
          <?php if(isset($_COOKIE['invalidUN'])){
                    echo $_COOKIE['invalidUN'];
                  } else {
                unset($_COOKIE['invalidUN']);
              };?>
          <h3>welcome</h3>
          <p>welcome to the lazy-dev network <br> fill the data and join us !</p>
        </div>
      </div>
    </main>
  </div>
  <!--Main Container END-->
</body>
</html>
