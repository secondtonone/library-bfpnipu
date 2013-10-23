$(document).ready(function(){
$(".perchange").click(function(){
$.ajax({
url: "cabinet/personaldata.php",
cache: false,
beforeSend: function() {
$(".p_content").html("<img id='preloader' src='../../../img/preloader.gif'/>");
},
success: function(html){
$(".p_content").html(html);
}
});
return false;
});

$(".acchange").click(function(){
$.ajax({
url: "cabinet/accauntdata.php",
cache: false,
beforeSend: function() {
$(".a_content").html("<img id='preloader' src='../../../img/preloader.gif'/>");
},
success: function(html){
$(".a_content").html(html);
}
});
return false;
});
});