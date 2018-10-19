<?php include "config/db_config.php"; ?>

<?php
session_start();
if (!isset($_SESSION['user']) || !$_SESSION['user']) {
  header('Location: index.php');
}
?>
<?php
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Change character set to utf8
mysqli_set_charset($conn,"utf8");


$sql = "
        SELECT korisnici.Ime, korisnici.Prezime, korisnici.SlikaKorisnika,korisnici.KID, statusi.KID, slike.LinkIzvoraSlike, slike.VremePostavljanja AS v1, slike.JavnaPrivatna, slike.KID, statusi.TekstStatusa, statusi.VremePostavljanja AS v2 FROM 
        ( (statusi INNER JOIN korisnici ON statusi.KID = korisnici.KID) 
        LEFT JOIN slike ON statusi.VremePostavljanja = slike.VremePostavljanja) UNION 
        SELECT korisnici.Ime, korisnici.Prezime, korisnici.SlikaKorisnika, korisnici.KID, statusi.KID, slike.LinkIzvoraSlike, slike.VremePostavljanja AS v1, slike.JavnaPrivatna, slike.KID, statusi.TekstStatusa, statusi.VremePostavljanja AS v2 FROM 
        ( (statusi INNER JOIN korisnici ON statusi.KID = korisnici.KID) 
        RIGHT JOIN slike ON statusi.VremePostavljanja = slike.VremePostavljanja) ORDER BY v1 DESC;";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
	<title>social network</title>
	<link href="css/dashboard.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		form {
			display: inline;
		}
	</style>
</head>
<body>
	<?php include "sections/navbar.php"; ?>
    <div align="center" id="insertPost">
        <img src="img/profile.gif"/>

       <form action="uploadimg.php" method="post" enctype="multipart/form-data">
          <input type="text" name="statusContent" id="onYourMind" placeholder="What's on your mind ?"/>

          <input type="file" name="fileToUpload" id="fileToUpload" placeholder="Odaberi datoteku:"
        style="visibility: hidden">
     <div class="btnUpload">
       <label for="fileToUpload" class="dgm">Odaberi datoteku:</label>
     </div>
       <div class="rightSide">
       <select name="pubSelect" id="pubSelect">
         <option value="0">Javna</option>
         <option value="1">Privatna</option>
       </select>

       <input type="submit" name="insertPost" id="kreirajPost" value="Kreiraj post" />
       </div>
       </form>

    </div>
<?php
    if ($result->num_rows > 0) { 
    // output data of each row
    ?>
    <?php while($row = $result->fetch_assoc()): ?>
       <div align="center" id="printText">
         <div class="row">
          <div class="usrPict">
            <img src="img/<?php echo $row['SlikaKorisnika']; ?>">
          </div>
           <span id="fullName">
               <?php echo $row["Ime"]." ".$row["Prezime"]; ?></span>
          <div class="outPict"></div>
           <div id="postTxt">
             <?php 
            if (($row['JavnaPrivatna'] === 1) || $row['KID'] === $_SESSION['KID']) {
                  echo '<img class="postImg clickableImage" id="'.$row['SID'].'" src="'.$row['LinkIzvoraSlike'].'">'; 

              } elseif ($row['JavnaPrivatna'] === 0) {
                  echo '<img src="'.$row['LinkIzvoraSlike'].'">';

              } else {
                  echo " ";
              }
                          
             echo $row["TekstStatusa"];
            ?>
           </div>
    <?php endwhile; 
        
    } else {
        echo "0 results";
    }
    // zatvaramo konekciju ka bazi
    $conn->close();
?>

<div id="popupContainer">
  <div id="popupContent">
    <div class="leftColumn" id="photoContainer" name=""></div>
    <div class="rightColumn">
      <div id="popupTopBar">
        <span id="closePopup">X</span>
      </div>
      <div id="imgComment"></div>
      <div id="comment">
        <form action="insertComments.php" method="post">
        <input id="forma" type="text" name="postComment" placeholder="Comment" autocomplete="off" /><br/>
        <input type="hidden" id="slikaID" name="slikaID" value="">
        <button id="submitComment" name="submitComment" type="submit">Submit</button>
      </div>
    </div>
  </div>
</div>
<script src="clickableImage.js"></script>
</body>
</html>