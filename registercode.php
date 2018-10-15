<?php
  if (isset($_POST['submit'])) {
    $ok = true;
    if (!isset($_POST['name']) || $_POST['name'] === '') {
        $ok = false;
    } else {
        $name = $_POST['name'];
    }
    if (!isset($_POST['lastname']) || $_POST['lastname'] === '') {
        $ok = false;
    } else {
        $lastname = $_POST['lastname'];
    }
    if (!isset($_POST['email']) || $_POST['email'] === '') {
        $ok = false;
    } else {
        $email = $_POST['email'];
    }
    if (!isset($_POST['username']) || $_POST['username'] === '') {
        $ok = false;
    } else {
        $username = $_POST['username'];
    }
    if (!isset($_POST['password']) || $_POST['password'] === '') {
        $ok = false;
    } else {
        $password = $_POST['password'];
    }

    if ($ok) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // add database code here
        $conn = mysqli_connect('localhost', 'root', '', 'soc_net');
        /*
        $sql = sprintf("INSERT INTO Korisnici (Ime, Prezime, Email, KorisnickoIme, Lozinka) VALUES (
          '%s', '%s', '%s', '%s', '%s'
        )", mysqli_real_escape_string($conn, $name),
            mysqli_real_escape_string($conn, $lastname),
            mysqli_real_escape_string($conn, $email),
            mysqli_real_escape_string($conn, $username),
            mysqli_real_escape_string($conn, $hash));
            */

        $escapeName = mysqli_real_escape_string($conn, $name);
        $escapeLastname = mysqli_real_escape_string($conn, $lastname);
        $escapeEmail = mysqli_real_escape_string($conn, $email);
        $escapeUsername = mysqli_real_escape_string($conn, $username);
        $escapeHash = mysqli_real_escape_string($conn, $hash);


        $sql = "INSERT INTO Korisnici (Ime, Prezime, Email, KorisnickoIme, Lozinka) VALUES ('".$escapeName."',
        '".$escapeLastname."',
        '".$escapeEmail."',
        '".$escapeUsername."',
        '".$escapeHash."'
         )";


        $test = mysqli_query($conn, $sql);

        if($test === true){
            $registerMessage = "User ".$username." added to db";
        } else {
            $registerMessage ="Error description: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
  }
?>