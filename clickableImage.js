var popupContainer = document.getElementById('popupContainer');
var photoContainer = document.getElementById('photoContainer');
var imgClassName = document.getElementsByClassName('clickableImage');

var imgClick = function() {    //this function opens popupContainer
    $('body').css('overflow','hidden');      //stops scroll of the body    
    popupContainer.style.display = 'flex';
    photoContainer.style.backgroundImage = 'url(' + this.src + ')'
    var imgId = this.id;
    document.getElementById('slikaID').value = imgId;   //taking id from picture and import it to html
    $('#forma').val('');

    $('#imgComment').html('<img src=img/loading.gif width=40 px>'); 
    $.ajax({        //this ajax is for comment load
        url: 'imageComments.php?slikaID='+imgId,
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
    document.onkeydown = function(evt) {      //closing popupContainer with esc key
    evt = evt || window.event;
    if (evt.keyCode == 27) {
        document.getElementById('popupContainer').style.display = 'none';
        $('body').css('overflow','auto');       //puts back scroll function
    }
    };
    $('#popupContainer').on('click', function(e) { //closing popupContainer clicking outside of the Content
        if (e.target !== this)
          return;
          popupContainer.style.display = 'none';
          $('body').css('overflow','auto');
      });
document.getElementById('closePopup').addEventListener('click', function() {  //closing popupContainer clicking on X button
    popupContainer.style.display = 'none';
    $('#imgComment').html('');
    $('body').css('overflow','auto');
});

$('#submitComment').click(function(){
   var comment = $('#forma').val();
   var SID = $('#slikaID').val();
   if(comment.length == 0){
    event.preventDefault();
    } else { 
   $.post("insertComments.php",
   {
       postComment: comment,
       slikaID: SID
   },
   function(data, status){
       $('#imgComment').append(data);
       $('#forma').val('');
   });
   }
});