<?php
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
mysqli_set_charset($conn,"utf8");
$userID = $_SESSION['KID'];
$sql = "SELECT * FROM Korisnici WHERE KID='$userID'";
$result = mysqli_query($conn, $sql);
$userrow = mysqli_fetch_assoc($result);
$name = $userrow['Ime'];
$lastname = $userrow['Prezime'];
$userpic = $userrow['SlikaKorisnika'];
$username = $userrow['KorisnickoIme'];
$passhash = $userrow['Lozinka'];

$imgerror = "";
$infoerror = "";
$passerror = "";
$hideupdatebutton = "";


if(isset($_FILES['image'])){
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_ext = strtolower(end(explode('.',$_FILES['image']['name'])));
    $extensions= array("jpeg","jpg","png","gif");
    $file_name = "userimg_" . sprintf('%08d', $userID) . "." . $file_ext;

	switch ($_FILES['image']['error']) {
		case 4:
		    $imgerror .= "<span class='textfail'>Prvo odaberite sliku</span><br>";
		    break;
		case (1 || 2):
		        $imgerror .= "<span class='textfail'>Maksimalna veličina slike je 2 MB</span><br>";
		        break;
		case (3 || 6 || 7 || 8):
		    $imgerror .= "<span class='textfail'>Serverska greška prilikom preuzimanja slike, pokušajte kasnije</span><br>";
		    break;
		case (0):
		    $finfo = finfo_open( FILEINFO_MIME_TYPE );
			$mtype = finfo_file( $finfo, $file_tmp );
			finfo_close( $finfo );
			if( $mtype == ( "image/jpeg" ) || 
			    $mtype == ( "image/bmp" ) ||
			    $mtype == ( "image/png" ) || 
			    $mtype == ( "image/gif" )) {
			}
			else {
			    $imgerror .= "<span class='textfail'>Slika može da bude isključivo u formatu JPG, JPEG, PNG ili GIF</span><br>";
			}
			break;
		default: 
			$imgerror .= "<span class='textfail'>Nemamo pojma šta se desilo, tim visoko utreniranih majmuna poslat je da izvidi situaciju</span><br>";
	}
    if($imgerror === "") {
    	move_uploaded_file($file_tmp,"img/" . $file_name);
    	$sql = "UPDATE korisnici SET SlikaKorisnika = '$file_name' WHERE KID = $userID;";

    	$test = mysqli_query($conn, $sql);
	    if($test === false){
	        $imgerror .= "SQL Error: " . mysqli_error($conn);
	    }
	    $imgerror .= "<span class='textsuccess'>Slika uspešno promenjena</span><br>";
	    $_SESSION['SlikaKorisnika'] = $file_name;
	    header('profile.php');
	}
}


if (isset($_POST['updateuserinfo'])) {
	$ok = true;
	if (!isset($_POST['name']) || $_POST['name'] === '') {
		$ok = false;
		$infoerror .= "<span class='textfail'>Polje s imenom mora biti popunjeno</span><br>";
	} else if (!preg_match("/^(?=.*\p{L})[\p{L} .]+$/u",$_POST['name'])) {
        $infoerror .= "<span class='textfail'>Ime može da sadrži samo slova, razmak i tačku</span><br>";
        $ok = false;
	} else {
		$name = mysqli_real_escape_string($conn, $_POST['name']);
	}
	if (!isset($_POST['lastname']) || $_POST['lastname'] === '') {
		$ok = false;
		$infoerror .= "<span class='textfail'>Polje s prezimenom mora biti popunjeno</span><br>";
	} else if (!preg_match("/^(?=.*\p{L})[\p{L} .]+$/u",$_POST['lastname'])) {
        $infoerror .= "<span class='textfail'>Prezime može da sadrži samo slova, razmak i tačku</span><br>";
        $ok = false;
	} else {
		$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
	}
	if (!isset($_POST['username']) || $_POST['username'] === '') {
		$ok = false;
		$infoerror .= "<span class='textfail'>Polje s korisničkim imenom mora biti popunjeno</span><br>";
	} else if (!preg_match("/^[a-zA-Z0-9]*$/",$_POST['username'])) {
        $infoerror .= "<span class='textfail'>Korisničko ime može da sadrži samo latinična slova i brojeve</span><br>";
        $ok = false;
	} else {
		$checkuser = $conn->query("SELECT KorisnickoIme FROM korisnici WHERE korisnici.KorisnickoIme = '".$_POST['username']."';");
	    $row = mysqli_fetch_assoc($checkuser);
	    if ($row) {
	        $infoerror .= "<span class='textfail'>Korisničko ime je zauzeto</span><br>";
	        $ok = false;
	    } else {
	    	$username = mysqli_real_escape_string($conn, $_POST['username']);
	    }
	}

	if ($ok) {
		$sql = "UPDATE korisnici SET Ime = '$name', Prezime = '$lastname', KorisnickoIme = '$username' WHERE KID = '$userID';";
		$infoerror .= "<span class='textsuccess'>Korisnički podaci uspešno promenjeni</span><br>";
		

		$test = mysqli_query($conn, $sql);
		if($test === false) {
			$infoerror .= "Error description: " . mysqli_error($conn);
		}

		$_SESSION['name'] = $name;
		$_SESSION['lastname'] = $lastname;
		header('profile.php');
	}
}


if (isset($_POST['changepassword'])) {
	$ok = true;
	if (!isset($_POST['currpass']) || $_POST['currpass'] === '') {
		$passerror .= "<span class='textfail'>Unesite sadašnju lozinku</span><br>";
		$ok = false;
	}
	if (!isset($_POST['newpass']) || $_POST['newpass'] === '') {
		$passerror .= "<span class='textfail'>Unesite novu lozinku</span><br>";
		$ok = false;
	} else if (!preg_match("/^[a-zA-Z0-9]*$/",$_POST['newpass'])) {
        $passerror .= "<span class='textfail'>Lozinka može da sadrži samo latinična slova i brojeve</span><br>";
        $ok = false;
	}
	if (!isset($_POST['confirmpass']) || $_POST['confirmpass'] === '') {
		$passerror .= "<span class='textfail'>Unesite ponovo novu lozinku</span><br>";
		$ok = false;
	}
	if ($_POST['newpass'] !== $_POST['confirmpass']) {
		$passerror = "<span class='textfail'>Nova lozinka se ne slaže</span><br>";
		$ok = false;
	}
	if (password_verify($_POST['currpass'], $passhash)) {
		$passerror = "<span class='textfail'>Važeća lozinka je neispravna</span><br>";
		$ok = false;
	}

	if ($ok) {
		$currpass = mysqli_real_escape_string($conn, $_POST['currpass']);
		$newpass = mysqli_real_escape_string($conn, $_POST['newpass']);
		$confirmpass = mysqli_real_escape_string($conn, $_POST['confirmpass']);

		$sql = "UPDATE korisnici SET Lozinka = '$passhash' WHERE KID = '$userID';";
		$passerror .= "<span class='textsuccess'>Lozinka uspešno promenjena</span><br>";

		$test = mysqli_query($conn, $sql);
		if($test === false) {
			$passerror .= "Error description: " . mysqli_error($conn);
		}
	}
}



function writePosts() {
	global $userID, $postindex, $passerror;
	$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
	$sql = "SELECT * FROM statusi WHERE KID = $userID ORDER BY VremePostavljanja DESC";
	$result = $conn->query($sql) or die($mysqli->error);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) { 
			if ($row["TekstStatusa"] !== "") {
				?> <textarea name="post<?php echo htmlspecialchars($row["TID"]) ?>" autocomplete="off" maxlength="140"><?php echo htmlspecialchars($row["TekstStatusa"]) ?></textarea> <?php
				$postindex[] = $row["TID"];
			}
		}
	} else {
		echo "Statusi ovog korisnika ne postoje";
		$hideupdatebutton = "hidden";
	}
	if (isset($_POST['changeposts'])) {
		foreach ($postindex as $postid) {
			$dbpost = mysqli_query($conn, "SELECT 'TekstStatusa' FROM Users WHERE TID='$postid'");
			if ($dbpost != $_POST['post'.$postid]) {
				$post = mysqli_real_escape_string($conn, $_POST['post'.$postid]);
				mysqli_query($conn,"UPDATE statusi SET TekstStatusa = '$post' WHERE TID='".$postid."';");
			}
		}
		echo '<script language="javascript"> alert("Statusi uspešno promenjeni") </script>';
	}
	mysqli_close($conn);
}

	

mysqli_close($conn);
?>

