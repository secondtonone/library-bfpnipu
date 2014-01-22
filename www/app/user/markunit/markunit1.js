$(document).ready(function(){

$(".unit1").each(function(){

    $(this).addClass("selected");
});
$("a[href='help.php']").each(function(){
      $(this).attr('href', $(this).attr('href')+'#unit2');
   });

		
$("#list").jqGrid({
            url:'scripts/unit1/getdataunit1.php',
            datatype: 'json',
            mtype: 'POST',
            colNames:['#', 'Название книги','Год издания', 'Тираж','УДК', 'Кафедра', 'Остаток'],
            colModel :[
                {name:'id_book', index:'id_book', width:40, align:'right', search:false}
                ,{name:'name_book', index:'name_book', width:350, align:'left', edittype:"text",searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'year_create', index:'year_create', width:60, align:'center', edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'kolvo_vsego', index:'kolvo_vsego', width:65, align:'center', edittype:"text",sorttype:'integer', searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'UDK', index:'UDK', width:55, align:'left', edittype:"text", search:false, searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},				
				{name:'name_kratko', index:'name_kratko', width:70, align:'left', edittype:"text", search:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'ostatok', index:'ostatok', width:50, align:'center', edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}}
                
                ],
            pager: '#pager',
			autowidth:true,
            height:300,
			rowNum:15,
            rowList:[15,30,45],
            sortname: 'id_book',
            sortorder: "asc",
			viewrecords: true,
            caption: 'Данные о книгах',
			subGrid: true,
			subGridRowExpanded: function(subgrid_id, row_id) {

		var subgrid_table_id, pager_id;
		subgrid_table_id = subgrid_id+"_t";
		pager_id = "p_"+subgrid_table_id;
		
		$("#"+subgrid_id).html("<div class='subgridform'><table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div></div>");
		
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
			pager: pager_id,
		    height: '100%'
		});
		}
        }).navGrid('#pager',{view:false, del:false, add:false, edit:false, search:false}, 
			{}, //  default settings for edit
			{}, //  default settings for add
			{},  // delete instead that del:false we need this
			{}, // search options
			{} 
		); 
		$("#list").jqGrid('filterToolbar',{searchOperators:true,stringResult:true,searchOnEnter:false});
		
$.ajax({
  type: "POST",
  url: "scripts/unit1/stickyquery.php",
  dataType: "html",
  success: function(data){
     $.sticky(data);
  }
});

});  
