$(document).ready(function(){


$(".unit5").each(function(){

    $(this).addClass("selected");

});
$("#list").jqGrid({
            url:'scripts/unit5/getdataunit3.php',
            datatype: 'json',
            mtype: 'POST',
            colNames:['#', 'Название книги','Год издания', 'Всего','УДК', 'Кафедра', 'Остаток'],
            colModel :[
                {name:'id_book', index:'id_book', width:40, align:'right',editable:false, search:false,editable:true}
                ,{name:'name_book', index:'name_book', width:350, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'year_create', index:'year_create', width:60, align:'center',editable:true,edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'kolvo_vsego', index:'kolvo_vsego', width:65, align:'center',editable:true, edittype:"text",editable:false,sorttype:'integer', searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'UDK', index:'UDK', width:55, align:'left', edittype:"text", search:false,editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},				
				{name:'name_kratko', index:'name_kratko', width:70, align:'left', edittype:"text",editable:true, search:false,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
				{name:'ostatok', index:'ostatok', width:50, align:'center',editable:true, edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}}
                
                ],
            pager: '#pager',
			autowidth:true,
            height:300,
			rowNum:15,
            rowList:[15,30,45],
            sortname: 'id_book',
            sortorder: "asc",
            caption: 'Данные о книгах требующие замены',
			subGrid: true,
			viewrecords: true,
			grouping:true,
   	      groupingView : {
   		groupField : ['year_create'],
   		groupColumnShow : [false]
   	},
			subGridRowExpanded: function(subgrid_id, row_id) {
		// subgrid
		var subgrid_table_id, pager_id;
		subgrid_table_id = subgrid_id+"_t";
		pager_id = "p_"+subgrid_table_id;
		
		$("#"+subgrid_id).html("<div class='subgridform'><table id='"+subgrid_table_id+"' class='scroll'></table></div>");
		
		jQuery("#"+subgrid_table_id).jqGrid({
			url:"scripts/unit5/subgridunit3.php?id="+row_id,
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
		},ondblClickRow: function(id) {
                
                    $("#list").restoreRow(lastSel);
                    $("#list").editRow(id, true);
                    lastSel = id;
               
            }, 
			onSelectRow: function(id) {
               jQuery("#list").restoreRow(lastSel);
}, 
            editurl: 'scripts/unit5/saverowunit2.php'
        }).navGrid('#pager',{view:false, del:false, add:true, edit:true, search:false}, 
			{}, 
			{width:400,height:280,reloadAfterSubmit:true},  
			{width:400,height:580,reloadAfterSubmit:true}, 
			{} 
		); 
		$("#list").jqGrid('filterToolbar',{searchOperators:true,stringResult:true,searchOnEnter:false});


$("#list1").jqGrid({
            url:'scripts/unit5/getdataunit31.php',
            datatype: 'json',
            mtype: 'POST',
            colNames:['#', 'Название книги','Год издания', 'Всего', 'Остаток', 'Просрочено на руках'],
             colModel :[
                {name:'id_book', index:'id_book', width:40, align:'right', search:false}
                ,{name:'name_book', index:'name_book', width:350, align:'left', edittype:"text",editable:false,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
                                {name:'year_create', index:'year_create', width:60, align:'center', editable:false,edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
                                {name:'kolvo_vsego', index:'kolvo_vsego', width:65, align:'center', editable:false,editable:true, edittype:"text",sorttype:'integer', searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
                                {name:'ostatok', index:'ostatok', width:50, align:'center',editable:true, editable:false,edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}},
                                {name:'na_rukah', index:'na_rukah', width:50, align:'center',editable:false, edittype:"text", searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch: true}}
                
                ],
            pager: '#pager1',
            autowidth:true,
            height:300,
            rowNum:15,
            rowList:[15,30,45],
            sortname: 'id_book',
            sortorder: "asc",
            viewrecords: true,
            caption: 'Данные о тираже книг',
                subGridRowExpanded: function(subgrid_id, row_id) {
                // subgrid
                var subgrid_table_id, pager_id;
                subgrid_table_id = subgrid_id+"_tt";
                pager_id = "pp_"+subgrid_table_id;
                
                $("#"+subgrid_id).html("<div class='subgridform'><table id='"+subgrid_table_id+"' class='scroll'></table></div>");
                
                jQuery("#"+subgrid_table_id).jqGrid({
                        url:"scripts/unit5/subgridunit31.php?id="+row_id,
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
                },ondblClickRow: function(id) {
                
                    $("#list1").restoreRow(lastSel);
                    $("#list1").editRow(id, true);
                    lastSel = id;
               
            }, 
                        onSelectRow: function(id) {
               jQuery("#list1").restoreRow(lastSel);
}, 
            editurl: 'scripts/unit3/saverowunit3.php'
        }).navGrid('#pager1',{view:false, del:false, add:false, edit:false, search:false}, 
                        {}, 
                        {},  
                        {}, 
                        {} 
                ); 
                $("#list1").jqGrid('filterToolbar',{searchOperators:true,stringResult:true,searchOnEnter:false});

 });  
