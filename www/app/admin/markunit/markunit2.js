$(document).ready(function(){


$(".unit2").each(function(){
 
    $(this).addClass("selected");


});

var lastSel;
		
$("#list").jqGrid({
            url:'scripts/unit2/getdataunit2.php',
            datatype: 'json',
            mtype: 'POST',
            colNames:['Действия','#', 'Фамилия','Имя', 'Отчество','Группа', 'Книга', 'Год','Дата выдачи','Дата возврата','На руках','Потеря','Примечание'],	 
            colModel :[{name:'act',index:'act', width:41,sortable:false,search:false},
                {name:'id_vid', index:'id_vid', width:20, align:'right', search:false}
                ,{name:'fam', index:'fam', width:60, align:'left', edittype:"text",searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'name', index:'name', width:60, align:'left', edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'otchestvo', index:'otchestvo', width:69, align:'left', edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'name_group', index:'name_group', width:55, align:'center', edittype:"text", search:true, searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},				
				{name:'name_book', index:'name_book', width:70, align:'left', edittype:"text", search:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'year_create', index:'year_create', width:50, align:'center', edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'data_vidachi', index:'data_vidachi', width:50, align:'left', edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'data_vozvrata', index:'data_vozvrata', width:50, align:'left', edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'na_rukah', index:'na_rukah', width:30, align:'center',editable:true,edittype:"checkbox",formatter:"checkbox",editoptions: {value:"Yes:No"},search:false},
				{name:'poterya', index:'poterya', width:30, align:'center',editable:true, edittype:"checkbox",formatter:"checkbox",editoptions: {value:"Yes:No"},search:false},
				{name:'primechanie', index:'primechanie', width:70, align:'center',editable:true, edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}}
                
                ],
            pager: '#pager',
			autowidth:true,
            height:300,
			rowNum:15,
            rowList:[15,30,45],
            sortname: 'id_vid',
            sortorder: "asc",
            caption: 'Приём изданий',
            viewrecords: true,
			subGrid: true,
			multiselect: true,
			subGridRowExpanded: function(subgrid_id, row_id) {

		var subgrid_table_id, pager_id;
		subgrid_table_id = subgrid_id+"_t";
		
		
		$("#"+subgrid_id).html("<div class='subgridform'><table id='"+subgrid_table_id+"' class='scroll'></div></div>");
		
		jQuery("#"+subgrid_table_id).jqGrid({
			url:"scripts/unit2/subgridunit2.php?q=1&id="+row_id,
			datatype: "json",
			mtype: 'GET',
			colNames: ['Номер зачетной книжки', 'Всего задолжностей'],
			colModel: [
				{name:"number_zach",index:"number_zach",width:150, align:'center'},	
				{name:"count",index:"count",width:150, align:'center'}		
			],
		   	rowNum:20,
		   	sortname: 'number_zach',
		    sortorder: "asc",
		    height: '100%'
		});
		
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
			viewrecords: true,
			height: '100%'
		});
		},
           gridComplete: function(){
		var ids = jQuery("#list").jqGrid('getDataIDs');
		for(var i=0;i < ids.length;i++){
			var cl = ids[i];
			be = "<input type='button' title='Редактировать' class='my-ui-icon-pecil' onclick=\"jQuery('#list').editRow('"+cl+"');\"  />"; 
			se = "<input type='button' title='Сохранить' class='my-ui-icon-disk' onclick=\"jQuery('#list').saveRow('"+cl+"');\"  />"; 
			ce = "<input type='button' title='Отменить' class='my-ui-icon-cancel' onclick=\"jQuery('#list').restoreRow('"+cl+"');\" />"; 
			jQuery("#list").jqGrid('setRowData',ids[i],{act:be+se+ce});
		}	
	},editurl: 'scripts/unit2/saverowunit2.php'
        }).navGrid('#pager',{view:false, del:false, add:false, edit:false, search:false}).navSeparatorAdd("#pager",{sepclass:"ui-separator",sepcontent: ''}).navButtonAdd("#pager",{caption:"",buttonicon:"ui-icon-pencil",onClickButton: function(){var s;
										  s = $("#list").jqGrid('getGridParam','selarrrow');
										  if (s==false)
										  { alert("Поля не отмечаны!");
											  }else{
										 for(var i=0;i<s.length;i++){
			                             var cl = s[i];
										 $("#list").editRow(cl, true);
										 }}}, position: "last", title:"Редактирование", cursor: "pointer"}).navButtonAdd("#pager",{caption:"",buttonicon:"ui-icon-disk",onClickButton: function(){
			   								var s;
											
	                                       s = $("#list").jqGrid('getGridParam','selarrrow');
										   
										   for(var i=0;i<s.length;i++){
			                                       var cl = s[i];
										$('#list').saveRow(cl);
										  }}, position: "last", title:"Сохранение", cursor: "pointer"}).navButtonAdd("#pager",{caption:"",buttonicon:"ui-icon-cancel",onClickButton: function(){
			   								var s;
	                                       s = $("#list").jqGrid('getGridParam','selarrrow');
										   for(var i=0;i<s.length;i++){
			                               var cl = s[i];
										$('#list').restoreRow(cl);}}, position: "last", title:"Отмена", cursor: "pointer"}).navSeparatorAdd("#pager",{sepclass:"ui-separator",sepcontent: ''}).navButtonAdd("#pager",{caption:"",buttonicon:"ui-icon-document", onClickButton:
	                         function () { 
          $("#list").jqGrid('excelExport',{"url":"scripts/unit2/excelexport.php"});
       } , position: "last", title:"Экспорт в Excel", cursor: "pointer"}); 
		$("#list").jqGrid('filterToolbar',{searchOperators:true,stringResult:true,searchOnEnter:false});

 });  
