$(document).ready(function(){  
          
            $('#loginForm').submit(function(){
                                
                 var value1 = $("#login").val();
                 var value2 = $("#pass").val();
                                                                                  
                $.ajax({  
                  type: "POST",  
                  url: "../reg/auth/enter.php",  
                  data: 'login='+ value1+'&pass='+ value2,
                  beforeSend: function() {$(".page").html("<div id='preloader'></div>");},    
                  success: function(data){ 
                                         if (data=="user"){
                                                         
                                window.location.href = "/app/user/unit2.php";
                                                         }else{
                                                if(data=="admin"){
                                 window.location.href = "/app/admin/unit1.php";
                                                                 }else{
                        $(".page").html("<div id='attentionForm'><a class='attentionText' href='index.php'>"+data+"</a></div>");
						setTimeout('window.location.href = "index.php"', 3000);
						 }
                                                  
                    } }
                });  
                return false; 
				 
            });  
              
        });  
