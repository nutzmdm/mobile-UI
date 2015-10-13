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
		
		
		var pathImg1 = $('table#Tcontener tr:eq(0) td#Tmainpage img.imgPathWay:eq(0)').attr('src');
		var pathItem1 = $('table#Tcontener tr:eq(0) td#Tmainpage a:eq(1)').text();
		var pathImg2 = $('table#Tcontener tr:eq(0) td#Tmainpage img.imgPathWay:eq(1)').attr('src');
		var pathItem2 = $('table#Tcontener tr:eq(0) td#Tmainpage a:eq(2)').text();
		var searchBarHostLabel = $('.ajaxOption tr:eq(0) td:eq(0)').text();
		var searchBarServiceLabel = $('.ajaxOption tr:eq(0) td:eq(2)').text();
		//var searchBarStatusLabel = $('.ajaxOption tr:eq(0) td:eq(4)').text();
		var searchBarServiceOutputLabel = $('.ajaxOption tr:eq(0) td:eq(6)').text();
		//var searchBarCollectorLabel = $('.ajaxOption tr:eq(0) td:eq(8)').text();
		//var searchBarHostgroupLabel = $('.ajaxOption tr:eq(0) td:eq(10)').text();
		var searchBarStatusFilterOptions = $('.ajaxOption #statusFilter').html();
		//var searchBarCollectorFilterOptions = $('.ajaxOption #select_instance').html();
		//var searchBarHostgroupFilterOptions = $('.ajaxOption #hostgroups').html();
		
		//append path elements-->
		$('#pathImg1').append($('<img src='+pathImg1+'>'));
		$('#pathItem1').append($('<a href="#">'+pathItem1+'</a>'));
		$('#pathImg2').append($('<img src='+pathImg2+'>'));
		$('#pathItem2').append($('<a href="#">'+pathItem2+'</a>'));
		
		//append search form-->
		$('#hostSearchInputLabel').append(searchBarHostLabel);
		$('#serviceSearchInputLabel').append(searchBarServiceLabel);
		//$('#statusSearchSelectLabel').append(searchBarStatusLabel);
		$('#serviceSearchOutputLabel').append(searchBarServiceOutputLabel);
		//$('#collectorSearchSelectLabel').append(searchBarCollectorLabel);
		//$('#hostgroupSearchSelectLabel').append(searchBarHostgroupLabel);
		$("#statusSearchSelect").append(searchBarStatusFilterOptions);
		//$("#collectorSearchSelect").append(searchBarCollectorFilterOptions);
		//$("#hostgroupSearchSelect").append(searchBarHostgroupFilterOptions);
		
		//append pagination elements-->
		var pagination = $('.ToolbarPagination').html();
		$("#pagination").append(pagination);
		
		//modify appended elements-->
		$('#pagination a img[src="./img/icones/16x16/arrow_left_blue_double.gif"]').parent().attr('href','main.php?p=<?php echo $p;?>&o=<?php echo $o;?>&limit=10&num=0');//first page link href
		$('#pagination a img[src="./img/icones/16x16/arrow_left_blue.gif"]').parent().attr('href','main.php?p=<?php echo $p;?>&o=<?php echo $o;?>&limit=10&num=<?php echo $num - 1;?>');//previous page link href
		var lastPageNbr = $("#pagination a.otherPageNumber").last().text();
		$("#pagination a.otherPageNumber").each(function(){
			var getPgenumber = $(this).text();
			var pgeNumberForSrc = getPgenumber -1 ;
			$(this).attr('href','main.php?p=100302&o=<?php echo $o;?>&limit=10&num='+pgeNumberForSrc+'')
			});
		$('#pagination a img[src="./img/icones/16x16/arrow_right_blue.gif"]').parent().attr('href','main.php?p=<?php echo $p;?>&o=<?php echo $o;?>&limit=10&num=<?php echo $num + 1;?>');//next page link href
		$('#pagination a img[src="./img/icones/16x16/arrow_right_blue_double.gif"]').parent().attr('href','main.php?p=<?php echo $p;?>&o=<?php echo $o;?>&limit=10&num=0'+lastPageNbr+'');//last page link href
		
		//Getting page elements	-->
		var i = 0;
		for (i=0; i < $('.ListTable #trStatus').length; i++){
			var tdSelectHostname = $('.ListTable #trStatus:eq(' +i+ ')').find('td:eq(2)').text();
			var tdSelectAllParamsFromLink = $('.ListTable #trStatus:eq(' +i+ ')').find('td:eq(4) a').attr('href').split('&');
			//var j = i - 1;
			//if ($('.ListTable #trStatus:eq(' +i+ ')').find('td:eq(1)').text() == $('.ListTable #trStatus:eq('+j+')').find('td:eq(1)').text())
			//	{var tdSelectHostnameToShow = '';}
			//	else {var tdSelectHostnameToShow = $('.ListTable #trStatus:eq('+i+')').find('td:eq(1)').text();}
			if ($('.ListTable #trStatus:eq(' +i+ ')').find('td:eq(2)').find('img').attr('src') == undefined)
				{var tdSelectHostImgSrc = './modules/mobile-UI/include/img/spacer.gif';}
				else {var tdSelectHostImgSrc = $('.ListTable #trStatus:eq(' +i+ ')').find('td:eq(2)').find('img').attr('src');}
			var tdSelectHostImgId = $('.ListTable #trStatus:eq(' +i+ ')').find('td:eq(3)').find('a').attr('id');
			var tdSelectHostStateImg = $('.ListTable #trStatus:eq(' +i+ ')').find('td:eq(3)').html();
			var tdSelectServicename = $('.ListTable #trStatus:eq(' +i+ ')').find('td:eq(4)').text();
			var tdSelectServiceStateImg = $('.ListTable #trStatus:eq(' +i+ ')').find('td:eq(5)').html();
			if ($('.ListTable #trStatus:eq(' +i+ ')').find('td:eq(6)').prev('td').find('img').attr('src') == undefined)
				{var isAnyGraph = 'n';}
				else  {var isAnyGraph = 'y';}
			//append elements of this loop-->
			$("#showService").append(
									'<li>'+
										'<a href="main.php?p=<?php echo $p ?>&o=svcd&'+tdSelectAllParamsFromLink[2]+'&'+tdSelectAllParamsFromLink[3]+'&g='+isAnyGraph+'">'+ //g var for graph presence  
										'<table class="tbl_100"><tr>'+
												'<td class="tdHostname_Service""><img src='+tdSelectHostImgSrc+' width="16" height="16" style="padding-right:5px;">'+tdSelectHostname+'</td>'+
												'<td class="tdHostStateImg_Service">'+tdSelectHostStateImg+'</td>'+
										'</tr>'+
										'<tr class="tbl_spacer"></tr>'+
										'<tr>'+
												'<td class="tdServicename">&#8627;'+tdSelectServicename+'</td>'+	
												'<td class="tdServiceStateImg">'+tdSelectServiceStateImg+'</td>'+
										'</tr></table></a>'+
									'</li>'
									);
								};

		}, <?php echo 500*$tempoScripts+3500+500;?>); //tempo d'exécution des scripts
	
	});

$(document).on('pageinit', function() {
	setTimeout(function(){
		if (	$('#showService').hasClass('ui-listview')) {
				$('#showService').listview('refresh');
		} 
		else {
				$('#showService').trigger('create');
		}
		
	}, <?php echo 500*$tempoScripts+3500+600;?>);

$(document).on('pageshow', '[data-role="page"]', function(){  
    setTimeout(function(){
        $.mobile.loading('hide');
    },<?php echo 500*$tempoScripts+3500+650;?>);      
});
$.mobile.loading( "hide" );
});

//traitement du formulaire de recherche
$(document).ready(function(){
	$("#formSearch").submit(function() {
		 datas = $(this).serialize(); 
		 $.ajax({
				type: 'POST', 
				data: datas,
				url: './main.php?p=<?php echo $_GET['p'] ?>', 
				})
			});
	$("#formReset").submit(function() {
		 datas = $(this).serialize(); 
		 $.ajax({
				type: 'POST', 
				data: datas,
				url: './main.php?p=<?php echo $_GET['p'] ?>', 
				})
			});
    return false; 
 });

</script>