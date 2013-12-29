$(document).ready(function(){
//для подсветки меню
$(".unit1").each(function(){
    $(this).addClass("selected");
});
//jqgrid плагин
var lastSel;
		
$("#list").jqGrid({
            url:'scripts/unit1/getdataunit1.php',
            datatype: 'json',
            mtype: 'POST',
            colNames:['#', 'Название книги','Издательство','Кол-во страниц','Год издания', 'Всего','УДК','Кафедра','Остаток'],
            colModel :[{name:'id_book', index:'id_book', width:40, align:'right', search:false},
				{name:'name_book', index:'name_book', width:350, align:'left', edittype:"textarea",editable:true,editoptions:{rows:"3",cols:"50"},searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'izdatelstvo', index:'izdatelstvo', width:60, align:'center', edittype:"select",formatter:"select",editoptions:{value:":;9:Пермский государственный технический университет;10:Пермский национальный исследовательский политехнический университет"},search:false,editable:true, searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'kolvo_str', index:'kolvo_str', width:60, align:'center', edittype:"text",editable:true, searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'year_create', index:'year_create', width:60, align:'center', edittype:"select",formatter:"select",editoptions:{value:":;2000:2000;2001:2001;2002:2002;2003:2003;2004:2004;2005:2005;2006:2006;2007:2007;2008:2008;2009:2009;2010:2010;2011:2011;2012:2012;2013:2013;2014:2014;2015:2015;2016:2016;2017:2017;2018:2018;2019:2019;2020:2020"},editable:true, searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'kolvo_vsego', index:'kolvo_vsego', width:65, align:'center', editable:true, edittype:"text",sorttype:'integer', searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'UDK', index:'UDK', width:55, align:'left',editable:true, edittype:"text", search:false, searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'id_kafedra', index:'id_kafedra', width:55, align:'left', edittype:"select",formatter:"select",search:false,editoptions:{value:"1:АТП;2:ХТиЭ;4:ОНД;5:Экономики;7:ТМП;8:ТКМ"},editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'ostatok', index:'ostatok', width:50, align:'center',editable:true, edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}}
 ],
            pager: '#pager',
			autowidth:true,
            height:300,
			rowNum:15,
            rowList:[15,30,45,90],
            sortname: 'id_book',
            sortorder: "asc",
            caption: 'Данные о книгах',
			viewrecords: true,
			subGrid: true,
			ondblClickRow: function(id) {
			celValue = $("#list").jqGrid ('getCell', id, 'name_book');
			$("#id_book").val(id);
			$("#book").val(celValue);
		},
			subGridRowExpanded: function(subgrid_id, row_id) {
		// subgrid
		var subgrid_table_id, pager_id;
		subgrid_table_id = subgrid_id+"_t";
		pager_id = "p_"+subgrid_table_id;
		
		$("#"+subgrid_id).html("<div class='subgridform'><table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");
		
		jQuery("#"+subgrid_table_id).jqGrid({
			url:"scripts/unit1/subgridunit1.php?id="+row_id,
			datatype: "json",
			mtype: 'GET',
			colNames: ['#','Автор'],
			colModel: [
			{name: "id_avtor",index: "id_avtor",editable: true,edittype: "text",hidden: true},{name:"fam_io",index:"fam_io",width:250,editable:true, edittype:"text", search:false, editoptions:{
      size: 35,
      dataInit: function (e) {
        $(e).autocomplete({
          source: "scripts/unit1/subgridunit1.php?q=1",
          minLength: 1,
          focus: function (event, ui) {
            $(e).val(ui.item.label);
			return false;
          },
          select: function (event, ui) {
            $(e).val(ui.item.label);
            $("input#id_avtor").val(ui.item.value);
			return false;
          }
        });}}}],
		   	rowNum:20,
			pager: pager_id,
		   	sortname: 'fam_io',
		    sortorder: "asc",
			viewrecords: true,
			editurl: "scripts/unit1/savesubgridunit1.php?idbook="+row_id,
		    height: '100%'
		}).navGrid('#'+pager_id,{view:false, del:false, add:true, edit:false, search:false},{width:375,reloadAfterSubmit:true,zIndex:99},  
			{width:375,reloadAfterSubmit:true,zIndex:99}, 
			{},{});
		},editurl: 'scripts/unit1/saverowunit1.php'
        }).navGrid('#pager',{view:false, del:false, add:true, edit:true, search:false},{width:770,height:400,reloadAfterSubmit:true},{width:770,height:400,reloadAfterSubmit:true},  
			{width:770,height:400,reloadAfterSubmit:true}, 
			{},{}); 
		$("#list").jqGrid('filterToolbar',{searchOperators:true,stringResult:true,searchOnEnter:false});
//autocomplete для певого поля
        function updateTable(value) {
    $("#list").setGridParam({url:"scripts/unit1/getdataunit1.php?idbook="+value,datatype:"json", page:1})
      .trigger("reloadGrid"); 
	$("#list").setGridParam({url:"scripts/unit1/getdataunit1.php",datatype:"json", page:1})
  }
        

        $('#book').autocomplete({
        source:'scripts/unit1/autocomplete.php?id_q=1',
		delay:10,
		minLength: 3,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$("#id_book").val(ui.item.value);
		$('#book1').val(ui.item.label); 
		updateTable(ui.item.value);
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
        source:'scripts/unit1/autocomplete.php?id_q=2',
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
        source:'scripts/unit1/autocomplete.php?id_q=3&id_group='+id_group+'',
		delay:10,
		minLength: 3,
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
        source:'scripts/unit1/autocomplete.php?id_q=1',
		delay:10,
		minLength: 3,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$('#id_book1').val(ui.item.value); 
		updateTable(ui.item.value);
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    });
	 $('#group1').autocomplete({
        source:'scripts/unit1/autocomplete.php?id_q=2',
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
        source:'scripts/unit1/autocomplete.php?id_q=3&id_group='+id_group+'',
		delay:10,
		minLength: 3,
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
        source:'scripts/unit1/autocomplete.php?id_q=1',
		delay:10,
		minLength: 3,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$('#id_book2').val(ui.item.value); 
		updateTable(ui.item.value);
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    });
	 $('#group2').autocomplete({
        source:'scripts/unit1/autocomplete.php?id_q=2',
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
        source:'scripts/unit1/autocomplete.php?id_q=3&id_group='+id_group+'',
		delay:10,
		minLength: 3,
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
        source:'scripts/unit1/autocomplete.php?id_q=1',
		delay:10,
		minLength: 3,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$('#id_book3').val(ui.item.value);
		updateTable(ui.item.value); 
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    });
	 $('#group3').autocomplete({
        source:'scripts/unit1/autocomplete.php?id_q=2',
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
        source:'scripts/unit1/autocomplete.php?id_q=3&id_group='+id_group+'',
		delay:10,
		minLength: 3,
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
    $('#book4').autocomplete({
        source:'scripts/unit1/autocomplete.php?id_q=1',
		delay:10,
		minLength: 3,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$('#id_book4').val(ui.item.value); 
		updateTable(ui.item.value);
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    });
	 $('#group4').autocomplete({
        source:'scripts/unit1/autocomplete.php?id_q=2',
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
        source:'scripts/unit1/autocomplete.php?id_q=3&id_group='+id_group+'',
		delay:10,
		minLength: 3,
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
        source:'scripts/unit1/autocomplete.php?id_q=1',
		delay:10,
		minLength: 3,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$('#id_book5').val(ui.item.value); 
		updateTable(ui.item.value);
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    });
	 $('#group5').autocomplete({
        source:'scripts/unit1/autocomplete.php?id_q=2',
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
        source:'scripts/unit1/autocomplete.php?id_q=3&id_group='+id_group+'',
		delay:10,
		minLength: 3,
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
        source:'scripts/unit1/autocomplete.php?id_q=1',
		delay:10,
		minLength: 3,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$('#id_book6').val(ui.item.value); 
		updateTable(ui.item.value);
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    });
	 $('#group6').autocomplete({
        source:'scripts/unit1/autocomplete.php?id_q=2',
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
        source:'scripts/unit1/autocomplete.php?id_q=3&id_group='+id_group+'',
		delay:10,
		minLength: 3,
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
        source:'scripts/unit1/autocomplete.php?id_q=1',
		delay:10,
		minLength: 3,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$('#id_book7').val(ui.item.value);
		updateTable(ui.item.value); 
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    });
	 $('#group7').autocomplete({
        source:'scripts/unit1/autocomplete.php?id_q=2',
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
        source:'scripts/unit1/autocomplete.php?id_q=3&id_group='+id_group+'',
		delay:10,
		minLength: 3,
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
        source:'scripts/unit1/autocomplete.php?id_q=1',
		delay:10,
		minLength: 3,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$('#id_book8').val(ui.item.value); 
		updateTable(ui.item.value);
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    });
	 $('#group8').autocomplete({
        source:'scripts/unit1/autocomplete.php?id_q=2',
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
        source:'scripts/unit1/autocomplete.php?id_q=3&id_group='+id_group+'',
		delay:10,
		minLength: 3,
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
        source:'scripts/unit1/autocomplete.php?id_q=1',
		delay:10,
		minLength: 3,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$('#id_book9').val(ui.item.value); 
		updateTable(ui.item.value);
        return false; },
        focus: function(event, ui) {
        $(this).val(ui.item.label);
        return false; 
    }
	
    });
	 $('#group9').autocomplete({
        source:'scripts/unit1/autocomplete.php?id_q=2',
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
        source:'scripts/unit1/autocomplete.php?id_q=3&id_group='+id_group+'',
		delay:10,
		minLength: 3,
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
                  url: "scripts/unit1/saveform.php",  
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
                  $(".contentform").html("<div id='attentionFormunit1'><a class='attentionText' href='unit1.php'>"+data+"</a></div>");
				  setTimeout('window.location.href = "unit1.php"', 3000);}
						  
                    
                });  
                return false;  
            });  
                   

});
