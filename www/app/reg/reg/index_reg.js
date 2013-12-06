$(document).ready(function(){  
          
            $('#regForm').submit(function(){
				
				 var value1 = $("#login").val();
                 var value2 = $("#pass").val();
                 var value3 = $("#pass2").val();  
				 var value4 = $("#email").val();
                 var value5 = $("#fam").val();
                 var value6 = $("#number_zach").val();
				 				  
                $.ajax({  
                  type: "POST",  
                  url: "reg_controller.php",  
                  data: 'login='+ value1+'&pass='+ value2+ '&pass2=' +value3+'&email='+ value4+ '&fam=' + value5+  '&number_zach=' + value6,
				  beforeSend: function() {$(".page").html("<div id='preloader'></div>");},                 
				   success: function(data){ if (data=="Спасибо за регистрацию! Ваш аккаунт был успешно создан! Вам на email было выслано письмо с инструкциями для завершения регистрации!"){
				   	
		$(".page").html("<div id='attentionForm'><a class='attentionText' href='../../../user/index.php'>"+data+"</a></div>");
		setTimeout('window.location.href = "../../../user/index.php"', 3000);		   }
				   }else{ 
                        $(".page").html("<div id='attentionForm'><a class='attentionText' href='index_reg.php'>"+data+"</a></div>");
		setTimeout('window.location.href = "index_reg.php"', 3000);}
                    }  
                });  
                return false;  
            });  
              
        });  
