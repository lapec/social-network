<?php
function var_error_log( $object=null ){
    ob_start();                    // start buffer capture
    var_dump( $object );           // dump the values
    $contents = ob_get_contents(); // put the buffer into a variable
    ob_end_clean();                // end capture
    error_log( $contents );        // log contents of the result of var_dump( $object )
  };
  
  $cookieMsg = '';
  setcookie('invalidUN', $cookieMsg, time()+86400*30);
  if (isset($_POST['login'])) {
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
        // Change character set to utf8
        mysqli_set_charset($conn,"utf8");
      
        $escapeName = mysqli_real_escape_string($conn, $name);
        $escapeLastname = mysqli_real_escape_string($conn, $lastname);
        $escapeEmail = mysqli_real_escape_string($conn, $email);
        $escapeUsername = mysqli_real_escape_string($conn, $username);
        $escapeHash = mysqli_real_escape_string($conn, $hash);
        
        $checkQuery1 = "SELECT * FROM korisnici WHERE email = '$escapeEmail'";
        $checkQuery2 = "SELECT * FROM korisnici WHERE korisnickoime = '$escapeUsername'";
        $result1 = mysqli_query($conn, $checkQuery1);
        $result2 = mysqli_query($conn, $checkQuery2);
        
        if($result1->num_rows == 0 && $result2->num_rows == 0){
        $sql = "INSERT INTO korisnici (ime, prezime, email, korisnickoime, lozinka) VALUES ('".$escapeName."',
        '".$escapeLastname."',
        '".$escapeEmail."',
        '".$escapeUsername."',
        '".$escapeHash."'
         )";
        $test = mysqli_query($conn, $sql);
        } else {
        $cookieMsg = 'Username or email already in use!';
        setcookie('invalidUN', $cookieMsg, time()+86400*30);
        };
      
       header('Location: index.php');

        mysqli_close($conn);
    }
  }
?>