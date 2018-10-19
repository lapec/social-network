<?php session_start();?>
<?php require "config/db_config.php"; ?>


<?php

$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);

	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	if (isset($_POST['submitComment'])) {
		$ok = true;
		$posttext = mysqli_real_escape_string($conn, $_POST['postComment']);
		$slikaID = mysqli_real_escape_string($conn, $_POST['slikaID']);
		if (empty($_POST["postComment"])) {
			$ok = false;
		} 
		if ($ok == "true") {
			$posttime = date("Y-m-d H:i:s");
			$currentUserID = $_SESSION['KID'];
			$sql = "INSERT INTO `komentari_slike` (`SID`, `KID`, `Komentar`, `VremePostavljanja`) VALUES ('$slikaID', '$currentUserID', '$posttext', '$posttime')";
			if ($conn->query($sql) !== true) {
				echo "Error: " . $sql . "<br>" . $conn->error . "<br><br>";
			} else {
			header('Location: dashboard.php');
			}
		}
	}
	$conn->close();
?>





