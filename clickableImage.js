var popupContainer = document.getElementById('popupContainer');
var photoContainer = document.getElementById('photoContainer');

document.getElementById('clickableImage').addEventListener('click', function() { 
    popupContainer.style.display = 'flex';
    photoContainer.style.backgroundImage = 'url(' + this.src + ')'
});


document.getElementById('closePopup').addEventListener('click', function() { 
    popupContainer.style.display = 'none';
});