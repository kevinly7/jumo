$(document).ready(function(){
    $('.logout').click(function(){
        $.ajax({
           type: "POST",
           url: 'logout.php',
           data:{action:'call_this'},
           success:function(html) {
            // alert(html);
           }

      });
    });

});