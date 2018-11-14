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
    $sql = "SELECT * FROM korisnici AS a INNER JOIN slike AS b ON a.kid = b.kid WHERE a.kid = $n ORDER BY sid DESC";
    $sql1 = "SELECT * FROM statusi AS a INNER JOIN korisnici AS b on a.kid = b.kid WHERE a.kid = $n ORDER BY tid DESC";
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
            <img src="img/<?php echo $row["slikakorisnika"] ?>" alt="">
        </div>
        <?php 
            if ($_SESSION["KID"] === $n) {
                echo "<a href='profile.php'><button class='timelineProfileBtn'>Edit Profile</button></a>";
            }
        ?>
        

        <div class="timelinePersonalInfo">
            <div class="timelineInfoRow">
                <span class="timelineLeftInfo">Ime i Prezime:</span>
                <span><?php echo $row['ime']. ' ' . $row['prezime'] ?></span>
            </div>
            <div class="timelineInfoRow">
                <span class="timelineLeftInfo">Korisničko Ime:</span>
                <span><?php echo $row['korisnickoime'] ?></span>
            </div>
            <div class="timelineInfoRow">
                <span class="timelineLeftInfo">E-mail:</span>
                <span><?php echo $row['email'] ?></span>
            </div>
        </div>
        
        <?php
            if($result->num_rows > 0 ){
                while($x = $result->fetch_assoc()): ?>
                    <?php if($x['javnaprivatna'] == 0): ?>

                    <div class="timelinePost">
                        <div class="timelineVertLine"></div>
                        <div class="timelineDateRow">

                            <div class="timelineDateSlot">
                            <span><?php echo $x['vremepostavljanja'] ?></span>
                            </div>
                            <div class="timelineBall">
                            </div>
                        </div>
                        <div class="timelineText">
                            <img src="<?php 
                                echo $x['linkizvoraslike'];?>" alt="">
                        </div>
                    </div>
            
            <?php
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

                    <div class="timelinePost">

                        <div class="timelineVertLine"></div>

                        <div class="timelineDateRow">
                            <div class="timelineDateSlot">
                            <span><?php echo $x['vremepostavljanja'] ?></span>
                            </div>
                            <div class="timelineBall">
                            </div>
                        </div>
                        <div class="timelineText">
                            <?php echo $x['tekststatusa'] ?>
                        </div>
                    </div>

                    <?php    
                    endwhile;}
            ?>
     </div>
 </div>