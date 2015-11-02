<script type="text/javascript">

$(document).on('pagebeforecreate', '[data-role="page"]', function(){     
    setTimeout(function(){
		$.mobile.loading('show', {
			text: "Loading...",
			textVisible: true,
			theme: "b",
		});
    },1);    
});

function showTab(element)  {
    var tabContents = document.getElementsByClassName('tabContent');
	var tabBtns = document.getElementsByClassName('tabBtn');
    for (var i = 0; i < tabContents.length; i++) { 
        tabContents[i].style.display = 'none';
		tabBtns[i].classList.remove("ui-btn-active");
    }
    
    var tabContentIdToShow = element.id.replace(/(\d)/g, '-$1');//select only text in button id and add - and i number to construct tab content id
	var tabBtnIdToHighlight = element.id.replace(/(\d)/g, '$1');//select only text in button id and add i to construct button id
    document.getElementById(tabContentIdToShow).style.display = 'block';
	document.getElementById(tabBtnIdToHighlight).classList.add("ui-btn-active");
}

$(document).on('pageinit', function() {

	setTimeout(function(){
	
	//Hiding centreon's classic interface elements	-->
		$("#header").hide();
		$("#forMenuAjax").hide();
		$(".imgPathWay").hide();
		$(".pathWay").hide();
		$("hr").hide();
		$("#footer").hide();
		$("#footerline1").hide();
		$("#footerline2").hide();
		$("img[src='./img/icones/7x7/sort_asc.gif']").hide();
		$(".ajaxOption").hide();
		$(".ToolbarTable").hide();
		$("#forAjax").hide();
		$(".ListTable").hide();
		$("#trStatus").hide();
		$("#div_popup").hide();
		$("table.ListTable").hide();
		$("td#Tmenu").hide();
		$("#Tmainpage div table:eq(1)").hide();

	//get elements
		var pathImg1 = $('table#Tcontener tr:eq(0) td#Tmainpage img.imgPathWay:eq(0)').attr('src');
		var pathItem1 = $('table#Tcontener tr:eq(0) td#Tmainpage a:eq(1)').text();
		
		var hostTitle = $('table#Tcontener tr:eq(0) td#Tmainpage div:eq(0) table.ListTable tbody tr.ListHeader td.ListColHeaderLeft').html();
	
	//Table details (ListTable:eq(1)) - Tab1
		var table1Tr0Td0 = $('.ListTable:eq(1) tr:eq(0) td:eq(0)').html();
		var table1Tr0Td1 = $('.ListTable:eq(1) tr:eq(0) td:eq(1)').text();
		var table1Tr1Td1 = $('.ListTable:eq(1) tr:eq(1) td:eq(0)').text();
		var table1Tr1Td2 = $('.ListTable:eq(1) tr:eq(1) td:eq(1)').text();
			var table1Tr1Td2Color = $('.ListTable:eq(1) tr:eq(1) td:eq(1)').attr('style');
			if (table1Tr1Td2Color == 'background:#19EE11') {var table1Tr1Td2Style = 'background:#C3EFB3';} //green
			else if (table1Tr1Td2Color == 'background:#F91E05') {var table1Tr1Td2Style = 'background:#F2DEDF';} //red
			else if (table1Tr1Td2Color == 'background:#F8C706') {var table1Tr1Td2Style = 'background:#FFE187';} //orange
			else if (table1Tr1Td2Color == 'background:#82CFD8') {var table1Tr1Td2Style = 'background:#B6EDF6';} //lightBlue
			else if (table1Tr1Td2Color == 'background:#2AD1D4') {var table1Tr1Td2Style = 'background:#A3C9D8';} //blue
			else if (table1Tr1Td2Color == 'background:#DCDADA') {var table1Tr1Td2Style = 'background:#CBCBD8';} //grey
		var table1Tr2Td1 = $('.ListTable:eq(1) tr:eq(2) td:eq(0)').text();
		var table1Tr2Td2 = $('.ListTable:eq(1) tr:eq(2) td:eq(1)').text();
		var table1Tr4Td1 = $('.ListTable:eq(1) tr:eq(4) td:eq(0)').text();
		var table1Tr4Td2 = $('.ListTable:eq(1) tr:eq(4) td:eq(1)').text();
		var table1Tr5Td1 = $('.ListTable:eq(1) tr:eq(5) td:eq(0)').text();
		var table1Tr5Td2 = $('.ListTable:eq(1) tr:eq(5) td:eq(1)').text();
		var table1Tr6Td1 = $('.ListTable:eq(1) tr:eq(6) td:eq(0)').text();
		var table1Tr6Td2 = $('.ListTable:eq(1) tr:eq(6) td:eq(1)').text();
		var table1Tr7Td1 = $('.ListTable:eq(1) tr:eq(7) td:eq(0)').text();
		var table1Tr7Td2 = $('.ListTable:eq(1) tr:eq(7) td:eq(1)').text();
		var table1Tr8Td1 = $('.ListTable:eq(1) tr:eq(8) td:eq(0)').text();
		var table1Tr8Td2 = $('.ListTable:eq(1) tr:eq(8) td:eq(1)').text();
		var table1Tr9Td1 = $('.ListTable:eq(1) tr:eq(9) td:eq(0)').text();
		var table1Tr9Td2 = $('.ListTable:eq(1) tr:eq(9) td:eq(1)').text();
		var table1Tr10Td1 = $('.ListTable:eq(1) tr:eq(10) td:eq(0)').text();
		var table1Tr10Td2 = $('.ListTable:eq(1) tr:eq(10) td:eq(1)').text();
		var table1Tr11Td1 = $('.ListTable:eq(1) tr:eq(11) td:eq(0)').text();
		var table1Tr11Td2 = $('.ListTable:eq(1) tr:eq(11) td:eq(1)').text();
		var table1Tr12Td1 = $('.ListTable:eq(1) tr:eq(12) td:eq(0)').text();
		var table1Tr12Td2 = $('.ListTable:eq(1) tr:eq(12) td:eq(1)').text();
		var table1Tr13Td1 = $('.ListTable:eq(1) tr:eq(13) td:eq(0)').text();
		var table1Tr13Td2 = $('.ListTable:eq(1) tr:eq(13) td:eq(1)').text();
		var table1Tr14Td1 = $('.ListTable:eq(1) tr:eq(14) td:eq(0)').text();
		var table1Tr14Td2 = $('.ListTable:eq(1) tr:eq(14) td:eq(1)').text();
		var table1Tr15Td1 = $('.ListTable:eq(1) tr:eq(15) td:eq(0)').text();
		var table1Tr15Td2 = $('.ListTable:eq(1) tr:eq(15) td:eq(1)').text();
		var table1Tr16Td1 = $('.ListTable:eq(1) tr:eq(16) td:eq(0)').text();
		var table1Tr16Td2 = $('.ListTable:eq(1) tr:eq(16) td:eq(1)').text();
		var table1Tr17Td1 = $('.ListTable:eq(1) tr:eq(17) td:eq(0)').text();
		var table1Tr17Td2 = $('.ListTable:eq(1) tr:eq(17) td:eq(1)').text();
			var table1Tr17Td2Color = $('.ListTable:eq(1) tr:eq(17) td:eq(1)').attr('style');
			if (table1Tr17Td2Color = 'background:#00FF00') {var table1Tr17Td2Style = 'background:#C3EFB3';} //green
			else if (table1Tr17Td2Color = 'background:#F91E05') {var table1Tr17Td2Style = 'background:#F2DEDF';} //red
			else if (table1Tr17Td2Color = 'background:#F8C706') {var table1Tr17Td2Style = 'background:#FFE187';} //orange
			else if (table1Tr17Td2Color = 'background:#82CFD8') {var table1Tr17Td2Style = 'background:#B6EDF6';} //lightBlue
			else if (table1Tr17Td2Color = 'background:#2AD1D4') {var table1Tr17Td2Style = 'background:#A3C9D8';} //blue
			else if (table1Tr17Td2Color = 'background:#DCDADA') {var table1Tr17Td2Style = 'background:#CBCBD8';} //grey
		var table1Tr18Td1 = $('.ListTable:eq(1) tr:eq(18) td:eq(0)').text();
		var table1Tr18Td2 = $('.ListTable:eq(1) tr:eq(18) td:eq(1)').text();
		var table1Tr19Td1 = $('.ListTable:eq(1) tr:eq(19) td:eq(0)').text();
		var table1Tr19Td2 = $('.ListTable:eq(1) tr:eq(19) td:eq(1)').text();
		
	//Table options (ListTable:eq(2))- Tab2
		var table2Tr0Td0 = $('.ListTable:eq(2) tr:eq(0) td:eq(0)').html();
		var table2Tr1Td1 = $('.ListTable:eq(2) tr:eq(1) td:eq(0)').html();
		var table2Tr1Td2 = $('.ListTable:eq(2) tr:eq(1) td:eq(1) font').text();
			var table2Tr1Td2Color = $('.ListTable:eq(2) tr:eq(1) td:eq(1) font').css('background-color');
			if (table2Tr1Td2Color == 'rgb(0, 255, 0)') {var table2Tr1Td2Style = 'background:#C3EFB3;';} //green
			else if (table2Tr1Td2Color == 'rgb(255, 0, 0)') {var table2Tr1Td2Style = 'background:#F2DEDF;';} //red
			$('.ListTable:eq(2) tr:eq(1) td:eq(2) img').removeAttr('alt onmouseover onmouseout');
		var table2Tr1Td3 = $('.ListTable:eq(2) tr:eq(1) td:eq(2)').html();
		var table2Tr2Td1 = $('.ListTable:eq(2) tr:eq(2) td:eq(0)').html();
		var table2Tr2Td2 = $('.ListTable:eq(2) tr:eq(2) td:eq(1) font').text();
			var table2Tr2Td2Color = $('.ListTable:eq(2) tr:eq(2) td:eq(1) font').css('background-color');
			if (table2Tr2Td2Color == 'rgb(0, 255, 0)') {var table2Tr2Td2Style = 'background:#C3EFB3';} //green
			else if (table2Tr2Td2Color == 'rgb(255, 0, 0)') {var table2Tr2Td2Style = 'background:#F2DEDF';} //red
			$('.ListTable:eq(2) tr:eq(2) td:eq(2) img').removeAttr('alt onmouseover onmouseout');
		var table2Tr2Td3 = $('.ListTable:eq(2) tr:eq(2) td:eq(2)').html();
		var table2Tr3Td1 = $('.ListTable:eq(2) tr:eq(3) td:eq(0)').html();
		var table2Tr3Td2 = $('.ListTable:eq(2) tr:eq(3) td:eq(1) font').text();
			var table2Tr3Td2Color = $('.ListTable:eq(2) tr:eq(3) td:eq(1) font').css('background-color');
			if (table2Tr3Td2Color == 'rgb(0, 255, 0)') {var table2Tr3Td2Style = 'background:#C3EFB3';} //green
			else if (table2Tr3Td2Color == 'rgb(255, 0, 0)') {var table2Tr3Td2Style = 'background:#F2DEDF';} //red
			$('.ListTable:eq(2) tr:eq(3) td:eq(2) img').removeAttr('alt onmouseover onmouseout');
		var table2Tr3Td3 = $('.ListTable:eq(2) tr:eq(3) td:eq(2)').html();
		var table2Tr4Td1 = $('.ListTable:eq(2) tr:eq(4) td:eq(0)').html();
		var table2Tr4Td2 = $('.ListTable:eq(2) tr:eq(4) td:eq(1) font').text();
			var table2Tr4Td2Color = $('.ListTable:eq(2) tr:eq(4) td:eq(1) font').css('background-color');
			if (table2Tr4Td2Color == 'rgb(0, 255, 0)') {var table2Tr4Td2Style = 'background:#C3EFB3';} //green
			else if (table2Tr4Td2Color =='rgb(255, 0, 0)') {var table2Tr4Td2Style = 'background:#F2DEDF';} //red
			$('.ListTable:eq(2) tr:eq(4) td:eq(2) img').removeAttr('alt onmouseover onmouseout');
		var table2Tr4Td3 = $('.ListTable:eq(2) tr:eq(4) td:eq(2)').html();
		var table2Tr5Td1 = $('.ListTable:eq(2) tr:eq(5) td:eq(0)').html();
		var table2Tr5Td2 = $('.ListTable:eq(2) tr:eq(5) td:eq(1) font').text();
			var table2Tr5Td2Color = $('.ListTable:eq(2) tr:eq(5) td:eq(1) font').css('background-color');
			if (table2Tr5Td2Color =='rgb(0, 255, 0)') {var table2Tr5Td2Style = 'background:#C3EFB3';} //green
			else if (table2Tr5Td2Color == 'rgb(255, 0, 0)') {var table2Tr5Td2Style = 'background:#F2DEDF';} //red
			$('.ListTable:eq(2) tr:eq(5) td:eq(2) img').removeAttr('alt onmouseover onmouseout');
		var table2Tr5Td3 = $('.ListTable:eq(2) tr:eq(5) td:eq(2)').html();
		var table2Tr6Td1 = $('.ListTable:eq(2) tr:eq(6) td:eq(0)').html();
		/*var table2Tr6Td2 = $('.ListTable:eq(2) tr:eq(6) td:eq(1) font').text();
			var table2Tr6Td2Color = $('.ListTable:eq(2) tr:eq(6) td:eq(1) font').css('background-color');
			if (table2Tr6Td2Color =='rgb(0, 255, 0)') {var table2Tr6Td2Style = 'background:#C3EFB3';} //green
			else if (table2Tr6Td2Color == 'rgb(255, 0, 0)') {var table2Tr6Td2Style = 'background:#F2DEDF';} //red
			$('.ListTable:eq(2) tr:eq(6) td:eq(2) img').removeAttr('alt onmouseover onmouseout');
		var table2Tr6Td3 = $('.ListTable:eq(2) tr:eq(6) td:eq(2)').html();*/
	
	//Table commands (ListTable:eq(4)) - Tab3
		var table3Tr0Td1 = $('.ListTable:eq(4) tr:eq(0) td:eq(0)').html();
		var table3Tr1Td1 = $('.ListTable:eq(4) tr:eq(1) td:eq(0)').html();
		var table3Tr2Td1 = $('.ListTable:eq(4) tr:eq(2) td:eq(0)').text();
		var table3Tr3Td1 = $('.ListTable:eq(4) tr:eq(3) td:eq(0)').html();
		var table3Tr4Td1 = $('.ListTable:eq(4) tr:eq(4) td:eq(0)').html();
		var table3Tr5Td1 = $('.ListTable:eq(4) tr:eq(5) td:eq(0)').html();
		var table3Tr6Td1 = $('.ListTable:eq(4) tr:eq(6) td:eq(0)').html();
		var table3Tr7Td1 = $('.ListTable:eq(4) tr:eq(7) td:eq(0)').html();
		var table3Tr8Td1 = $('.ListTable:eq(4) tr:eq(8) td:eq(0)').html();
		var table3Tr9Td1 = $('.ListTable:eq(4) tr:eq(9) td:eq(0)').html();
		alert(table3Tr0Td1);
	//Table perf data (from ListTable:eq(1)) - Tab4
		var table4Tr0Td0 = $('.ListTable:eq(1) tr:eq(3) td:eq(0)').text();
		var table4Tr0Td1 = $('.ListTable:eq(1) tr:eq(3) td:eq(1)').text();	
	//Table tools - Tab4
		var table6Tr0Td0 = $('.ListTable:eq(5) tr:eq(0) td:eq(0)').html();
		var table6Tr1Td0 = $('.ListTable:eq(5) tr:eq(1) td:eq(0)').text();
		var table6Tr2Td0 = $('.ListTable:eq(5) tr:eq(2) td:eq(0)').text();
		
	//Table links - Tab4
		var table7Tr0Td0 = $('.ListTable:eq(6) tr:eq(0) td:eq(0)').html();
		var table7Tr1Td0 = $('.ListTable:eq(6) tr:eq(01) td:eq(0)').html();
	//Table notifications - Tab4
		var table8Tr0Td0 = $('.ListTable:eq(7) tr:eq(0) td:eq(0)').html();
		var table8Tr1Td0 = $('.ListTable:eq(7) tr:eq(1) td:eq(0)').html();
		var table8Tr2Td0 = $('.ListTable:eq(7) tr:eq(2) td:eq(0)').html();
		
	//Table comments (ListTable:eq(8&9)) - Tab5
		var table9Tr0Td0 = $('.ListTable:eq(8) tr:eq(0) td:eq(0)').html();
		var table9Tr1Td0 = $('.ListTable:eq(9) tr:eq(0) td:eq(0)').html();
		var table9Tr1Td1 = $('.ListTable:eq(9) tr:eq(0) td:eq(1)').html();
		var table9Tr1Td2 = $('.ListTable:eq(9) tr:eq(0) td:eq(2)').html();
		var table9Tr1Td3 = $('.ListTable:eq(9) tr:eq(0) td:eq(3)').html();
		var table9Tr1Td4 = $('.ListTable:eq(9) tr:eq(0) td:eq(4)').html();
	
		
	//append path elements-->
		$('#pathImg1').append($('<img src='+pathImg1+'>'));
		$('#pathItem1').append($('<a href="#">'+pathItem1+'</a>'));
		
	//append page elements
		$('#hostTitle').append(hostTitle);
		
	//Tab1	
		//Table details (table:eq(0) - Tab1
		$('#table1Tr0Td0').append(table1Tr0Td0);
		$('#table1Tr0Td1').append(table1Tr0Td1);
		$('#table1Tr1Td1').append(table1Tr1Td1);
		$('#table1Tr1Td2').append(table1Tr1Td2);
			$('#table1Tr1Td2').attr('style', table1Tr1Td2Style);
		$('#table1Tr2Td1').append(table1Tr2Td1);
		$('#table1Tr2Td2').append(table1Tr2Td2);
		$('#table1Tr4Td1').append(table1Tr4Td1);
		$('#table1Tr4Td2').append(table1Tr4Td2);
		$('#table1Tr5Td1').append(table1Tr5Td1);
		$('#table1Tr5Td2').append(table1Tr5Td2);
		$('#table1Tr6Td1').append(table1Tr6Td1);
		$('#table1Tr6Td2').append(table1Tr6Td2);
		$('#table1Tr7Td1').append(table1Tr7Td1);
		$('#table1Tr7Td2').append(table1Tr7Td2);
		$('#table1Tr8Td1').append(table1Tr8Td1);
		$('#table1Tr8Td2').append(table1Tr8Td2);
		$('#table1Tr9Td1').append(table1Tr9Td1);
		$('#table1Tr9Td2').append(table1Tr9Td2);
		$('#table1Tr10Td1').append(table1Tr10Td1);
		$('#table1Tr10Td2').append(table1Tr10Td2);
		$('#table1Tr11Td1').append(table1Tr11Td1);
		$('#table1Tr11Td2').append(table1Tr11Td2);
		$('#table1Tr12Td1').append(table1Tr12Td1);
		$('#table1Tr12Td2').append(table1Tr12Td2);
		$('#table1Tr13Td1').append(table1Tr13Td1);
		$('#table1Tr13Td2').append(table1Tr13Td2);
		$('#table1Tr14Td1').append(table1Tr14Td1);
		$('#table1Tr14Td2').append(table1Tr14Td2);
		$('#table1Tr15Td1').append(table1Tr15Td1);
		$('#table1Tr15Td2').append(table1Tr15Td2);
		$('#table1Tr16Td1').append(table1Tr16Td1);
		$('#table1Tr16Td2').append(table1Tr16Td2);
		$('#table1Tr17Td1').append(table1Tr17Td1);
		$('#table1Tr17Td2').append(table1Tr17Td2);
			$('#table1Tr17Td2').attr('style', table1Tr17Td2Style);
		$('#table1Tr18Td1').append(table1Tr18Td1);
		$('#table1Tr18Td2').append(table1Tr18Td2);
		$('#table1Tr19Td1').append(table1Tr19Td1);
		$('#table1Tr19Td2').append(table1Tr19Td2);
		
	//Tab2
		//Table options - Tab2
		$('#table2Tr0Td0').append(table2Tr0Td0);
		$('#table2Tr1Td1').append(table2Tr1Td1);
		$('#table2Tr1Td2').append(table2Tr1Td2);
			$('#table2Tr1Td2').attr('style', table2Tr1Td2Style);
		$('#table2Tr1Td3').append(table2Tr1Td3);
		$('#table2Tr2Td1').append(table2Tr2Td1);
		$('#table2Tr2Td2').append(table2Tr2Td2);
			$('#table2Tr2Td2').attr('style', table2Tr2Td2Style);
		$('#table2Tr2Td3').append(table2Tr2Td3);
		$('#table2Tr3Td1').append(table2Tr3Td1);
		$('#table2Tr3Td2').append(table2Tr3Td2);
			$('#table2Tr3Td2').attr('style', table2Tr3Td2Style);
		$('#table2Tr3Td3').append(table2Tr3Td3);
		$('#table2Tr4Td1').append(table2Tr4Td1);
		$('#table2Tr4Td2').append(table2Tr4Td2);
			$('#table2Tr4Td2').attr('style', table2Tr4Td2Style);
		$('#table2Tr4Td3').append(table2Tr4Td3);
		$('#table2Tr5Td1').append(table2Tr5Td1);
		$('#table2Tr5Td2').append(table2Tr5Td2);
			$('#table2Tr5Td2').attr('style', table2Tr5Td2Style);
		$('#table2Tr5Td3').append(table2Tr5Td3);
		$('#table2Tr6Td1').append(table2Tr6Td1);
		/*$('#table2Tr6Td2').append(table2Tr6Td2);
			$('#table2Tr6Td2').attr('style', table2Tr6Td2Style);
		$('#table2Tr6Td3').append(table2Tr6Td3);*/
		
	//Tab3	
		//Table commands - Tab3
		$('#table3Tr0Td1').append(table3Tr0Td1);//titre
		$('#table3Tr1Td1').append(table3Tr1Td1);//temps d'arret
		$('#linkComment').append(table3Tr2Td1);//commentaires
		$('#table3Tr3Td1').append(table3Tr3Td1);
		$('#table3Tr4Td1').append(table3Tr4Td1);
		$('#table3Tr5Td1').append(table3Tr5Td1);
		$('#table3Tr6Td1').append(table3Tr6Td1);
		$('#table3Tr7Td1').append(table3Tr7Td1);
		$('#table3Tr8Td1').append(table3Tr8Td1);
		$('#table3Tr9Td1').append(table3Tr9Td1);
		
	//Tab4
		//Table perf data - Tab4
		$('#table4Tr0Td0').append(table4Tr0Td0);
		$('#table4Tr0Td1').append(table4Tr0Td1);
		//Table tools - Tab4
		$('#table6Tr0Td0').append(table6Tr0Td0);
		$('#linkPing').append(table6Tr1Td0);
		$('#linkTracert').append(table6Tr2Td0);
		//Table links - Tab4
		$('#table7Tr0Td0').append(table7Tr0Td0);
		$('#table7Tr1Td0').append(table7Tr1Td0);
		//Table notifications - Tab4
		$('#table8Tr0Td0').append(table8Tr0Td0);
		$('#table8Tr1Td0').append(table8Tr1Td0);
		$('#table8Tr2Td0').append(table8Tr2Td0);
		
	//Tab5
		//Table comments - Tab5
		$('#table9Tr0Td0').append(table9Tr0Td0);
		$('#table9Tr1Td0').append(table9Tr1Td0);
		$('#table9Tr1Td1').append(table9Tr1Td1);
		$('#table9Tr1Td2').append(table9Tr1Td2);
		$('#table9Tr1Td3').append(table9Tr1Td3);
		$('#table9Tr1Td4').append(table9Tr1Td4);
			for (var i=1; i < $('.ListTable:eq(9) tr').length; i++){
			var table9TrCommentsTd0 = $('.ListTable:eq(9) tr:eq(' +i+ ')').find('td:eq(0)').html();
			var table9TrCommentsTd1 = $('.ListTable:eq(9) tr:eq(' +i+ ')').find('td:eq(1)').html();
			var table9TrCommentsTd2 = $('.ListTable:eq(9) tr:eq(' +i+ ')').find('td:eq(2)').html();
			var table9TrCommentsTd3 = $('.ListTable:eq(9) tr:eq(' +i+ ')').find('td:eq(3)').html();
			var table9TrCommentsTd4 = $('.ListTable:eq(9) tr:eq(' +i+ ')').find('td:eq(4)').html();
			$('#table9HostDetails').append('<tr>'+
										'<td id="table9TrCommentsTd0" class="tdDetails">'+table9TrCommentsTd0+'</td>'+
										'<td id="table9TrCommentsTd1" class="tdDetails">'+table9TrCommentsTd1+'</td>'+
										'<td id="table9TrCommentsTd2" class="tdDetails">'+table9TrCommentsTd2+'</td>'+
										'<td id="table9TrCommentsTd3" class="tdDetails">'+table9TrCommentsTd3+'</td>'+
										'<td id="table9TrCommentsTd4" class="tdDetails">'+table9TrCommentsTd4+'</td></tr>');
			};
			
	//End of tabs
	
				}, <?php echo 500*$tempoScripts+2000;?>); //tempo d'exécution des scripts
	$( "#popupPing" ).on({
        popupbeforeposition: function( event, ui ) {  
            console.log( event.target );
        }
    });
	});

	
$(document).on('pageshow', '[data-role="page"]', function(){ 
    setTimeout(function(){
        $.mobile.loading('hide');
    },<?php echo 500*$tempoScripts+2000+50;?>);      
});

</script>