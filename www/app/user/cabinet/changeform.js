$(document).ready(function(){
	
$("a[href='help.php']").each(function(){
      $(this).attr('href', $(this).attr('href')+'#unit1');
   });
	
$(document).on('click',".perchange",function(){
$.ajax({
url: "cabinet/personaldata.php",
cache: false,
beforeSend: function() {
$(".p_content").html("<div id='preloader'></div>");
},
success: function(html){
$('.p_content').height(730);
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
$(".p_content").html("<div id='preloader'></div>");
},
success: function(){
window.location.href = "cabinet_controller.php";
}
});
return false;
});



$(document).on('submit','#ppl',function(){
				
				 var value1 = $("#telephone").val();
                 var value2 = $("#mobile").val();
                 var value4 = $("#workphone").val();
				 var value5 = $("#hide").val();
				 var value6 = $("#fam").val();
                 var value7 = $("#name").val();
                 var value8 = $("#otch").val();				 				  
                $.ajax({  
                  type: "POST",  
                  url: "cabinet/saveform.php",  
                  data: 'fam='+ value6+'&name='+ value7+'&otch='+ value8+'&telephone='+ value1+'&mobile='+ value2+'&workphone='+ value4+'&hide='+ value5,
				  beforeSend: function() {$(".p_content").html("<div id='preloader'></div>");
},                 
				   success: function(data){  
                        $(".p_content").html("<div id='attentionForm'><a class='attentionText'>"+data+"</a></div>");
					setTimeout('window.location.href = "cabinet_controller.php"', 3000);  
                    }  
                });  
                return false;  
            });  

$(document).on('click','.p_content #attentionForm',function(){
              $.ajax({
            url: "cabinet/controller_ppl.php",
				cache: false,
			beforeSend: function() {
			$(".p_content").html("<div id='preloader'></div>");
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
$(".a_content").html("<div id='preloader'></div>");
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
				  beforeSend: function() {$(".a_content").html("<div id='preloader'></div>");
},                 
				   success: function(data){  
                        $(".a_content").html("<div id='attentionForm'><a class='attentionText' >"+data+"</a></div>");
					setTimeout('window.location.href = "cabinet_controller.php"', 3000);	  
                    }  
                });  
                return false;  
            });  
$(document).on('click',"#acc .denied",function(){
$.ajax({
url: "cabinet_controller.php",
cache: false,
beforeSend: function() {
$(".a_content").html("<div id='preloader'></div>");
},
success: function(){
window.location.href = "cabinet_controller.php";
}
});
return false;
});
			$(document).on('click','.a_content #attentionForm',function(){
              $.ajax({
            url: "cabinet/controller_acc.php",
				cache: false,
			beforeSend: function() {
			$(".a_content").html("<div id='preloader'></div>");
},
				success: function(html){
$(".a_content").html(html);
}
});
return false;
});  
              
       
});
