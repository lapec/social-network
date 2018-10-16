<?php
include 'logincode.php';
include 'config/db_config.php';
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
// include 'logout.php';
$sql = "SELECT * FROM slike as A INNER JOIN korisnici AS b ON A.KID = B.KID";
$sql1 = "SELECT * FROM statusi as A INNER JOIN korisnici AS b ON A.KID = B.KID";
$query = $conn->query($sql);
$result = $query->fetch_assoc();
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
    
</head>
<body>
    <?php include "sections/navbar.php"?>

<div class="pageContainer"> 
<div class="leftColumn"> 
    <img class="profPicture" src="img/petprofilepic.png"> 
    <br>
    <br>
    <div class="userInfo">
        <table>
            <tr>
                <td>Full Name</td>
                <td><?php echo $result["Ime"]. " " . $result["Prezime"]  ?></td>
            </tr> 
            <tr>
                <td>Username</td>
                <td><?php echo $result["KorisnickoIme"]?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?php echo $result["Email"]?></td>
            </tr>
        </table> 
    </div>

<br>
<br>
<?php
    if($query->num_rows > 0){
    while($row = $query->fetch_assoc()): ?>

   
<div class="imgPost">
<p> <?php echo $row["VremePostavljanja"] ?></p>
<img src="<?php echo $row["LinkIzvoraSlike"] ?>"/>
</div>
    <?php endwhile;
    } ?>
</div>
    <div class="rightColumn">
    <?php
        $query1 = $conn->query($sql1);
        if($query1->num_rows > 0){
            while($row = $query1->fetch_assoc()):?>
            
        <div class="posts">
            <p><?php echo $row["TekstStatusa"] ?></p>
        </div>
        <?php endwhile; 
        };
    ?>
    </div>
</div>


</body>
</html>