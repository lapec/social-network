var popupContainer = document.getElementById('popupContainer');
var photoContainer = document.getElementById('photoContainer');
var imgClassName = document.getElementsByClassName("clickableImage");

var imgClick = function() {
    popupContainer.style.display = 'flex';
    photoContainer.style.backgroundImage = 'url(' + this.src + ')'
    imgId = this.id;
};
for (var i = 0; i < imgClassName.length; i++) {
    imgClassName[i].addEventListener('click', imgClick, false);
}

document.getElementById('closePopup').addEventListener('click', function() { 
    popupContainer.style.display = 'none';
});