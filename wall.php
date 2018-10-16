<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/wall.css">

</head>

<body>
    <?php include "sections/navbar.php"?>

    <div class="pageContainer">
        <div class="leftColumn">
            <img class="profPicture" src="img/petprofilepic.png">
            <br>
            <br>
            <div class="userInfo">
                <table class="table">
                    <tr>
                        <td class="td">Full Name</td>
                        <td class="td">John Smith</td>
                    </tr>
                    <tr>
                        <td class="td">Username</td>
                        <td class="td">Johny</td>
                    </tr>
                    <tr>
                        <td class="td">Email</td>
                        <td class="td">johny@johny.yu</td>
                    </tr>
                </table>
            </div>

            <br>
            <br>
            <div class="imgPosts">
                <p> placeholder</p>
                <a href=""><img class="imgPost" src="img/female-profile-img.jpg" /></a>
            </div>
        </div>
        <div class="rightColumn">
            <div class="invisSpace"> </div>
            <div class="postSection">
                <div>
                <p class="datum">datum</p>
                <p class="post">lorem ipsum lipsum trololo</p>
                </div>
            </div>
        </div>
    </div>


</body>

</html>