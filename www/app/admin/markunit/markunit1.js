$(document).ready(function(){

$(".unit1").each(function(){

    $(this).addClass("selected");
});

var lastSel;
		
$("#list").jqGrid({
            url:'getdata.php',
            datatype: 'json',
            mtype: 'POST',
            colNames:['#', 'Название книги','Автор','Автор','Год издания','Дисциплина','В наличии', 'Всего', 'Кафедра', 'УДК', 'ББК', 'ISBN',  'Аннотация'],
            colModel :[
                {name:'id', index:'id', width:40, align:'right', search:false}
                ,{name:'namebook', index:'namebook', width:350, align:'left',editable:true, edittype:"text",searchoptions:{sopt:['eq','ne','bw','cn']}},				{name:'avtor', index:'avtor', width:110, align:'left',editable:true, edittype:"text", searchoptions:{sopt:['eq','ne','bw','cn']}},{name:'avtor2', index:'avtor2', width:110, align:'left',editable:true, edittype:"text", searchoptions:{sopt:['eq','ne','bw','cn']}},
				{name:'yearcreate', index:'yearcreate', width:60, align:'left', editable:true, edittype:"text", searchoptions:{sopt:['eq','ne','bw','cn']}},
				{name:'disciplina', index:'disciplina', width:110, align:'left', editable:true, edittype:"text", searchoptions:{sopt:['eq','ne','bw','cn']}},
				{name:'bookcount', index:'bookcount', width:65, align:'left', editable:true, edittype:"text", searchoptions:{sopt:['eq','ne','bw','cn']}},
				{name:'allcount', index:'allcount', width:65, align:'left', editable:true, edittype:"text", searchoptions:{sopt:['eq','ne','bw','cn']}},				
				{name:'nazkaf_krat', index:'nazkaf_krat', width:120, align:'left', editable:true, edittype:"text", searchoptions:{sopt:['eq','ne','bw','cn']}},
								{name:'udk', index:'udk', width:50, align:'left',editable:true, edittype:"text", searchoptions:{sopt:['eq','ne','bw','cn']}}
                ,{name:'bbk', index:'bbk', width:50, align:'left',editable:true, edittype:"text", searchoptions:{sopt:['eq','ne','bw','cn']}}
                ,{name:'isbn', index:'isbn', width:70, align:'left', editable:true, edittype:"text", searchoptions:{sopt:['eq','ne','bw','cn']}},
				{name:'annotation', index:'annotation', width:50, align:'left', editable:true, edittype:"text", searchoptions:{sopt:['eq','ne','bw','cn']}}
                ],
            pager: jQuery('#pager'),
			width:1000,
            height:300,
            rowNum:5,
            rowList:[5,10,30],
            sortname: 'id',
            sortorder: "asc",
            viewrecords: true,
            caption: 'Данные о книгах',
           ondblClickRow: function(id) {
                
                    jQuery("#list").restoreRow(lastSel);
                    jQuery("#list").editRow(id, true);
                    lastSel = id;
               
            }, onSelectRow: function(id) {
               jQuery("#list").restoreRow(lastSel);
}, 
            editurl: 'saverow.php'
        }).navGrid('#pager',{view:false, del:false, add:false, edit:false}, 
			{}, //  default settings for edit
			{}, //  default settings for add
			{},  // delete instead that del:false we need this
			{closeOnEscape:true, multipleSearch:true, closeAfterSearch:true}, // search options
			{} 
		); 
		$("#list").jqGrid('filterToolbar',{searchOperators:true});
  
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