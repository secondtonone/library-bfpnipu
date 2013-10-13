$(document).ready(function(){  
          
            $('#loginForm').submit(function(){
				
				 var value1 = $("#login").val();
				 var value2 = $("#email").val();
				 				  
                $.ajax({  
                  type: "POST",  
                  url: "forpass_controller.php",  
                  data: 'login='+ value1+'&email='+ value2,
				  beforeSend: function() {$(".page").html("<img id='preloader' src='../../../img/preloader.gif'/>");},                  success: function(data){  
                        $(".page").html("<div id='attentionForm'><a class='attentionText' href='forget_pass_form.php'>"+data+"</a></div>");
						  
                    }  
                });  
                return false;  
            });  
              
        });  