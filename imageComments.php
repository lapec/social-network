<?php require "config/db_config.php"; ?>


<?php

$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);

	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
$limit = $_GET['limit'];
$offset = $_GET['offset'];
$slikaID = $_GET['slikaID'];
$data = "SELECT * FROM komentari_slike INNER JOIN korisnici ON komentari_slike.KID = korisnici.KID WHERE komentari_slike.SID = '".$slikaID."' ORDER BY VremePostavljanja DESC LIMIT ".$limit." OFFSET ".$offset;
	
// echo $data; die();
$result = $conn->query($data);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) { ?>
			<div id="printText" class="printText">
				<div class="row" id= "imgComm">
					<img src="img/<?php echo $row["SlikaKorisnika"] ?>">
					<span id="fullName"><a href="wall.php?n=<?php echo $row["KID"] ?>"><?php echo htmlspecialchars($row["Ime"]." ".$row["Prezime"]) ?></a></span>
					<div class="postTxt" id="postTxt"><?php echo htmlspecialchars($row["Komentar"]) ?></div>
					<div class="dateTime"><?php echo htmlspecialchars($row["VremePostavljanja"]) ?></div>
					<br><div id="like"><pre>Like    Comment</pre></div>
				</div>
			</div>
		<?php	}
	}
	$conn->close();

?>