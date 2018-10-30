<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>social network</title>
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>

</head>
<body>
    <?php include "sections/navbar.php"; ?>
    <div align="center" id="insertPost">
        <img src="img/profile.gif"/>

       <form action="uploadimg.php" method="post" enctype="multipart/form-data">
              <input type="text" name="statusContent" id="onYourMind" placeholder="What's on your mind ?"/>

              <input type="file" name="fileToUpload" id="fileToUpload" placeholder="Odaberi datoteku:"
            style="visibility: hidden">
        <div class="btnUpload">
            <label for="fileToUpload" class="dgm">Odaberi datoteku:</label>
        </div>
       <div class="rightSide">
               <select name="pubSelect" id="pubSelect">
                 <option value="0">Javna</option>
                 <option value="1">Privatna</option>
               </select>

              <input type="submit" name="insertPost" id="kreirajPost" value="Kreiraj post" />
       </div>
       </form>

    </div>

<div id="dashboard"></div>
<script>
    $(document).ready(function(){
    
        $.ajax({
            type: 'GET',
            url: 'loadJson.php',
            data: {
               format: 'json'
            }
        })
        //kada je zahtev obradjen
        .done(function(data){
            drawPosts(data);
            // show the response
            /*
            var nizStatusa = JSON.parse(data);

            for(var i = 0; i<nizStatusa.length; i++){
                console.log(
                    JSON.parse(nizStatusa[i]).Ime
                );
            }
            */
        })
        // u slucaju greske
        .fail(function() {
            alert( "Greska." );
        });
});

function drawPosts(data) {
    var nizStatusa = JSON.parse(data);
    myArray = [];
    for(var i = 0; i<nizStatusa.length; i++){
        
        //console.log(JSON.parse(nizStatusa[i]));
        myArray.push(
            '<div align="center" id="printText">'+
                '<div class="row">'+
                    '<div class="usrPict">'+
                        '<img src="img/'+JSON.parse(nizStatusa[i]).SlikaKorisnika+'">'+
                    '</div>'+
                    '<a href="wall.php?n=' + JSON.parse(nizStatusa[i]).KID + '">' +
                    '<span id="fullName">'+ JSON.parse(nizStatusa[i]).Ime + " " +
                        JSON.parse(nizStatusa[i]).Prezime +
                    '</span></a>' + 

            '<div class="outPict"></div>'+
            '<div id="postTxt">');

        if ((JSON.parse(nizStatusa[i]).JavnaPrivatna === 1) || 
            JSON.parse(nizStatusa[i]).KID === $('#kidSession').val()) {

            myArray[i] += '<img class="postImg clickableImage" id="'+ JSON.parse(nizStatusa[i]).SID +'" src="'+ JSON.parse(nizStatusa[i]).LinkIzvoraSlike +'">';

        } else if ((JSON.parse(nizStatusa[i]).JavnaPrivatna === 0)) {

            myArray[i] += '<img class="postImg clickableImage" id="'+ JSON.parse(nizStatusa[i]).SID +'" src="'+ JSON.parse(nizStatusa[i]).LinkIzvoraSlike +'">';

        } 
        //console.log(JSON.parse(nizStatusa[i]).TekstStatusa);
            myArray[i] += 
            JSON.parse(nizStatusa[i]).TekstStatusa +
            '</div>' +
            '</div>' +
            '</div>';
            //console.log(myArray);
            
    }
        for(i=0; i<myArray.length; i++) {
            $("#dashboard").append(myArray[i]);
        }
}

</script>
<div id="popupContainer">
        <div id="popupContent">
            <div class="leftColumn" id="photoContainer" name=""></div>
            <div class="rightColumn">
        <div id="popupTopBar">
            <span id="closePopup">X</span>
        </div>
        <div id="imgComment"></div>
        <div id="comment">
        <div class="usrImg">
            <img class="usrImg1" src="img/<?php echo $_SESSION['SlikaKorisnika']; ?>">
        </div>
            <div class="usrCom">
                  <form action="insertComments.php" method="post">
                  <input id="forma" type="text" name="postComment" placeholder="Write a comment..." autocomplete="off" /><br/>
                  <input type="hidden" id="slikaID" name="slikaID" value="">
                  <button id="submitComment" name="submitComment" type="submit">Comment</button>
                  </form>
            </div>
        </div>
        </div>
        </div>
    </div>
<input type="hidden" id="kidSession" value="<?php echo $_SESSION['KID']; ?>">
<script src="clickableImage.js"></script>
</body>

</html>