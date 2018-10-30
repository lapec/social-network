<?php include "config/db_config.php"; ?>

<?php
session_start();
if (!isset($_SESSION['user']) || !$_SESSION['user']) {
  header('Location: index.php');
}
?>
<?php
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Change character set to utf8
mysqli_set_charset($conn,"utf8");


$sql = "
        SELECT korisnici.Ime, korisnici.Prezime, korisnici.SlikaKorisnika,korisnici.KID, statusi.KID, slike.LinkIzvoraSlike, slike.VremePostavljanja AS v1, slike.JavnaPrivatna, slike.SID,slike.KID, statusi.TekstStatusa, statusi.VremePostavljanja AS v2 FROM 
        ( (statusi INNER JOIN korisnici ON statusi.KID = korisnici.KID) 
        LEFT JOIN slike ON statusi.VremePostavljanja = slike.VremePostavljanja) UNION 
        SELECT korisnici.Ime, korisnici.Prezime, korisnici.SlikaKorisnika, korisnici.KID, statusi.KID, slike.LinkIzvoraSlike, slike.VremePostavljanja AS v1, slike.JavnaPrivatna, slike.SID, slike.KID, statusi.TekstStatusa, statusi.VremePostavljanja AS v2 FROM 
        ( (statusi INNER JOIN korisnici ON statusi.KID = korisnici.KID) 
        RIGHT JOIN slike ON statusi.VremePostavljanja = slike.VremePostavljanja) ORDER BY v1 DESC;";
$result = $conn->query($sql);

?>
<?php
    if ($result->num_rows > 0) { 
    // output data of each row
    ?>
    <?php
     $test = [];
     while($row = $result->fetch_assoc()){
            if (($row['JavnaPrivatna'] === 0) || $row['KID'] === $_SESSION['KID']) {
				array_push($test, json_encode($row));
            }    
          }
          echo json_encode($test);
    $conn->close();
}
?>