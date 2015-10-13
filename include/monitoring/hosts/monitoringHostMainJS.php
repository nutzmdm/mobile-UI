<script type="text/javascript">
$.ajaxSetup({
    cache: false
});
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
		var searchBarStatusLabel = $('.ajaxOption tr:eq(0) td:eq(2)').text();
		var searchBarCollectorLabel = $('.ajaxOption tr:eq(0) td:eq(4)').text();
		var searchBarHostgroupLabel = $('.ajaxOption tr:eq(0) td:eq(6)').text();
		var searchBarStatusFilterOptions = $('.ajaxOption #statusFilter').html();
		var searchBarCollectorFilterOptions = $('.ajaxOption #select_instance').html();
		var searchBarHostgroupFilterOptions = $('.ajaxOption #hostgroups').html();
		
		//append path elements-->
		$('#pathImg1').append($('<img src='+pathImg1+'>'));
		$('#pathItem1').append($('<a href="#">'+pathItem1+'</a>'));
		$('#pathImg2').append($('<img src='+pathImg2+'>'));
		$('#pathItem2').append($('<a href="#">'+pathItem2+'</a>'));
		
		//append search form-->
		$('#hostSearchInputLabel').append(searchBarHostLabel);
		$('#statusSearchSelectLabel').append(searchBarStatusLabel);
		$('#collectorSearchSelectLabel').append(searchBarCollectorLabel);
		$('#hostgroupSearchSelectLabel').append(searchBarHostgroupLabel);
		$("#statusSearchSelect").append(searchBarStatusFilterOptions);
		$("#collectorSearchSelect").append(searchBarCollectorFilterOptions);
		$("#hostgroupSearchSelect").append(searchBarHostgroupFilterOptions);
		
		//append pagination elements-->
		var pagination = $('.ToolbarPagination').html();
		var paginationImgFirst
		var paginationImgPrevious
		var paginationImgNext
		var paginationImgLast
		$("#pagination").append(pagination);
		
		//modify appended elements-->
		$('#pagination a img[src="./img/icones/16x16/arrow_left_blue_double.gif"]').parent().attr(
																									'href','main.php?p=<?php echo $p;?>&o=<?php echo $o;?>&limit=10&num=0'+
																									'<?php if (isset ($_GET['host_search'])) {echo ('&host_search='.$_GET['host_search'].'');}?>'+
																									'<?php if (isset ($_GET['statusFilter'])) {echo ('&statusFilter='.$_GET['statusFilter'].'');}?>'+
																									'<?php if (isset ($_GET['select_instance'])) {echo ('&select_instance='.$_GET['select_instance'].'');}?>'+
																									'<?php if (isset ($_GET['hostgroups'])) {echo ('&hostgroups='.$_GET['hostgroups'].'');}?>'
																									);//first page link href
		$('#pagination a img[src="./img/icones/16x16/arrow_left_blue.gif"]').parent().attr(
																							'href','main.php?p=<?php echo $p;?>&o=<?php echo $o;?>&limit=10&num=<?php echo $num - 1;?>'+
																							'<?php if (isset ($_GET['host_search'])) {echo ('&host_search='.$_GET['host_search'].'');}?>'+
																							'<?php if (isset ($_GET['statusFilter'])) {echo ('&statusFilter='.$_GET['statusFilter'].'');}?>'+
																							'<?php if (isset ($_GET['select_instance'])) {echo ('&select_instance='.$_GET['select_instance'].'');}?>'+
																							'<?php if (isset ($_GET['hostgroups'])) {echo ('&hostgroups='.$_GET['hostgroups'].'');}?>'
																							);//previous page link href
		var lastPageNbr = $("#pagination a.otherPageNumber").last().text();
		$("#pagination a.otherPageNumber").each(function(){
			var getPgenumber = $(this).text();
			var pgeNumberForSrc = getPgenumber -1 ;
			$(this).attr(
							'href','main.php?p=100203&o=<?php echo $o;?>&limit=10&num='+pgeNumberForSrc+''+
							'<?php if (isset ($_GET['host_search'])) {echo ('&host_search='.$_GET['host_search'].'');}?>'+
							'<?php if (isset ($_GET['statusFilter'])) {echo ('&statusFilter='.$_GET['statusFilter'].'');}?>'+
							'<?php if (isset ($_GET['select_instance'])) {echo ('&select_instance='.$_GET['select_instance'].'');}?>'+
							'<?php if (isset ($_GET['hostgroups'])) {echo ('&hostgroups='.$_GET['hostgroups'].'');}?>'
							)
			});
		$('#pagination a img[src="../../img/icones/16x16/arrow_right_blue.gif"]').parent().attr(
																								'href','main.php?p=<?php echo $p;?>&o=<?php echo $o;?>&limit=10&num=<?php echo $num + 1;?>'+
																								'<?php if (isset ($_GET['host_search'])) {echo ('&host_search='.$_GET['host_search'].'');}?>'+
																								'<?php if (isset ($_GET['statusFilter'])) {echo ('&statusFilter='.$_GET['statusFilter'].'');}?>'+
																								'<?php if (isset ($_GET['select_instance'])) {echo ('&select_instance='.$_GET['select_instance'].'');}?>'+
																								'<?php if (isset ($_GET['hostgroups'])) {echo ('&hostgroups='.$_GET['hostgroups'].'');}?>'
																								);//next page link href
		$('#pagination a img[src="./img/icones/16x16/arrow_right_blue_double.gif"]').parent().attr(
																									'href','main.php?p=<?php echo $p;?>&o=<?php echo $o;?>&limit=10&num=0'+lastPageNbr+''+
																									'<?php if (isset ($_GET['host_search'])) {echo ('&host_search='.$_GET['host_search'].'');}?>'+
																									'<?php if (isset ($_GET['statusFilter'])) {echo ('&statusFilter='.$_GET['statusFilter'].'');}?>'+
																									'<?php if (isset ($_GET['select_instance'])) {echo ('&select_instance='.$_GET['select_instance'].'');}?>'+
																									'<?php if (isset ($_GET['hostgroups'])) {echo ('&hostgroups='.$_GET['hostgroups'].'');}?>'
																									);//last page link href
		
		$('#pagination a img[src="./img/icones/16x16/arrow_left_blue_double.gif"]').attr('src','./modules/mobile-UI/include/img/icones/leftdbl.png');
		$('#pagination a img[src="./img/icones/16x16/arrow_left_blue.gif"]').attr('src','./modules/mobile-UI/include/img/icones/left.png');
		$('#pagination a img[src="./img/icones/16x16/arrow_right_blue.gif"]').attr('src','./modules/mobile-UI/include/img/icones/right.png');
		$('#pagination a img[src="./img/icones/16x16/arrow_right_blue_double.gif"]').attr('src','./modules/mobile-UI/include/img/icones/rightdbl.png');
		
		//Getting page elements	-->
		var i = 0;
		for (i=0; i < $('.ListTable #trStatus').length; i++){
			var tdSelectHostname = $('.ListTable #trStatus:eq(' +i+ ')').find('td:eq(1)').text();
			var tdSelectHostImgSrc = $('.ListTable #trStatus:eq(' +i+ ')').find('td:eq(1)').find('img').attr('src');
			var tdSelectHostImgId = $('.ListTable #trStatus:eq(' +i+ ')').find('td:eq(1)').find('a').attr('id');
			var tdSelectHostStateImg = $('.ListTable #trStatus:eq(' +i+ ')').find('td:eq(2)').html();
			//append elements of this loop-->
			$("#showHost").append(
									'<li>'+
										'<a href="main.php?p=<?php echo $p ?>&o=hd&amp;host_name='+tdSelectHostname+'">'+
										'<table class="tbl_100"><tr>'+
											'<td class="td1-host-status">'+
												'<img src='+tdSelectHostImgSrc+' width="16" height="16" style="padding-right:5px;">'+tdSelectHostname+'</td>'+	
											'<td class="td2-host-status">'+tdSelectHostStateImg+'</td>'+
										'</tr></table>'+
									'</a></li>'
									);
								};

		}, <?php echo 500*$tempoScripts+4000+500;?>); //tempo d'exécution des scripts
	
	});

$(document).on('pageinit', function() {
	setTimeout(function(){
		if (	$('#showHost').hasClass('ui-listview')) {
				$('#showHost').listview('refresh');
		} 
		else {
				$('#showHost').trigger('create');
		}
		
	}, <?php echo 500*$tempoScripts+4000+550;?>);

$(document).on('pageshow', '[data-role="page"]', function(){  
    setTimeout(function(){
        $.mobile.loading('hide');
    },<?php echo 500*$tempoScripts+4000+600;?>);      
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