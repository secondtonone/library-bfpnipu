$(document).ready(function(){  
          
            $('#loginForm').submit(function(){
				
				 var value1 = $("#login").val();
                 var value2 = $("#pass").val();
               				 				  
                $.ajax({  
                  type: "POST",  
                  url: "../reg/auth/enter.php",  
                  data: 'login='+ value1+'&pass='+ value2,
				  beforeSend: function() {$(".page").html("<img id='preloader' src='../../../img/preloader.gif'/>");},    
				  success: function(data){ 
				         if (data=='/app/user/unit1.php'){
				window.location.href = data;
							 }
						if(data=='/app/admin/unit1.php'){
				 window.location.href = data;
								 }else{
                        $(".page").html("<div id='attentionForm'><a class='attentionText' href='index.php'>"+data+"</a></div>");}
						  
                    }  
                });  
                return false;  
            });  
              
        });  