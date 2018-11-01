<?php include "config/db_config.php"; ?>
<?php
session_start();
function var_error_log( $object=null ){
    ob_start();                    // start buffer capture
    var_dump( $object );           // dump the values
    $contents = ob_get_contents(); // put the buffer into a variable
    ob_end_clean();                // end capture
    error_log( $contents );        // log contents of the result of var_dump( $object )
  };

$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
// Change character set to utf8
mysqli_set_charset($conn,"utf8");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$timestamp = time();
$date = date("d/m/y H:i:s");

if(isset($_POST['insertPost'])){
    $msg = "";
    $statusContent = mysqli_real_escape_string($conn, strip_tags($_POST['statusContent']));
    $target_dir = "img/".basename($_FILES['fileToUpload']['name']);
    $image = $_FILES['fileToUpload']['name'];
    $pubStat = $_POST['pubSelect'];
    $imageFileType = strtolower(pathinfo($target_dir,PATHINFO_EXTENSION));
    $query1 = "INSERT INTO statusi(TID, KID, TekstStatusa, VremePostavljanja, SortID) 
        VALUES (null, ".$_SESSION['KID'].", '".$statusContent."','".$date."','".$timestamp."');";
    $query2 = "INSERT INTO slike(KID, LinkIzvoraSlike, ImeSlike, VremePostavljanja, JavnaPrivatna, SortID) 
        VALUES (".$_SESSION['KID'].",'".$target_dir."','".$image."','".$date."','".$pubStat."','".$timestamp."');";
    

    if (isset($_POST['statusContent'])) {

        $sqlInsert1 = mysqli_query($conn, $query1);
        echo "New record created successfully";
    } else {
        echo "Error: " . $sqlInsert . "<br>" . $conn->error."<br>";
        $emptyStatus = "INSERT INTO statusi(TID, KID, VremePostavljanja, SortID) VALUES
        (null, ".$_SESSION['KID'].",'".$date."','".$timestamp."')";
        $esquery = mysqli_query($conn, $emptyStatus);
    }
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    } else {
            if($_FILES['fileToUpload']['name'] !== ''){
                $sqlInsert2 = mysqli_query($conn, $query2);
            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_dir)) {
                $msg = "Image uploaded sucessfully.";
                
            } else {
                $msg = "There was a problem uploading image.";
                }
            }
        }

    if ($_FILES['fileToUpload']['name'] == "") {
        $query2 = "INSERT INTO slike(KID, LinkIzvoraSlike, ImeSlike, VremePostavljanja, SortID) 
        VALUES (".$_SESSION['KID'].",'','','".$date."','".$timestamp."')";
        $sqlInsert2 = mysqli_query($conn, $query2); 
    }
}
var_error_log($_FILES['fileToUpload']['name']);
header('Location: dashboard.php');
?>
 
    

