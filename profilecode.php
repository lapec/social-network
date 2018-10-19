<?php
	$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
    mysqli_set_charset($conn,"utf8");
    $userID = $_SESSION['KID'];
    $sql = sprintf("SELECT * FROM Korisnici WHERE KID='$userID';");
	$result = mysqli_query($conn, $sql);
    $userrow = mysqli_fetch_assoc($result);
    $name = $userrow['Ime'];
    $lastname = $userrow['Prezime'];
    $userpic = $userrow['SlikaKorisnika'];
    $username = $userrow['KorisnickoIme'];
    $passhash = $userrow['Lozinka'];

    $passerrorverify = "";
    $passerrorconfirm = "";
    $passsuccess = "";

    if(isset($_FILES['image'])){
    	$errors = array();
    	$file_size = $_FILES['image']['size'];
    	$file_tmp = $_FILES['image']['tmp_name'];
    	$file_ext = strtolower(end(explode('.',$_FILES['image']['name'])));
    	      
    	$extensions= array("jpeg","jpg","png");
    	      
    	if(in_array($file_ext,$extensions) === false) {
    	    $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    	}

    	$file_name = "userimg_" . sprintf('%08d', $userID) . "." . $file_ext;
    	      
    	if($file_size > 3145728){
    	    $errors[] ='File size must be under 3 MB.';
    	}
    	      
    	if(empty($errors) == true) {
    	    move_uploaded_file($file_tmp,"img/" . $file_name);
    	    $sql = "UPDATE korisnici SET SlikaKorisnika = '$file_name' WHERE KID = $userID;";

    	    $test = mysqli_query($conn, $sql);
    	    header('profile.php');
	        if($test === false){
	            $errors[] = "SQL Error: " . mysqli_error($conn);
	        }
	    }
    }

	if (isset($_POST['updateuserinfo'])) {
	    $ok = true;
	    if (!isset($_POST['name']) || $_POST['name'] === '') {
	        $ok = false;
	    } else {
	        $name = mysqli_real_escape_string($conn, $_POST['name']);
	    }
	    if (!isset($_POST['lastname']) || $_POST['lastname'] === '') {
	        $ok = false;
	    } else {
	        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
	    }
	    if (!isset($_POST['username']) || $_POST['username'] === '') {
	        $ok = false;
	    } else {
	        $username = mysqli_real_escape_string($conn, $_POST['username']);
	    }

	    if ($ok) {
	     
	        $sql = "UPDATE korisnici SET Ime = '$name', Prezime = '$lastname', KorisnickoIme = '$username' WHERE KID = '$userID';";
	        header('profile.php');

	        $test = mysqli_query($conn, $sql);
	        if($test === false) {
	            $errors[] ="Error description: " . mysqli_error($conn);
	        }

	    }
	}


	if (isset($_POST['changepassword'])) {
	    $ok = true;
	    if (!isset($_POST['currpass']) || $_POST['currpass'] === '') {
	        $ok = false;
	    } else {
	        $currpass = mysqli_real_escape_string($conn, $_POST['currpass']);
	    }
	    if (!isset($_POST['newpass']) || $_POST['newpass'] === '') {
	        $ok = false;
	    } else {
	        $newpass = mysqli_real_escape_string($conn, $_POST['newpass']);
	    }
	    if (!isset($_POST['confirmpass']) || $_POST['confirmpass'] === '') {
	        $ok = false;
	    } else {
	        $confirmpass = mysqli_real_escape_string($conn, $_POST['confirmpass']);
	    }

	    if ($ok && password_verify($_POST['currpass'], $passhash) && $_POST['newpass'] == $_POST['confirmpass']) {
	    	$passhash = password_hash($newpass, PASSWORD_DEFAULT);
	        $sql = "UPDATE korisnici SET Lozinka = '$passhash' WHERE KID = '$userID';";
	        $passsuccess = "Lozinka je uspešno promenjena";

	        $test = mysqli_query($conn, $sql);
	        if($test === false) {
	            $errors[] ="Error description: " . mysqli_error($conn);
	        }
	    } else {
	    	$passerrorverify = "Lozinka je neispravna";
	    }
	}

					function writePosts() {
						global $userID;
	                    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
	                    $sql = "SELECT * FROM statusi WHERE KID = $userID ORDER BY VremePostavljanja DESC";
	                    $result = $conn->query($sql) or die($mysqli->error);
	                    if ($result->num_rows > 0) {
	                        while($row = $result->fetch_assoc()) { 
	                            ?> <input type="text" class="input-field" name="post<?php echo htmlspecialchars($row["TID"]) ?>" value="<?php echo htmlspecialchars($row["TekstStatusa"]) ?>" autocomplete="off" /><br/> <?php
	                            $postid = $row["TID"];
	                            if (isset($_POST['changeposts']) && $row["TekstStatusa"] != $_POST['post'.$postid]) {
	                                
	                                $post = mysqli_real_escape_string($conn, $_POST['post'.$postid]);
	                                mysqli_query($conn,"UPDATE statusi SET TekstStatusa = '$post' WHERE TID='".$postid."';");
	                            }
	                        }
	                    } else {
	                        echo "No posts from this user.";
	                    }
	                    mysqli_close($conn);
	                }

    mysqli_close($conn);
?>

