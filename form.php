<?php session_start();?>
<?php require "config/db_config.php"; ?>


<?php

$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);


	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	if (isset($_POST['insertPost'])) {
		$ok = true;
		$posttext = mysqli_real_escape_string($conn, $_POST['posttext']);
		if (empty($_POST["posttext"])) {
			$ok = false;
		} 
		if ($ok == "true") {
			$posttime = date("Y-m-d H:i:s");
			$currentUserID = $_SESSION['currentUserId'];
			$sql = "INSERT INTO `statusi` (`TID`, `KID`, `TekstStatusa`, `VremePostavljanja`) VALUES (NULL, '$currentUserID', '$posttext', '$posttime')";
			if ($conn->query($sql) !== true) {
				echo "Error: " . $sql . "<br>" . $conn->error . "<br><br>";
			} else {
			header('Location: dashboard.php');
			}
		}
	}
	$sql = "SELECT * FROM statusi AS a INNER JOIN korisnici AS b ON a.KID = b.KID ORDER BY vremePostavljanja DESC";
	$result = $conn->query($sql);


	$conn->close();
?>