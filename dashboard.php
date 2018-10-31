<?php include "config/db_config.php"; ?>

<?php
function var_error_log( $object=null ){
  ob_start();                    // start buffer capture
  var_dump( $object );           // dump the values
  $contents = ob_get_contents(); // put the buffer into a variable
  ob_end_clean();                // end capture
  error_log( $contents );        // log contents of the result of var_dump( $object )
};
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
        SELECT korisnici.Ime, korisnici.Prezime, korisnici.SlikaKorisnika,korisnici.KID, statusi.KID, slike.LinkIzvoraSlike, slike.VremePostavljanja AS v1, slike.JavnaPrivatna, slike.SID,slike.KID, statusi.TekstStatusa, statusi.VremePostavljanja AS v2 FROM 
        ( (statusi INNER JOIN korisnici ON statusi.KID = korisnici.KID) 
        LEFT JOIN slike ON statusi.VremePostavljanja = slike.VremePostavljanja) UNION 
        SELECT korisnici.Ime, korisnici.Prezime, korisnici.SlikaKorisnika, korisnici.KID, statusi.KID, slike.LinkIzvoraSlike, slike.VremePostavljanja AS v1, slike.JavnaPrivatna, slike.SID, slike.KID, statusi.TekstStatusa, statusi.VremePostavljanja AS v2 FROM 
        ( (statusi INNER JOIN korisnici ON statusi.KID = korisnici.KID) 
        RIGHT JOIN slike ON statusi.VremePostavljanja = slike.VremePostavljanja) ORDER BY v2 DESC;";
$result = $conn->query($sql);
var_error_log($_SESSION);
?>
<!DOCTYPE html>
<html>
<head>
	<title>social network</title>
  <link rel="stylesheet" href="css/normalize.css" />
	<link href="css/dashboard.css" rel="stylesheet">
  <link href="css/navbar.css" rel="stylesheet">
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
        <img src="img/<?php echo $_SESSION["SlikaKorisnika"] ?>"/>

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
    <?php if (!empty(trim($row['TekstStatusa'], " ")) || !empty($row['LinkIzvoraSlike'])): ?>
       <div align="center" id="printText">
         <div class="row">
            <div class="usrPict">
              <img src="img/<?php echo $row["SlikaKorisnika"] ?>">
           </div>
           <a href="wall.php?n=<?php echo $row["KID"] ?>"><span id="fullName">
             <?php echo $row["Ime"]." ".$row["Prezime"];?></span></a>
            <span><?php echo $row['v2'] ?></span>
           <div class="outPict"></div>
           <div id="postTxt">
             <?php 
            if (($row['JavnaPrivatna'] === 1) || $row['KID'] === $_SESSION['KID']) {
                  echo '<img class="postImg clickableImage" id="'.$row['SID'].'" src="'.$row['LinkIzvoraSlike'].'">'; 
            } elseif ($row['JavnaPrivatna'] === 0) {
                echo '<img class="postImg clickableImage" id="'.$row['SID'].'" src="'.$row['LinkIzvoraSlike'].'">';
              } else {
                  echo " ";
              }
			      echo $row["TekstStatusa"];
            ?>
           </div>
        </div>
	<?php 
		endif;
        endwhile; 
        
    } 
    // zatvaramo konekciju ka bazi
    $conn->close();
?>
<!-- START popupContainer --> 
<div id="popupContainer">
  <div id="popupContent">
    <div class="leftColumn" id="photoContainer" name=""></div>
    <div class="rightColumn">
      <div id="popupTopBar">
        <span id="closePopup">X</span>
      </div>
      <div id="imgComment"></div>
      <span class="load-more">Load More Comments</span>
      <div id="comment">
        <div class="usrImg">
          <img class="usrImg1" src="img/<?php echo $_SESSION['SlikaKorisnika']; ?>">
        </div>
        <div class="usrCom">
          <input id="forma" type="text" name="postComment" placeholder="  Write a comment..." autocomplete="off" /><br/>
          <input type="hidden" id="slikaID" name="slikaID" value="">
          <button id="submitComment" name="submitComment" type="submit">Comment</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END popupContainer --> 
<script src="clickableImage.js"></script>
</body>
</html>