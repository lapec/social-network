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

  <div class="dashcontainer">
    <div class="dashcontent">

      <div class="dashinsertpost">
        <div class="dashinsertpostuserimg">
          <img src="img/<?php echo $_SESSION["SlikaKorisnika"] ?>" />
        </div>
        <div class="dashinputform">
          <form action="uploadimg.php" method="post" enctype="multipart/form-data">
            <textarea class="dashonyourmind" name="statusContent" autocomplete="off" maxlength="140" placeholder="What's on your mind?"></textarea>
            <div class="dashbottominsert">
              <div>
                <input type="file" name="fileToUpload" id="fileToUpload" class="dashbrowsebtn dashbtn"/>
                <label for="fileToUpload">Odaberi datoteku:</label>
                <select name="pubSelect" id="pubselect">
                  <option value="0" selected >Javna</option>
                  <option value="1">Privatna</option>
                </select>
              </div>
              <input class="dashbtn" type="submit" name="insertPost" id="kreirajPost" value="Kreiraj post" />
            </div>
          </form>
        </div>
      </div>
    
  <?php
    if ($result->num_rows > 0) { 
    // output data of each row
    ?>
    <?php while($row = $result->fetch_assoc()): ?>
    <?php if (!empty(trim($row['TekstStatusa'], " ")) || !empty($row['LinkIzvoraSlike'])): ?>
       <div align="center" id="printText">
         <div class="dashboard-post-row">
            <div class="dashboard-usr-pict">
              <img src="img/<?php echo $row["SlikaKorisnika"] ?>">
            <div class="userNameDiv">
              <a href="wall.php?n=<?php echo $row["KID"] ?>">
                <span id="fullName"> <?php echo $row["Ime"]." ".$row["Prezime"];?>
                </span>
              </a><br>
            <span class="timePost"><?php echo $row['v2'] ?></span>
            </div>
          </div>
            <div class="outPict"><?php
              if (($row['JavnaPrivatna'] === 1) || $row['KID'] === $_SESSION['KID']) {
                  echo '<img class="postImg clickableImage" id="'.$row['SID'].'" src="'.$row['LinkIzvoraSlike'].'">'; 
            } elseif ($row['JavnaPrivatna'] === 0) {
                echo '<img class="postImg clickableImage" id="'.$row['SID'].'" src="'.$row['LinkIzvoraSlike'].'">';
              } else {
                  echo " ";
              } 
            ?>
            </div>
            <div id="postTxt">
             <?php 
  			      echo $row["TekstStatusa"];
              ?>
           </div>
        </div>
      </div>

    
	<?php 
		endif;
        endwhile; 
        
    } 
    // zatvaramo konekciju ka bazi
    $conn->close();
?>
</div>
</div>
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