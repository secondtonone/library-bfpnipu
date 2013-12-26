$(document).ready(function(){


$(".unit2").each(function(){
 
    $(this).addClass("selected");


});

var lastSel;
		
$("#list").jqGrid({
            url:'scripts/unit2/getdataunit2.php',
            datatype: 'json',
            mtype: 'POST',
            colNames:['#', 'Книга', 'Год','Дата выдачи','На руках','Потеря','Примечание','Статус'],	 
            colModel :[
                {name:'id_vid', index:'id_vid', width:20, align:'right', search:false},				
				{name:'name_book', index:'name_book', width:100, align:'left', edittype:"text", search:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'year_create', index:'year_create', width:30, align:'center', edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'data_vidachi', index:'data_vidachi', width:50, align:'left', edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'na_rukah', index:'na_rukah', width:20, align:'center',editable:true,edittype:"checkbox",formatter:"checkbox",editoptions: {value:"Yes:No"},search:false},
				{name:'poterya', index:'poterya', width:20, align:'center',editable:true, edittype:"checkbox",formatter:"checkbox",editoptions: {value:"Yes:No"},search:false},
				{name:'primechanie', index:'primechanie', width:70, align:'center',editable:true, edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'status', index:'status', width:50, align:'center', edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}}
                
                ],
            pager: '#pager',
			autowidth:true,
            height:300,
			rowNum:15,
            rowList:[15,30,45],
            sortname: 'id_vid',
            sortorder: "asc",
			viewrecords: true,
			caption: 'Приём изданий',
   			subGrid: true,
			subGridRowExpanded: function(subgrid_id, row_id) {

			
			subgrid_table_id = subgrid_id+"_tt";
		    
					
		$("#"+subgrid_id).append("<div class='subgridform2'><table id='"+subgrid_table_id+"' class='scroll'></div></div>");
		
		jQuery("#"+subgrid_table_id).jqGrid({
			url:"scripts/unit2/subgridunit2.php?q=2&id="+row_id,
			datatype: "json",
			mtype: 'GET',
			colNames: ['Авторы','Всего','Остаток'],
			colModel: [
				{name:"fam_io",index:"fam_io",width:200, align:'left'},
				{name:"kolvo_vsego",index:"kolvo_vsego",width:50, align:'center'},
				{name:"ostatok",index:"ostatok",width:50, align:'center'}		
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
            editurl: 'scripts/unit2/saverowunit2.php'
        }).navGrid('#pager',{view:false, del:false, add:false, edit:false, search:false}, 
			{}, //  default settings for edit
			{}, //  default settings for add
			{},  // delete instead that del:false we need this
			{}, // search options
			{} 
		); 
		$("#list").jqGrid('filterToolbar',{searchOperators:true,stringResult:true,searchOnEnter:false});
		





 });  
