<?php session_start();?>
<?php require "config/db_config.php"; ?>


<?php
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
// Change character set to utf8
mysqli_set_charset($conn,"utf8");
		$ok = true;
		$posttext = mysqli_real_escape_string($conn, $_POST['postComment']);
		$slikaID = mysqli_real_escape_string($conn, $_POST['slikaID']); 
		if ($ok == "true") {
			$posttime = date("Y-m-d H:i:s");
			$currentUserID = $_SESSION['KID'];
			$sql = "INSERT INTO `komentari_slike` (sid, kid, komentar, vremepostavljanja) VALUES ('".$slikaID."','".$currentUserID."', '".$posttext."','".$posttime."')";
			if ($conn->query($sql) !== true) {
				echo "Error: " . $sql . "<br>" . $conn->error . "<br><br>";
			} else {
				$sql = "SELECT * FROM komentari_slike INNER JOIN korisnici ON komentari_slike.kid = korisnici.kid WHERE komentari_slike.sid = '".$slikaID."' ORDER BY vremepostavljanja DESC LIMIT 1";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) { ?>
						<div id="printText">
							<div class="row" id= "imgComm">
								<a href="wall.php?n=<?php echo $row["kid"] ?>">
								<div class="imgBox"><img src="img/<?php echo $row["slikakorisnika"] ?>"></div>
								</a>
								<span id="fullName"><a href="wall.php?n=<?php echo $row["kid"] ?>"><?php echo htmlspecialchars($row["ime"]." ".$row["prezime"]) ?></a></span><br>
								<span class="postTxt" id="postTxt"><?php echo htmlspecialchars($row["komentar"]) ?></span><br>
								<br><div id="like"><pre>Like    Comment</pre></div><span class="dateTime"><?php echo htmlspecialchars($row["vremepostavljanja"]) ?></span>
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
