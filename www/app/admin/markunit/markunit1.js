$(document).ready(function(){

$(".unit1").each(function(){
  if ($(this).attr("href") == '/app/admin/unit1.php'){
    $(this).addClass("selected");

  }
});
});  