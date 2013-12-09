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
        }).navGrid('#pager',{view:false, del:false, add:false, edit:true, search:false}, 
			{}, //  default settings for edit
			{}, //  default settings for add
			{},  // delete instead that del:false we need this
			{}, // search options
			{} 
		); 
		$("#list").jqGrid('filterToolbar',{searchOperators:true,stringResult:true,searchOnEnter:false});
		
  
    //эта функция добавляет GET параметр в запрос на получение
    //данных для таблицы и обновляет её
    
    
    //настройка плагина Autocomplete
    //при возникновении события onSelect вызываем функцию updateTable
    $('#city_field').autocomplete({
        serviceUrl:'search.php',
        maxHeight:150,
      
		
    });
	 
    
    //этот обработчик используется если посетитель ввел название города
    //и нажал Enter
    $('#autocomplete_form').submit(function() {
        updateTable($('#city_field').val());

        return false;
		
    });
	




 });  