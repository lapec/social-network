<!DOCTYPE html>
<html>
<head>
	<title>social-network</title>
	<link href="css/dashboard.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
</head>
<body>
    <?php include "navbar.php"; ?>
    <main>
    	<img src="img/user.jpg"><br>
                <?php if(isset($_POST['login']) && !empty($_POST['username'])){
        	echo $_POST['username'];
        } else {
        	echo "John Smith";
        }
        ?>
    </main>
</body>
</html>