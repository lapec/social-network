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
$timestamp = time();

if(isset($_POST['insertPost'])){
    $statusContent = $_POST['statusContent'];
    $sqlInsert = "INSERT INTO statusi(TID, KID, TekstStatusa, VremePostavljanja) VALUES (null, 1, '".$statusContent."','".$timestamp."')";
    $resultInsert = $conn->query($sqlInsert);
    if ($resultInsert === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sqlInsert . "<br>" . $conn->error."<br>";
    }
}

$sql = "SELECT * FROM statusi INNER JOIN korisnici ON statusi.KID = korisnici.KID;";
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
        <form action="dashboard.php" method="post">
	      <input type="text" name="statusContent" placeholder="Whats on your mind ?"/>
	      <input type="submit" name="insertPost" value="Kreiraj post" />
        </form>
	</div>

<?php
    if ($result->num_rows > 0) { 
    // output data of each row
    ?>
    <?php while($row = $result->fetch_assoc()): ?>
       <div align="center" id="printText">
         <div class="row">
           <img src="img/<?php echo $row['SlikaKorisnika']; ?>">
           <span id="fullName">
               <?php echo $row["Ime"]." ".$row["Prezime"] ?></span>
           <div id="postTxt">
             <?php echo $row["TekstStatusa"]; ?>
           </div>
           <div class="imgDiv" >
            <img class="postImg clickableImage" id="<?php echo $row['SID']?>" src="uploads/<?php echo $row['ImeSlike']?>"> <!-- potrebno dodati ovaj PHP id kako bi se pokretala js funkcija --> 
            </div>
           <br><div id="like">Like Comment</div>
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
    <div class="leftColumn" id="photoContainer"></div>
    <div class="rightColumn">
      <div id="popupTopBar">
        <span id="closePopup">X</span>
      </div>
      <div id="komentar">bla</div>
      <div id="comment" placeholder="Comment">
        <form action="insertComments.php" method="post">
        <input id="forma" type="text" name="komentar" placeholder=" What's on your mind?" autocomplete="off" /><br/>
        <button id="submitComment" type="submit">Submit</button>
      </div>
    </div>
  </div>
</div>
<script src="clickableImage.js"></script>
</body>
</html>