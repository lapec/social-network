<?php require "config/db_config.php"; ?>


<?php

$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);

	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

$slikaID = $_GET['slikaID'];
$sql = "SELECT * FROM komentari_slike INNER JOIN korisnici ON komentari_slike.KID = korisnici.KID WHERE komentari_slike.SID = '".$slikaID."' ORDER BY VremePostavljanja DESC";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) { ?>
			<div align="center" id="printText">
				<div class="row" id= "imgComm">
					<img src="img/<?php echo $row["SlikaKorisnika"] ?>">
					<span id="fullName"><?php echo htmlspecialchars($row["Ime"]." ".$row["Prezime"]) ?></span><br>
					<span class="postTxt" id="postTxt"><?php echo htmlspecialchars($row["Komentar"]) ?></span><br>
					
					<br><div id="like"><pre>Like Comment</pre></div><span class="dateTime"><?php echo htmlspecialchars($row["VremePostavljanja"]) ?></span>
				</div>
			</div>
		<?php	}
	} else {
		echo "No comments yet...";
	}
	$conn->close();

?>