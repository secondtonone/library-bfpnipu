$(document).ready(function(){
	
$(document).on('click',".perchange",function(){
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

$(document).on('click',"#ppl .denied",function(){
$.ajax({
url: "cabinet_controller.php",
cache: false,
beforeSend: function() {
$(".p_content").html("<img id='preloader' src='../../../img/preloader.gif'/>");
},
success: function(){
window.location.href = "/app/user/cabinet_controller.php";
}
});
return false;
});



$(document).on('submit','#ppl',function(){
				
				 var value1 = $("#telephone").val();
                 var value2 = $("#mobile").val();
                 var value3 = $("#email").val();  
				 var value4 = $("#workphone").val();
				 var value5 = $("#hide").val();
				 				  
                $.ajax({  
                  type: "POST",  
                  url: "cabinet/saveform.php",  
                  data: 'telephone='+ value1+'&mobile='+ value2+ '&email=' +value3+'&workphone='+ value4+'&hide='+ value5,
				  beforeSend: function() {$(".p_content").html("<img id='preloader' src='../../../img/preloader.gif'/>");
},                 
				   success: function(data){  
                        $(".p_content").html("<div id='attentionForm'><a class='attentionText'>"+data+"</a></div>");
						  
                    }  
                });  
                return false;  
            });  

	$(document).on('click','.p_content #attentionForm',function(){
              $.ajax({
            url: "cabinet/controller_ppl.php",
				cache: false,
			beforeSend: function() {
			$(".p_content").html("<img id='preloader'src='../../../img/preloader.gif'/>");
},
				success: function(html){
$(".p_content").html(html);
}
});
return false;
});  


$(document).on('click',".acchange",function(){
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

 
$(document).on('submit','#acc',function(){
				 				
				 var value1 = $("#email").val();
                 var value2 = $("#password").val();
                 var value3 = $("#rpassword").val(); 
				 var value5 = $("#hide").val();
				 
						 				  
                $.ajax({  
                  type: "POST",  
                  url: "cabinet/saveform.php",  
                  data: 'email='+ value1+'&password='+ value2+ '&rpassword=' +value3+'&hide='+ value5,
				  beforeSend: function() {$(".a_content").html("<img id='preloader' src='../../../img/preloader.gif'/>");
},                 
				   success: function(data){  
                        $(".a_content").html("<div id='attentionForm'><a class='attentionText' >"+data+"</a></div>");
						  
                    }  
                });  
                return false;  
            });  
$(document).on('click',"#acc .denied",function(){
$.ajax({
url: "cabinet_controller.php",
cache: false,
beforeSend: function() {
$(".a_content").html("<img id='preloader' src='../../../img/preloader.gif'/>");
},
success: function(){
window.location.href = "/app/user/cabinet_controller.php";
}
});
return false;
});
			$(document).on('click','.a_content #attentionForm',function(){
              $.ajax({
            url: "cabinet/controller_acc.php",
				cache: false,
			beforeSend: function() {
			$(".a_content").html("<img id='preloader'src='../../../img/preloader.gif'/>");
},
				success: function(html){
$(".a_content").html(html);
}
});
return false;
});  
              
       
});

