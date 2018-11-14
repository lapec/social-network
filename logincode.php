<?php
session_start();
if (isset($_POST['usernamelg']) && isset($_POST['passwordlg'])) {
    $db = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    // Change character set to utf8
    mysqli_set_charset($db,"utf8");
    $sql = sprintf("SELECT * FROM korisnici WHERE korisnickoime='%s'",
        mysqli_real_escape_string($db, $_POST['usernamelg'])
    );
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $hash = $row['lozinka'];

        if (password_verify($_POST['passwordlg'], $hash)) {
            $message = 'Login successful.';

            $_SESSION['user'] = $row['korisnickoime'];
            $_SESSION['KID'] = $row['kid'];
            $_SESSION['SlikaKorisnika'] = $row['slikakorisnika'];
            $_SESSION['name'] = $row['ime'];
            $_SESSION['lastname'] = $row['prezime'];
            

            header('Location: dashboard.php');
        } else {
            setcookie('loginfail', 'Invalid username/password!', time()+1);
            header('Location: index.php');

        }
    }
    mysqli_close($db);
}
?>