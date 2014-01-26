$(document).ready(function(){


$(".unit5").each(function(){

    $(this).addClass("selected");

});
$("a[href='help.php']").each(function(){
      $(this).attr('href', $(this).attr('href')+'#unit5');
   });
$("#list").jqGrid({
            url:'scripts/unit5/getdataunit5.php',
            datatype: 'json',
            mtype: 'POST',
            colNames:['#','Фамилия','Имя','Отчество','','Группа','','Отчислен из группы','Год поступления','Номер зачетки','Дом. телефон','Сот. телефон','Эл. почта','Место работы','Цех, отдел','Должность','Рабочий телефон','Дата'],
            colModel :[
                {name:'id_man', index:'id_man', width:40, align:'right',editable:false, search:false,editable:false}
                ,{name:'fam', index:'fam', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'name', index:'name', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'otchestvo', index:'otchestvo', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name: "id_group",index: "id_group",editable: true,edittype: "text",hidden:true},
				{name:'name_group', index:'name_group', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}, editoptions:{
      size: 10,
      dataInit: function (e) {
        $(e).autocomplete({
          source: "scripts/unit5/autocomplete.php?q=1",
          minLength: 1,
          focus: function (event, ui) {
            $(e).val(ui.item.label);
			return false;
          },
          select: function (event, ui) {
            $(e).val(ui.item.label);
            $("input#id_group").val(ui.item.value);
			return false;
          }
        });}}},{name: "otchislen_iz_group",index: "otchislen_iz_group",editable: true,edittype: "text",hidden:true},
				{name:'otgroup', index:'otgroup', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}, editoptions:{
      size: 10,
      dataInit: function (e) {
        $(e).autocomplete({
          source: "scripts/unit5/autocomplete.php?q=1",
          minLength: 1,
          focus: function (event, ui) {
            $(e).val(ui.item.label);
			return false;
          },
          select: function (event, ui) {
            $(e).val(ui.item.label);
            $("input#otchislen_iz_group").val(ui.item.value);
			return false;
          }
        });}}},
				{name:'god_postup', index:'god_postup', width:150, align:'left',edittype:"select",formatter:"select",editoptions:{value:":-;2000:2000;2001:2001;2002:2002;2003:2003;2004:2004;2005:2005;2006:2006;2007:2007;2008:2008;2009:2009;2010:2010;2011:2011;2012:2012;2013:2013;2014:2014;2015:2015;2016:2016;2017:2017;2018:2018;2019:2019;2020:2020"},editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},				
				{name:'number_zach', index:'number_zach', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true},editoptions:{size: 10}},
				{name:'telefon_dom', index:'telefon_dom', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'telefon_sot', index:'telefon_sot', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'e_mail', index:'e_mail', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'mesto_raboti', index:'mesto_raboti', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'ceh_otdel', index:'ceh_otdel', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'doljnost', index:'doljnost', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'telefon_rabochii', index:'telefon_rabochii', width:150, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'data_change', index:'data_change', width:100, align:'left',editable:false,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true},search:false}      
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
        }).navGrid('#pager',{view:false, del:false, add:true, edit:true, search:false},{width:470,height:570,zIndex:99,reloadAfterSubmit:true},{width:470,height:570,zIndex:99,reloadAfterSubmit:true},  
			{width:470,height:570,reloadAfterSubmit:true}, 
			{},{} 
		).navSeparatorAdd("#pager",{sepclass:"ui-separator",sepcontent: ''}).navButtonAdd("#pager",{caption:"",buttonicon:"ui-icon-document", onClickButton:
	                         function () { 
          $("#list").jqGrid('excelExport',{"url":"scripts/unit5/excelexport.php"});
       } , position: "last", title:"Экспорт в Excel", cursor: "pointer"});  
		$("#list").jqGrid('filterToolbar',{searchOperators:true,stringResult:true,searchOnEnter:false});


$("#list1").jqGrid({
            url:'scripts/unit5/getdataunit51.php',
            datatype: 'json',
            mtype: 'POST',
            colNames:['#','Год поступления', 'Название группы', 'Форма', 'Кол-во студентов','Кафедра','Выпуск','','Специальность','Год окончания'],
             colModel :[
                {name:'id_group', index:'id_group', width:20, align:'right', search:false,editable:false}
                ,{name:'year_postup', index:'nyear_postup', width:100, align:'left', edittype:"select",editable:true,formatter:"select",editoptions:{value:":-;2000:2000;2001:2001;2002:2002;2003:2003;2004:2004;2005:2005;2006:2006;2007:2007;2008:2008;2009:2009;2010:2010;2011:2011;2012:2012;2013:2013;2014:2014;2015:2015;2016:2016;2017:2017;2018:2018;2019:2019;2020:2020"},searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'name_group', index:'name_group', width:100, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'form', index:'form', width:70, align:'left',edittype:"select",formatter:"select",search:true,editoptions:{value:":Выберите;дневная:дневная;ускоренная:ускоренная;вечерняя:вечерняя"},editable:true,stype:"select", searchrules:{value:":Все;дневная:дневная;ускоренная:ускоренная;вечерняя:вечерняя"},clearSearch:true},
				{name:'kolvo_studentov', index:'kolvo_studentov', width:60, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}},
				{name:'kod_kafedri', index:'kod_kafedri', width:60, align:'left', edittype:"select",formatter:"select",search:true,editoptions:{value:":Выберите;1:АТП;2:ХТиЭ;4:ОНД;5:Экономики;7:ТМП;8:ТКМ"},editable:false,stype:"select", searchrules:{value:":Все;1:АТП;2:ХТиЭ;4:ОНД;5:Экономики;7:ТМП;8:ТКМ"},clearSearch:true},
				{name:'vipusk', index:'vipusk', width:60, align:'center',editable:true,edittype:"checkbox",formatter:"checkbox",editoptions: {value:"1:0"},search:true,stype:'select', searchoptions:{value:":Все;1:Да;0:Нет"}},
				{name:'id_spec', index:'id_spec', width:350, align:'left',editable: true,edittype: "text",hidden:true},
				{name:'name_spec', index:'name_spec', width:200, align:'left', edittype:"text",editable:true,searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}, editoptions:{
      size: 25,
      dataInit: function (e) {
		  $(e).autocomplete({
	      source: "scripts/unit5/autocomplete.php?q=2",
          minLength: 1,
          focus: function (event, ui) {
            $(e).val(ui.item.label);
			return false;
          },
          select: function (event, ui) {
            $(e).val(ui.item.label);
            $("input#id_spec").val(ui.item.value);
			return false;
          }
        });}}},
				{name:'year_okonchan', index:'year_okonchan', width:55, align:'left',edittype:"select",editable:true,formatter:"select",editoptions:{value:":-;2000:2000;2001:2001;2002:2002;2003:2003;2004:2004;2005:2005;2006:2006;2007:2007;2008:2008;2009:2009;2010:2010;2011:2011;2012:2012;2013:2013;2014:2014;2015:2015;2016:2016;2017:2017;2018:2018;2019:2019;2020:2020;2021:2021;2022:2022;2023:2023;2024:2024;2025:2025;2026:2026"},searchoptions:{sopt:['bw','eq','ne','cn'],clearSearch:true}}               
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
		).navSeparatorAdd("#pager1",{sepclass:"ui-separator",sepcontent: ''}).navButtonAdd("#pager1",{caption:"",buttonicon:"ui-icon-document", onClickButton:
	                         function () { 
          $("#list1").jqGrid('excelExport',{"url":"scripts/unit5/excelexport1.php"});
       } , position: "last", title:"Экспорт в Excel", cursor: "pointer"}); 
                $("#list1").jqGrid('filterToolbar',{searchOperators:true,stringResult:true,searchOnEnter:false});

 });  
