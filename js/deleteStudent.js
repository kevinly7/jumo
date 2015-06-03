$(document).ready(function(){
  var data;
  $('[name="studentGroups"]').on('change', function(){
      $.ajax({
         type: "POST",
         url: 'groupStudents.php',
         dataType: "html",
         data:{action: $(this).val()},
         success:function(msg) {
          //alert(msg);
           $("#response").html(msg);
          // alert("is this going in");
         }
    });
  });
});
