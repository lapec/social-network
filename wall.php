<?php
    require_once 'config/db_config.php';
    session_start();
    if (!isset($_SESSION['user']) || !$_SESSION['user']) {
        header('Location: index.php');
      }
    if(!empty($_GET['n'])){
    $n = $_GET['n'];
    }else{
    header('Location: dashboard.php');
    };
    $conn = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DBNAME);
    mysqli_set_charset($conn,"utf8");
    $sql2 = "SELECT * FROM korisnici WHERE KID = $n";
    $sql = "SELECT * FROM korisnici AS a INNER JOIN slike AS b ON a.KID = b.KID WHERE a.KID = $n ORDER BY SID DESC";
    $sql1 = "SELECT * FROM statusi AS a INNER JOIN korisnici AS b on a.KID = b.KID WHERE a.KID = $n ORDER BY TID DESC";
    $result = $conn->query($sql);
    $result2 = $conn->query($sql2);
    $row = $result2->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/wall.css">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    
</head>
<body>
    <?php include "sections/navbar.php"?>
<!-- Main Container -->
<div class="pageContainer"> 
    <!-- Left column container-->
    <div class="left column">
        <div class="profile-image">
            <img class="profilePic" src="img/<?php echo $row["SlikaKorisnika"] ?>" alt="">
        </div>
        <div class="personal-info">
            <div class="leftInfo">
                Full Name<br>
                Username<br>
                Email
            </div>
            <div class="rightInfo">
                <?php echo $row['Ime']. ' ' . $row['Prezime'] ?><br>
                <?php echo $row['KorisnickoIme'] ?><br>
                <?php echo $row['Email'] ?>
            </div>
        </div>
        <?php
            if($result->num_rows > 0 ){
                while($x = $result->fetch_assoc()): ?>
                        <?php if($x['JavnaPrivatna'] == 0): ?>
                        <div class="pictureAndDate">
                            <p><?php echo $x['VremePostavljanja'] ?></p>
                            <img class="image-post" src="<?php 
                                echo $x['LinkIzvoraSlike'];?>" alt="">
                        </div>
            
            <?php
            endif;
            endwhile;}
        ?>
    </div>
    <!--right column container-->
    <div class="right column">
        <div class="timeline">

            <?php
                $result1 = $conn->query($sql1);
                if($result1->num_rows > 0){
                    while($x = $result1->fetch_assoc()): ?>

                    <div class="commentBlock">
                
                        <div class="comment">
                            <p><?php echo $x['TekstStatusa'] ?></p>
                        </div>
                        <div class="ball">
                        </div>
                            <p class="centered-date"><?php echo $x['VremePostavljanja'] ?></p>
            
                    </div>
                    <?php    
                    endwhile;}
            ?>


            <div class="commentBlock">
                
                <div class="comment">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio sint vero consequatur quae incidunt adipisci nobis! Molestias beatae consequatur, tempore odit facilis ut dolores cupiditate? Dolorem, perferendis suscipit! Esse, labore.</p>
                </div>
                
                <div class="ball">
                </div>
                <p class="centered-date">20.20.2020</p>
                
            </div>
            <div class="commentBlock">
                
                <div class="comment">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio sint vero consequatur quae incidunt adipisci nobis! Molestias beatae consequatur, tempore odit facilis ut dolores cupiditate? Dolorem, perferendis suscipit! Esse, labore.</p>
                </div>
                <div class="line"></div>
                <div class="ball">
                </div>
                <p class="centered-date">20.20.2020</p>
            
            </div>
         </div>            


    </div>

</div>