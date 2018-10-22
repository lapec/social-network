<?php include "config/db_config.php"; ?>
<?php
session_start();
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$timestamp = date('d.m.Y H:i:s');

if(isset($_POST['insertPost'])){
    $msg = "";
    $statusContent = $_POST['statusContent'];
    $target_dir = "img/".basename($_FILES['fileToUpload']['name']);
    $image = $_FILES['fileToUpload']['name'];
    $pubStat = $_POST['pubSelect'];
    $query1 = "INSERT INTO statusi(TID, KID, TekstStatusa, VremePostavljanja) 
        VALUES (null, ".$_SESSION['KID'].", '".$statusContent."','".$timestamp."');";
    $query2 = "INSERT INTO slike(KID, LinkIzvoraSlike, ImeSlike, VremePostavljanja, JavnaPrivatna) 
        VALUES (".$_SESSION['KID'].",'".$target_dir."','".$image."','".$timestamp."','".$pubStat."');";
    
    $sqlInsert = mysqli_multi_query($conn, $query1);
    $sqlInsert = mysqli_multi_query($conn, $query2);
        
  
  
    if ($sqlInsert === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sqlInsert . "<br>" . $conn->error."<br>";
    }
    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_dir)) {
         $msg = "Image uploaded sucessfully.";
    } else {
         $msg = "There was a problem uploading image.";
    }
}

header('Location: dashboard.php');
?>
 
    

