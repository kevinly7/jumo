function clickFunction() {
   var subgroup = $("#subgroup").val().trim();
   var coach = $("#coach").val().trim();
   var contact = $("#contact").val().trim();

   if(subgroup == "" || coach == "" || contact == "") {
   	alert("Please fill out the fields!");
   }

}