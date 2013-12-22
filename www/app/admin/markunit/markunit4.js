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
            caption: 'Данные о книгах'			
        }).navGrid('#pager',{view:false, del:false, add:false, edit:false, search:false}
		); 
		$("#list").jqGrid('filterToolbar',{searchOperators:true,stringResult:true,searchOnEnter:false});
		



}); 
 
  