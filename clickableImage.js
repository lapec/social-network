var popupContainer = document.getElementById('popupContainer');
var photoContainer = document.getElementById('photoContainer');
var imgClassName = document.getElementsByClassName('clickableImage');

var imgClick = function() {    //this function opens popupContainer
    $('body').css('overflow','hidden');      //stops scroll of the body    
    popupContainer.style.display = 'flex';
    photoContainer.style.backgroundImage = 'url(' + this.src + ')'
    var imgId = this.id;
    document.getElementById('slikaID').value = imgId;   // taking id from picture and import it to html
    $('#forma').val('');

    $imgComment = $('#imgComment');
    $loadMore = $('.load-more');
    $imgComment.empty();
    $imgComment.html('<img id="loader" src=img/loading.gif width=40>');
    var loader = document.getElementById('loader');
    $(document).ready(function(){
        var offset = 0;
        var limit = 3;
        // loads more comments
        function fetchMoreComments() {
            $loadMore.hide();
            $(loader).show();
            $(loader).appendTo($imgComment);
            $imgComment.scrollTop(10000000);
            $.ajax({
                type: 'GET',
                url: 'imageComments.php?slikaID='+imgId,
                data: {
                    'offset': offset,
                    'limit': limit + 1
                },
                success: function(data) {
                    var parsedData = $.parseHTML(data);
                    var tempDom = $('<output>').append(parsedData);
                    var divs = $('div.printText', tempDom);
                    var hasMore = divs.length > limit;
                    offset += limit;
                    $imgComment.append(divs.slice(0, limit));
                    if (hasMore) {
                        $loadMore.show();
                    } else {
                        $loadMore.hide();
                    }
                    loader.style.display = 'none';
                }
            });
        }

        fetchMoreComments();
        $(document).on('click', '.load-more', fetchMoreComments);
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

/* insert image comment to db via ajax */

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
       $('#imgComment').prepend(data);
       $('#forma').val('');
       $imgComment.scrollTop(0);
   });
   }
});
