$(document).ready(function(){


$(".unit5").each(function(){

    $(this).addClass("selected");

});
$("#list").jqGrid({
            url:'scripts/unit5/getdataunit5.php',
            datatype: 'json',
            mtype: 'POST',
            colNames:['#','Фамилия','Имя','Отчество','Группа','Год поступления','Номер зачетки','Дом. телефон','Сот. телефон','Эл. почта','Место работы','Цех, отдел','Должность','Рабочий телефон'],
            colModel :[
                {name:'id_man', index:'id_man', width:40, align:'right',editable:false, search:false,editable:false}
                ,{name:'fam', index:'fam', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'name', index:'name', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'otchestvo', index:'otchestvo', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'name_group', index:'name_group', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'god_postup', index:'god_postup', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},				
				{name:'number_zach', index:'number_zach', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'telefon_dom', index:'telefon_dom', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'telefon_sot', index:'telefon_sot', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'e_mail', index:'e_mail', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'mesto_raboti', index:'mesto_raboti', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'ceh_otdel', index:'ceh_otdel', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'doljnost', index:'doljnost', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'telefon_rabochii', index:'telefon_rabochii', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}}      
                ],
            pager: '#pager',
			autowidth:true,
            height:300,
			rowNum:15,
            rowList:[15,30,45,90],
            sortname: 'id_man',
            sortorder: "asc",
            caption: 'Данные о студентах',
			viewrecords: true,
			editurl: 'scripts/unit5/saverowunit5.php'
        }).navGrid('#pager',{view:false, del:false, add:true, edit:true, search:false},{width:470,height:550,zIndex:99,reloadAfterSubmit:true},{width:470,height:550,zIndex:99,reloadAfterSubmit:true},  
			{width:470,height:550,reloadAfterSubmit:true}, 
			{},{} 
		); 
		$("#list").jqGrid('filterToolbar',{searchOperators:true,stringResult:true,searchOnEnter:false});


$("#list1").jqGrid({
            url:'scripts/unit5/getdataunit51.php',
            datatype: 'json',
            mtype: 'POST',
            colNames:['#','Год поступления', 'Название группы', 'Форма', 'Кол-во студентов','Кафедра','Специальность','Год окончания'],
             colModel :[
                {name:'id_group', index:'id_group', width:40, align:'right', search:false,editable:false}
                ,{name:'year_postup', index:'nyear_postup', width:100, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'name_group', index:'name_group', width:100, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'form', index:'form', width:100, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'kolvo_studentov', index:'kolvo_studentov', width:100, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'name_kratko', index:'name_kratko', width:100, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'name_spec', index:'name_spec', width:350, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'year_okonchan', index:'year_okonchan', width:100, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}}               
                ],
            pager: '#pager1',
            autowidth:true,
            height:300,
            rowNum:15,
            rowList:[15,30,45,90],
            sortname: 'id_group',
            sortorder: "asc",
            viewrecords: true,
            caption: 'Данные о группах',
            editurl: 'scripts/unit5/saverowunit51.php'
        }).navGrid('#pager1',{view:false, del:false, add:true, edit:true, search:false},{width:470,height:350,zIndex:99,reloadAfterSubmit:true},{width:470,height:350,zIndex:99,reloadAfterSubmit:true},  
			{width:470,height:350,zIndex:99,reloadAfterSubmit:true}, 
			{},{} 
		); 
                $("#list1").jqGrid('filterToolbar',{searchOperators:true,stringResult:true,searchOnEnter:false});

 });  
