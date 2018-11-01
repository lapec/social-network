<?php session_start();?>
<?php require "config/db_config.php"; ?>


<?php
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);

	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
		$ok = true;
		$posttext = mysqli_real_escape_string($conn, $_POST['postComment']);
		$slikaID = mysqli_real_escape_string($conn, $_POST['slikaID']); 
		if ($ok == "true") {
			$posttime = date("Y-m-d H:i:s");
			$currentUserID = $_SESSION['KID'];
			$sql = "INSERT INTO `komentari_slike` (SID, KID, Komentar, VremePostavljanja) VALUES ('".$slikaID."','".$currentUserID."', '".$posttext."','".$posttime."')";
			if ($conn->query($sql) !== true) {
				echo "Error: " . $sql . "<br>" . $conn->error . "<br><br>";
			} else {
				$sql = "SELECT * FROM komentari_slike INNER JOIN korisnici ON komentari_slike.KID = korisnici.KID WHERE komentari_slike.SID = '".$slikaID."' ORDER BY VremePostavljanja DESC LIMIT 1";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) { ?>
						<div id="printText">
							<div class="row" id= "imgComm">
								<a href="wall.php?n=<?php echo $row["KID"] ?>">
								<img src="img/<?php echo $row["SlikaKorisnika"] ?>">
								</a>
								<span id="fullName"><a href="wall.php?n=<?php echo $row["KID"] ?>"><?php echo htmlspecialchars($row["Ime"]." ".$row["Prezime"]) ?></a></span>
								<div class="postTxt" id="postTxt"><?php echo htmlspecialchars($row["Komentar"]) ?></div>
								<div class="dateTime"><?php echo htmlspecialchars($row["VremePostavljanja"]) ?></div>
								<br><div id="like"><pre>Like    Comment</pre></div>
							</div>
						</div>
					<?php	}
				} else {
					echo "No comments yet...";
				}
			}
		}
	$conn->close();
?>
