<?php require "config/db_config.php"; ?>


<?php

$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);


	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
// Change character set to utf8
mysqli_set_charset($conn,"utf8");
$limit = $_GET['limit'];
$offset = $_GET['offset'];
$slikaID = $_GET['slikaID'];
$data = "SELECT * FROM komentari_slike INNER JOIN korisnici ON komentari_slike.kid = korisnici.kid WHERE komentari_slike.sid = '".$slikaID."' ORDER BY vremepostavljanja DESC LIMIT ".$limit." OFFSET ".$offset;
	
// echo $data; die();
$result = $conn->query($data);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) { ?>
			<div id="printText" class="printText">
				<div class="row" id= "imgComm">
					<a href="wall.php?n=<?php echo $row["kid"] ?>">
						<div class="imgBox"><img src="img/<?php echo $row["slikakorisnika"] ?>"></div>
					</a>
					<span id="fullName"><a href="wall.php?n=<?php echo $row["kid"] ?>"><?php echo htmlspecialchars($row["ime"]." ".$row["prezime"]) ?></a></span><br>
					<span class="postTxt" id="postTxt"><?php echo htmlspecialchars($row["komentar"]) ?></span><br>
					
					<br><div id="like"><pre>Like Comment</pre></div><span class="dateTime"><?php echo htmlspecialchars($row["vremepostavljanja"]) ?></span>
				</div>
			</div>
		<?php	}
	}
	$conn->close();

?>