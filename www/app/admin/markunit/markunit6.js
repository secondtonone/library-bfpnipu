$(document).ready(function(){
//для подсветки меню
$(".unit6").each(function(){
    $(this).addClass("selected");
});
$("a[href='help.php']").each(function(){
      $(this).attr('href', $(this).attr('href')+'#unit6');
   });

//jqgrid плагин

		
$("#list").jqGrid({
            url:'scripts/unit6/getdataunit6.php',
            datatype: 'json',
            mtype: 'POST',
            colNames:['#','Фамилия','Имя','Отчество','Эл. почта'],
            colModel :[{name:'id_man', index:'id_man', width:40, align:'right',editable:false, search:false,editable:false}
                ,{name:'fam', index:'fam', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'name', index:'name', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},{name:'otchestvo', index:'otchestvo', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'e_mail', index:'e_mail', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}}
 ],
            pager: '#pager',
			width:520,
            height:300,
			rowNum:15,
            rowList:[15,30,45,90],
            sortname: 'id_man',
            sortorder: "asc",
            caption: 'Студенты',
			viewrecords: true,
			multiselect: true
        }).navGrid('#pager',{view:false, del:false, add:false, edit:false, search:false},{width:770,height:440,reloadAfterSubmit:true},{width:770,height:400,reloadAfterSubmit:true},  
			{width:770,height:440,reloadAfterSubmit:true}, 
			{},{}).navSeparatorAdd("#pager",{sepclass:"ui-separator",sepcontent: ''}).navButtonAdd("#pager",{caption:"Выдать ", onClickButton: function(){
			   								var s = $("#list").jqGrid('getGridParam','selarrrow');
											var id_bookg=$("#id_bookg").val();
										if (id_bookg==false)
										  { alert("Не выбрано издание!");}
										  else if (s==false)
										  {	alert("Не выбран студент!");} 
										  else{
		              for(var i=0;i<s.length;i++){
			          var cl = s[i];
				     $.ajax({  
                  type: "POST",  
                  url: "scripts/unit6/saverowunit61.php",  
                  data: 'id_book='+id_bookg+'&id_man='+cl,
		 		  success: function(data){
                  $("#giveFormgroup .mass").html(data);
				  $("#giveFormgroup .mass").hide(3000);
                 }
                });} 
				$('#list').trigger("reloadGrid");} }, position: "last", title:"Выдать", cursor: "pointer"});  
		$("#list").jqGrid('filterToolbar',{searchOperators:true,stringResult:true,searchOnEnter:false});
//autocomplete для певого поля
        function updateTable(value) {
    $("#list").setGridParam({url:"scripts/unit6/getdataunit6.php?idgroup="+value,datatype:"json", page:1})
      .trigger("reloadGrid"); 
	$("#list").setGridParam({url:"scripts/unit6/getdataunit6.php",datatype:"json", page:1})
  }

        
        $('#bookg').autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=1',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$("#id_bookg").val(ui.item.value);
		return false; },
		focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false;
    }
	
    });
	
	    $('#groupg').autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=2',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$("#id_groupg").val(ui.item.value);
		updateTable(ui.item.value);
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	});



        $('#book').autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=1',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$("#id_book").val(ui.item.value);
		$('#book1').val(ui.item.label); 
		$("#id_book1").val(ui.item.value);
		$('#book2').val(ui.item.label); 
		$("#id_book2").val(ui.item.value);
		$('#book3').val(ui.item.label); 
		$("#id_book3").val(ui.item.value);
		$('#book4').val(ui.item.label); 
		$("#id_book4").val(ui.item.value);
		$('#book5').val(ui.item.label); 
		$("#id_book5").val(ui.item.value);
		$('#book6').val(ui.item.label); 
		$("#id_book6").val(ui.item.value);
		$('#book7').val(ui.item.label); 
		$("#id_book7").val(ui.item.value);
		$('#book8').val(ui.item.label); 
		$("#id_book8").val(ui.item.value);
		$('#book9').val(ui.item.label); 
		$("#id_book9").val(ui.item.value);
		return false; },
		focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false;
    }
	
    });
	
	    $('#group').autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=2',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$("#id_group").val(ui.item.value);
		$('#group1').val(ui.item.label); 
		$("#id_group1").val(ui.item.value);
		$('#group2').val(ui.item.label); 
		$("#id_group2").val(ui.item.value);
		$('#group3').val(ui.item.label); 
		$("#id_group3").val(ui.item.value);
		$('#group4').val(ui.item.label); 
		$("#id_group4").val(ui.item.value);
		$('#group5').val(ui.item.label); 
		$("#id_group5").val(ui.item.value);
		$('#group6').val(ui.item.label); 
		$("#id_group6").val(ui.item.value);
		$('#group7').val(ui.item.label); 
		$("#id_group7").val(ui.item.value);
		$('#group8').val(ui.item.label); 
		$("#id_group8").val(ui.item.value);
		$('#group9').val(ui.item.label); 
		$("#id_group9").val(ui.item.value);
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	});
	
	$('#student').keypress(function () {
		var id_group = $("#id_group").val();
	   	$(this).autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=3&id_group='+id_group+'',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label+' '+ui.item.name+' '+ui.item.otch); 
		$("#id_man").val(ui.item.value); 
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    }).data( "autocomplete" )._renderItem = function( ul, item ) {
		return $( "<li></li>" ).append( "<a>" + item.label + " " + item.name + " " + item.otch + "<br>Почта: "+ item.email+"</a>" ).appendTo( ul );
	};
	 
});
//подгрузка полей
var i = 0;
var h = 0;
var hc = 0;


$('.add').click(function(){

if (i<=9){
	++i;
$('.fields'+i+'').css({display:"block"});
$('.remove').css({display:"block"});
h=$('#giveForm').height(function(j,h){
  return h+70;});
hc=$('.contentform').height(function(g,hc){
  return hc+70;});
if (i==10)
{
$(".add").hide();
$('<div class="attetion">Нельзя добавить больше 10 полей!</div>').fadeIn('350').appendTo('.fields9');	
h=$('#giveForm').height(function(j,h){
  return h-70;});
hc=$('.contentform').height(function(g,hc){
  return hc-70;});
return i=9;
}	
}
});
//удаление полей
$('.remove').click(function(){

if (i>=1 && i<=9){
$('.fields'+i+'').css({display:"none"});
h=$('#giveForm').height(function(j,h){
       return h-60;});
hc=$('.contentform').height(function(g,hc){
       return hc-60;});
 $('.attetion').remove();	   
 $('.add').css({display:"block"});
	--i; 
if (i==0)
{
$('.remove').css({display:"none"});
$('#giveForm').height(180);
$('.contentform').height(250);
return i=0;
}
}
});

//autocomplete для подгруж. полей
    $('#book1').autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=1',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$('#id_book1').val(ui.item.value); 
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    });
	 $('#group1').autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=2',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$("#id_group1").val(ui.item.value);
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	});
	
	$('#student1').keypress(function () {
		var id_group = $("#id_group1").val();
	   	$(this).autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=3&id_group='+id_group+'',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label+' '+ui.item.name+' '+ui.item.otch); 
		$("#id_man1").val(ui.item.value); 
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    }).data( "autocomplete" )._renderItem = function( ul, item ) {
		return $( "<li></li>" ).append( "<a>" + item.label + " " + item.name + " " + item.otch + "<br>Почта: "+ item.email+"</a>" ).appendTo( ul );
	};
}); 
    $('#book2').autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=1',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$('#id_book2').val(ui.item.value); 
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    });
	 $('#group2').autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=2',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$("#id_group2").val(ui.item.value);
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	});
	
	$('#student2').keypress(function () {
		var id_group = $("#id_group2").val();
	   	$(this).autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=3&id_group='+id_group+'',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label+' '+ui.item.name+' '+ui.item.otch); 
		$("#id_man2").val(ui.item.value); 
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    }).data( "autocomplete" )._renderItem = function( ul, item ) {
		return $( "<li></li>" ).append( "<a>" + item.label + " " + item.name + " " + item.otch + "<br>Почта: "+ item.email+"</a>" ).appendTo( ul );
	};
}); 
    $('#book3').autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=1',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$('#id_book3').val(ui.item.value);
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    });
	 $('#group3').autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=2',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$("#id_group3").val(ui.item.value);
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	});
	
	$('#student3').keypress(function () {
		var id_group = $("#id_group3").val();
	   	$(this).autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=3&id_group='+id_group+'',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label+' '+ui.item.name+' '+ui.item.otch); 
		$("#id_man3").val(ui.item.value); 
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    }).data( "autocomplete" )._renderItem = function( ul, item ) {
		return $( "<li></li>" ).append( "<a>" + item.label + " " + item.name + " " + item.otch + "<br>Почта: "+ item.email+"</a>" ).appendTo( ul );
	};
}); 
    $('#book4').autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=1',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$('#id_book4').val(ui.item.value); 
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    });
	 $('#group4').autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=2',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$("#id_group4").val(ui.item.value);
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	});
	
	$('#student4').keypress(function () {
		var id_group = $("#id_group4").val();
	   	$(this).autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=3&id_group='+id_group+'',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label+' '+ui.item.name+' '+ui.item.otch); 
		$("#id_man4").val(ui.item.value); 
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    }).data( "autocomplete" )._renderItem = function( ul, item ) {
		return $( "<li></li>" ).append( "<a>" + item.label + " " + item.name + " " + item.otch + "<br>Почта: "+ item.email+"</a>" ).appendTo( ul );
	};
}); 

    $('#book5').autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=1',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$('#id_book5').val(ui.item.value); 
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    });
	 $('#group5').autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=2',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$("#id_group5").val(ui.item.value);
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	});
	
	$('#student5').keypress(function () {
		var id_group = $("#id_group5").val();
	   	$(this).autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=3&id_group='+id_group+'',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label+' '+ui.item.name+' '+ui.item.otch); 
		$("#id_man5").val(ui.item.value); 
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    }).data( "autocomplete" )._renderItem = function( ul, item ) {
		return $( "<li></li>" ).append( "<a>" + item.label + " " + item.name + " " + item.otch + "<br>Почта: "+ item.email+"</a>" ).appendTo( ul );
	};
}); 
    $('#book6').autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=1',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$('#id_book6').val(ui.item.value); 
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    });
	 $('#group6').autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=2',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$("#id_group6").val(ui.item.value);
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	});
	
	$('#student6').keypress(function () {
		var id_group = $("#id_group6").val();
	   	$(this).autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=3&id_group='+id_group+'',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label+' '+ui.item.name+' '+ui.item.otch); 
		$("#id_man6").val(ui.item.value); 
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    }).data( "autocomplete" )._renderItem = function( ul, item ) {
		return $( "<li></li>" ).append( "<a>" + item.label + " " + item.name + " " + item.otch + "<br>Почта: "+ item.email+"</a>" ).appendTo( ul );
	};
}); 
    $('#book7').autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=1',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$('#id_book7').val(ui.item.value);
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    });
	 $('#group7').autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=2',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$("#id_group7").val(ui.item.value);
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	});
	
	$('#student7').keypress(function () {
		var id_group = $("#id_group7").val();
	   	$(this).autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=3&id_group='+id_group+'',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label+' '+ui.item.name+' '+ui.item.otch); 
		$("#id_man7").val(ui.item.value); 
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    }).data( "autocomplete" )._renderItem = function( ul, item ) {
		return $( "<li></li>" ).append( "<a>" + item.label + " " + item.name + " " + item.otch + "<br>Почта: "+ item.email+"</a>" ).appendTo( ul );
	};
});  
    $('#book8').autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=1',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$('#id_book8').val(ui.item.value); 
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    });
	 $('#group8').autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=2',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$("#id_group8").val(ui.item.value);
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	});
	
	$('#student8').keypress(function () {
		var id_group = $("#id_group8").val();
	   	$(this).autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=3&id_group='+id_group+'',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label+' '+ui.item.name+' '+ui.item.otch); 
		$("#id_man8").val(ui.item.value); 
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    }).data( "autocomplete" )._renderItem = function( ul, item ) {
		return $( "<li></li>" ).append( "<a>" + item.label + " " + item.name + " " + item.otch + "<br>Почта: "+ item.email+"</a>" ).appendTo( ul );
	};
}); 
    $('#book9').autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=1',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$('#id_book9').val(ui.item.value); 
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    });
	 $('#group9').autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=2',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$("#id_group9").val(ui.item.value);
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	});
	
	$('#student9').keypress(function () {
		var id_group = $("#id_group9").val();
	   	$(this).autocomplete({
        source:'scripts/unit6/autocomplete.php?id_q=3&id_group='+id_group+'',
		delay:10,
		minLength: 1,
		select: function (event, ui) {
		$(this).val(ui.item.label+' '+ui.item.name+' '+ui.item.otch); 
		$("#id_man9").val(ui.item.value); 
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    }).data( "autocomplete" )._renderItem = function( ul, item ) {
		return $( "<li></li>" ).append( "<a>" + item.label + " " + item.name + " " + item.otch + "<br>Почта: "+ item.email+"</a>" ).appendTo( ul );
	};
}); 
//кнопка для очитски значений
$('#giveFormgroup .fieldg1 .cross').click(function(){
$('#giveFormgroup .fieldg1 input').val("");
	
});
$('#giveFormgroup .fieldg2 .cross').click(function(){
$('#giveFormgroup .fieldg2 input').val("");
$("#list").setGridParam({url:"scripts/unit6/getdataunit6.php",datatype:"json", page:1}).trigger("reloadGrid"); 
});
$('#giveFormgroup .fieldg3 .cross').click(function(){
$('#giveFormgroup .fieldg3 input').val("");
$("#list").setGridParam({url:"scripts/unit6/getdataunit6.php",datatype:"json", page:1}).trigger("reloadGrid"); 
});
$('.fields .cross').click(function(){
$('.fields .field input').val("");	
});
$('.fields1 .cross').click(function(){
$('.fields1 .field input').val("");	
});
$('.fields2 .cross').click(function(){
$('.fields2 .field input').val("");	
});
$('.fields3 .cross').click(function(){
$('.fields3 .field input').val("");	
});
$('.fields4 .cross').click(function(){
$('.fields4 .field input').val("");	
});
$('.fields5 .cross').click(function(){
$('.fields5 .field input').val("");	
});
$('.fields6 .cross').click(function(){
$('.fields6 .field input').val("");	
});
$('.fields7 .cross').click(function(){
$('.fields7 .field input').val("");	
});
$('.fields8 .cross').click(function(){
$('.fields8 .field input').val("");	
});
$('.fields9 .cross').click(function(){
$('.fields9 .field input').val("");	
});
//для отправки формы
 $('#giveForm').submit(function(){
				
		         var id_book = $("#id_book").val();
                 var id_man = $("#id_man").val();
                 var id_book1 = $("#id_book1").val();
                 var id_man1 = $("#id_man1").val();
                 var id_book2 = $("#id_book2").val();
                 var id_man2 = $("#id_man2").val();
                 var id_book3 = $("#id_book3").val();
                 var id_man3 = $("#id_man3").val();
                 var id_book4 = $("#id_book4").val();
                 var id_man4 = $("#id_man4").val();
                 var id_book5 = $("#id_book5").val();
                 var id_man5 = $("#id_man5").val();
		         var id_book6 = $("#id_book6").val();
                 var id_man6 = $("#id_man6").val();
                 var id_book7 = $("#id_book7").val();
                 var id_man7 = $("#id_man7").val();
                 var id_book8 = $("#id_book8").val();
                 var id_man8 = $("#id_man8").val();
                 var id_book9 = $("#id_book9").val();
                 var id_man9 = $("#id_man9").val();

				 		 				  
                $.ajax({  
                  type: "POST",  
                  url: "scripts/unit6/saveform.php",  
                  data: 'i='+i+'&id_book='+id_book+'&id_man='+id_man
                  +'&id_book1='+id_book1+'&id_man1='+id_man1
                  +'&id_book2='+id_book2+'&id_man2='+id_man2
                  +'&id_book3='+id_book3+'&id_man3='+id_man3
                  +'&id_book4='+id_book4+'&id_man4='+id_man4
                  +'&id_book5='+id_book5+'&id_man5='+id_man5
                  +'&id_book6='+id_book6+'&id_man6='+id_man6
                  +'&id_book7='+id_book7+'&id_man7='+id_man7
                  +'&id_book8='+id_book8+'&id_man8='+id_man8
                  +'&id_book9='+id_book9+'&id_man9='+id_man9,
		  beforeSend: function() {$(".contentform").html("<div id='preloader'></div>");},    
		  success: function(data){
                  $(".contentform").html("<div id='attentionFormunit1'><a class='attentionText' href='unit6.php'>"+data+"</a></div>");
				  setTimeout('window.location.href = "unit6.php"', 3000);}
						  
                    
                });  
                return false;  
            });  
                   

});
