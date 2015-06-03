$(document).ready(function(){
  var data;
  $('[name="studentGroups"]').on('change', function(){
      $.ajax({
         type: "POST",
         url: 'groupStudents.php',
         data:{action: $(this).val()},
         success:function(msg) {
          alert(msg);
           alert("is this going in");
         }
    });
  });
});
