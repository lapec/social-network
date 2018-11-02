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
    <link rel="stylesheet" href="css/normalize.css" />
    <link href="css/wall.css" rel="stylesheet">
    <link href="css/navbar.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
</head>
<body>
    <?php include "sections/navbar.php"?>

<div class="timelineContainer"> 

    <div class="timelineCol">
        <div class="timelineProfilePic">
            <img src="img/<?php echo $row["SlikaKorisnika"] ?>" alt="">
        </div>
        <?php 
            if ($_SESSION["KID"] === $n) {
                echo "<a href='profile.php'><button class='timelineProfileBtn'>Edit Profile</button></a>";
            }
        ?>
        

        <div class="timelinePersonalInfo">
            <div class="timelineInfoRow">
                <span class="timelineLeftInfo">Ime i Prezime:</span>
                <span><?php echo $row['Ime']. ' ' . $row['Prezime'] ?></span>
            </div>
            <div class="timelineInfoRow">
                <span class="timelineLeftInfo">Korisničko Ime:</span>
                <span><?php echo $row['KorisnickoIme'] ?></span>
            </div>
            <div class="timelineInfoRow">
                <span class="timelineLeftInfo">E-mail:</span>
                <span><?php echo $row['Email'] ?></span>
            </div>
        </div>
        
        <?php
            if($result->num_rows > 0 ){
                while($x = $result->fetch_assoc()): ?>
                    <?php if($x['JavnaPrivatna'] == 0): ?>
                    <?php if(!empty($x['LinkIzvoraSlike'])): ?>
                    <div class="timelinePost">
                        <div class="timelineVertLine"></div>
                        <div class="timelineDateRow">

                            <div class="timelineDateSlot">
                            <span><?php echo $x['VremePostavljanja'] ?></span>
                            </div>
                            <div class="timelineBall">
                            </div>
                        </div>
                        <div class="timelineText">
                            <img src="<?php echo $x['LinkIzvoraSlike'];?>" alt="">
                        </div>
                    </div>
            <?php
            endif;
            endif;
            endwhile;}
        ?>

    </div>
    
    <div class="timelineSeparator"></div>

    <div class="timelineCol">
        <div class="timelineHorLine"></div>
            <?php
                $result1 = $conn->query($sql1);
                if($result1->num_rows > 0){
                    while($x = $result1->fetch_assoc()): ?>
                    <?php if (!empty(trim($x['TekstStatusa'], " "))): ?>
                    <div class="timelinePost">

                        <div class="timelineVertLine"></div>

                        <div class="timelineDateRow">
                            <div class="timelineDateSlot">
                            <span><?php echo $x['VremePostavljanja'] ?></span>
                            </div>
                            <div class="timelineBall">
                            </div>
                        </div>
                        <div class="timelineText">
                            <?php echo $x['TekstStatusa'] ?>
                        </div>
                    </div>
                    
                    <?php 
                    endif;  
                    endwhile;}
            ?>
     </div>
 </div>