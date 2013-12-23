$(document).ready(function(){

$(".unit4").each(function(){

    $(this).addClass("selected");
});
//jqgrid плагин
var lastSel;
		
$("#list").jqGrid({
            url:'scripts/unit4/getdataunit4.php',
            datatype: 'json',
            mtype: 'POST',
            colNames:['#', 'Эл. адрес','Книги', 'Статус','Время отправки'],
            colModel :[
                {name:'id_mail', index:'id_mail', width:20, align:'right', search:false}
                ,{name:'mail', index:'mail', width:50, align:'left', edittype:"text",searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'titles', index:'titles', width:350, align:'center', edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'mark', index:'mark', width:65, align:'center', editable:true, edittype:"text",sorttype:'integer', searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'date_change', index:'date_change', width:55, align:'left', edittype:"text",searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}}         
                ],
            pager: '#pager',
			autowidth:true,
            height:300,
			rowNum:15,
            rowList:[15,30,45],
            sortname: 'id_mail',
            sortorder: "asc",
			viewrecords: true,
            caption: 'Процесс рассылки'			
        }).navGrid('#pager',{view:false, del:false, add:false, edit:false, search:false}
		); 
		$("#list").jqGrid('filterToolbar',{searchOperators:true,stringResult:true,searchOnEnter:false});


$("#list1").jqGrid({
            url:'scripts/unit4/getdataunit42.php',
            datatype: 'json',
            mtype: 'POST',
            colNames:['#', 'Фамилия','Имя', 'Отчество','Группа', 'Книга', 'Год'],	 
            colModel :[{name:'id_vid', index:'id_vid', width:20, align:'right', search:false}
                ,{name:'fam', index:'fam', width:60, align:'left', edittype:"text",searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'name', index:'name', width:60, align:'left', edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'otchestvo', index:'otchestvo', width:69, align:'left', edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'name_group', index:'name_group', width:55, align:'center', edittype:"text", search:true, searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},				
				{name:'name_book', index:'name_book', width:70, align:'left', edittype:"text", search:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'year_create', index:'year_create', width:50, align:'center', edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}}                
                ],
            pager: '#pager1',
			autowidth:true,
            height:300,
			rowNum:15,
            rowList:[15,30,45],
            sortname: 'id_vid',
            sortorder: "asc",
            viewrecords: true,
            caption: 'Должники без эл. адреса'
		}).navGrid('#pager1',{view:false, del:false, add:false, edit:false, search:false}).navSeparatorAdd("#pager1",{sepclass:"ui-separator",sepcontent: ''}).navButtonAdd("#pager1",{caption:"",buttonicon:"ui-icon-document", onClickButton:
	                         function () { 
          $("#list1").jqGrid('excelExport',{"url":"scripts/unit4/excelexport.php"});
       } , position: "last", title:"Экспорт в Excel", cursor: "pointer"}); 
		$("#list1").jqGrid('filterToolbar',{searchOperators:true,stringResult:true,searchOnEnter:false});

 });		




  
