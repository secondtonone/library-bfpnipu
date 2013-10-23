$(document).ready(function(){  
          
            $('.puserform').submit(function(){
				
				 var value1 = $("#telephone").val();
                 var value2 = $("#mobile").val();
                 var value3 = $("#email").val();  
				 var value4 = $("#workphone").val();
				 var value5 = $("#hideid").val();

				 				  
                $.ajax({  
                  type: "POST",  
                  url: "saveform.php",  
                  data: 'telephone='+ value1+'&mobile='+ value2+ '&email=' +value3+'&workphone='+ value4+'&hideid='+ value5,
				  beforeSend: function() {$(".p_content").html("<img id='preloader' src='../../../img/preloader.gif'/>");
},                 
				   success: function(data){  
                        $(".p_content").html("<div id='attentionForm'><a class='attentionText' href='cabinet_controller.php'>"+data+"</a></div>");
						  
                    }  
                });  
                return false;  
            });  
			
			 $('.auserform').submit(function(){
				
				 var value1 = $("#email").val();
                 var value2 = $("#password").val();
                 var value3 = $("#rpassword").val(); 
				 var value4 = $("#hideid").val(); 
						 				  
                $.ajax({  
                  type: "POST",  
                  url: "saveform.php",  
                  data: 'email='+ value1+'&password='+ value2+ '&rpassword=' +value3+'&hideid='+ value4,
				  beforeSend: function() {$(".a_content").html("<img id='preloader' src='../../../img/preloader.gif'/>");
},                 
				   success: function(data){  
                        $(".a_content").html("<div id='attentionForm'><a class='attentionText' href='cabinet_controller.php'>"+data+"</a></div>");
						  
                    }  
                });  
                return false;  
            });  
              
        });  