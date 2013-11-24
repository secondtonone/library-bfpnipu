$(document).ready(function(){

$(".unit1").each(function(){

    $(this).addClass("selected");
});

var lastSel;
		
$("#list").jqGrid({
            url:'scripts/unit1/getdataunit1.php',
            datatype: 'json',
            mtype: 'POST',
            colNames:['#', 'Название книги','Год издания', 'Всего','УДК', 'Кафедра', 'Остаток'],
            colModel :[
                {name:'id_book', index:'id_book', width:40, align:'right', search:false}
                ,{name:'name_book', index:'name_book', width:350, align:'left', edittype:"text",searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'year_create', index:'year_create', width:60, align:'center', edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'kolvo_vsego', index:'kolvo_vsego', width:65, align:'center', editable:true, edittype:"text",sorttype:'integer', searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'UDK', index:'UDK', width:55, align:'left', edittype:"text", search:false, searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},				
				{name:'name_kratko', index:'name_kratko', width:70, align:'left', edittype:"text", search:false,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'ostatok', index:'ostatok', width:50, align:'center',editable:true, edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}}
                
                ],
            pager: '#pager',
			width:1000,
            height:300,
			rowNum:15,
            rowList:[15,30,45],
            sortname: 'id_book',
            sortorder: "asc",
            caption: 'Данные о книгах',
			subGrid: true,
			subGridRowExpanded: function(subgrid_id, row_id) {
		// we pass two parameters
		// subgrid_id is a id of the div tag created whitin a table data
		// the id of this elemenet is a combination of the "sg_" + id of the row
		// the row_id is the id of the row
		// If we wan to pass additinal parameters to the url we can use
		// a method getRowData(row_id) - which returns associative array in type name-value
		// here we can easy construct the flowing
		var subgrid_table_id, pager_id;
		subgrid_table_id = subgrid_id+"_t";
		pager_id = "p_"+subgrid_table_id;
		
		$("#"+subgrid_id).html("<div class='subgridform'><table id='"+subgrid_table_id+"' class='scroll'></table></div>");
		
		jQuery("#"+subgrid_table_id).jqGrid({
			url:"scripts/unit1/subgridunit1.php?id="+row_id,
			datatype: "json",
			mtype: 'GET',
			colNames: ['Автор'],
			colModel: [
				{name:"fam_io",index:"fam_io",width:250}		
			],
		   	rowNum:20,
		   	sortname: 'fam_io',
		    sortorder: "asc",
		    height: '100%'
		});
		},
            ondblClickRow: function(id) {
                
                    $("#list").restoreRow(lastSel);
                    $("#list").editRow(id, true);
                    lastSel = id;
               
            }, 
			onSelectRow: function(id) {
               jQuery("#list").restoreRow(lastSel);
}, 
            editurl: 'scripts/unit1/saverowunit1.php'
        }).navGrid('#pager',{view:false, del:false, add:false, edit:false, search:false}, 
			{}, //  default settings for edit
			{}, //  default settings for add
			{},  // delete instead that del:false we need this
			{}, // search options
			{} 
		); 
		$("#list").jqGrid('filterToolbar',{searchOperators:true,stringResult:true,searchOnEnter:false});

    $('#book').autocomplete({
        source:'scripts/unit1/autocomplete.php?id_q=1',
		delay:10,
		minLength: 3,
		select: function (event, ui) {
		$(this).val(ui.item.label); 
		$("#id_book").val(ui.item.value);
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
		return $( "<li></li>" ).append( "<a>" + item.label + " " + item.name + " " + item.otch + "</a>" ).appendTo( ul );
	};
	 
});

var i = 1;
var h = 0;
var hc = 0;
$('.add').click(function(){
if (i<10){
$('.fields'+i+'').css({display:"block"});
h=$('#giveForm').height(function(j,h){
       return h+70;});
hc=$('.contentform').height(function(g,hc){
       return hc+70;});

	i++; 
} else{
		   $(".add").hide();
		   $('<div class="attetion">Нельзя добавить больше 10 полей!</div>').fadeIn('350').appendTo('.fields9');}
});


    $('#book1').autocomplete({
        source:'scripts/unit1/autocomplete.php?id_q=1',
		delay:10,
		minLength: 3,
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
		return $( "<li></li>" ).append( "<a>" + item.label + " " + item.name + " " + item.otch + "</a>" ).appendTo( ul );
	};
}); 
    $('#book2').autocomplete({
        source:'scripts/unit1/autocomplete.php?id_q=1',
		delay:10,
		minLength: 3,
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
		return $( "<li></li>" ).append( "<a>" + item.label + " " + item.name + " " + item.otch + "</a>" ).appendTo( ul );
	};
}); 
    $('#book3').autocomplete({
        source:'scripts/unit1/autocomplete.php?id_q=1',
		delay:10,
		minLength: 3,
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
		return $( "<li></li>" ).append( "<a>" + item.label + " " + item.name + " " + item.otch + "</a>" ).appendTo( ul );
	};
}); 
    $('#book4').autocomplete({
        source:'scripts/unit1/autocomplete.php?id_q=1',
		delay:10,
		minLength: 3,
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
		return $( "<li></li>" ).append( "<a>" + item.label + " " + item.name + " " + item.otch + "</a>" ).appendTo( ul );
	};
}); 

    $('#book5').autocomplete({
        source:'scripts/unit1/autocomplete.php?id_q=1',
		delay:10,
		minLength: 3,
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
		return $( "<li></li>" ).append( "<a>" + item.label + " " + item.name + " " + item.otch + "</a>" ).appendTo( ul );
	};
}); 
    $('#book6').autocomplete({
        source:'scripts/unit1/autocomplete.php?id_q=1',
		delay:10,
		minLength: 3,
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
		return $( "<li></li>" ).append( "<a>" + item.label + " " + item.name + " " + item.otch + "</a>" ).appendTo( ul );
	};
}); 
    $('#book7').autocomplete({
        source:'scripts/unit1/autocomplete.php?id_q=1',
		delay:10,
		minLength: 3,
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
		return $( "<li></li>" ).append( "<a>" + item.label + " " + item.name + " " + item.otch + "</a>" ).appendTo( ul );
	};
});  
    $('#book8').autocomplete({
        source:'scripts/unit1/autocomplete.php?id_q=1',
		delay:10,
		minLength: 3,
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
		return $( "<li></li>" ).append( "<a>" + item.label + " " + item.name + " " + item.otch + "</a>" ).appendTo( ul );
	};
}); 
    $('#book9').autocomplete({
        source:'scripts/unit1/autocomplete.php?id_q=1',
		delay:10,
		minLength: 3,
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
		return $( "<li></li>" ).append( "<a>" + item.label + " " + item.name + " " + item.otch + "</a>" ).appendTo( ul );
	};
}); 

});