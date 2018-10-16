<?php
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    $db = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    // Change character set to utf8
    mysqli_set_charset($db,"utf8");
    $sql = sprintf("SELECT * FROM Korisnici WHERE KorisnickoIme='%s'",
        mysqli_real_escape_string($db, $_POST['username'])
    );
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $hash = $row['Lozinka'];

        if (password_verify($_POST['password'], $hash)) {
            $message = 'Login successful.';

            $_SESSION['user'] = $row['KorisnickoIme'];
            $_SESSION['KID'] = $row['KID'];
            $_SESSION['SlikaKorisnika'] = $row['SlikaKorisnika'];
            $_SESSION['name'] = $row['Ime'];
            $_SESSION['lastname'] = $row['Prezime'];
            

            header('Location: dashboard.php');
        } else {
            $message = 'Login failed.';
            echo "failed";
        }
    } else {
        $message = 'Login failed.';
    }
    mysqli_close($db);
}
?>