$(document).ready(function(){  
          
            $('#loginForm').submit(function(){
				
				 var value1 = $("#newpass").val();
				 var value2 = $("#rnewpass").val();
				 var value3 = $("#hideid").val();
				 var value4 = $("#code").val();				 
                $.ajax({  
                  type: "POST",  
                  url: "new_pass_controller.php",  
                  data: 'newpass='+ value1+'&rnewpass='+ value2+'&hideid='+ value3+'&code='+ value4,
				  beforeSend: function() {$(".page").html("<img id='preloader' src='../../../img/preloader.gif'/>");}, 
				  success: function(data){  
                        $(".page").html("<div id='attentionForm'><a class='attentionText' href='../../user/index.php'>"+data+"</a></div>");
						 setTimeout('window.location.href = "new_pass_form.php?id='+value3+'&&code='+value4+'"', 3000); 
                    }  
                });  
                return false;  
            });  
              
        });  