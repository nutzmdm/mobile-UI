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


});

$(document).on('pageshow', '[data-role="page"]', function(){ 
    setTimeout(function(){
        $.mobile.loading('hide');
    },<?php echo 0*$tempoScripts+50;?>);      
});

</script>