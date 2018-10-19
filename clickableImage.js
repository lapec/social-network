var popupContainer = document.getElementById('popupContainer');
var photoContainer = document.getElementById('photoContainer');
var imgClassName = document.getElementsByClassName('clickableImage');

var imgClick = function() {
    popupContainer.style.display = 'flex';
    photoContainer.style.backgroundImage = 'url(' + this.src + ')'
    var imgId = this.id;
    $('#imgComment').html('<img src=img/loading.gif width=40 px>');
    $.ajax({
        url: 'demo_test.php?slikaID='+imgId, //iskoristiti ovaj ID za drugi php kako bi se povezali komentari sa slikom
        success: function(result){
            $('#imgComment').html(result);
        },
        error: function(){
            $('#imgComment').html("Couldn't load comments.");
        }
    });
};
for (var i = 0; i < imgClassName.length; i++) {
    imgClassName[i].addEventListener('click', imgClick, false);
}

document.getElementById('closePopup').addEventListener('click', function() { 
    popupContainer.style.display = 'none';
    $('#imgComment').html('');
});