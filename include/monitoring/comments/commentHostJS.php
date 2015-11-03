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
		
		var formCommentHeader = $('#Tmainpage.TcTD div:eq(0) form table.ListTableMedium tbody tr:eq(0) td:eq(0)').html();
		var formCommentNameHost = $('#Tmainpage.TcTD div:eq(0) form table.ListTableMedium tbody tr:eq(2) td:eq(0)').html();
		var formCommentNameHostSelect = $('#Tmainpage.TcTD div:eq(0) form table.ListTableMedium tbody tr:eq(2) td:eq(1)').html();
		var formCommentAckPersist = $('#Tmainpage.TcTD div:eq(0) form table.ListTableMedium tbody tr:eq(3) td:eq(0)').html();
		var formCommentAckPersistCheckbox = $('#Tmainpage.TcTD div:eq(0) form table.ListTableMedium tbody tr:eq(3) td:eq(1)').html();
		var formCommentComment = $('#Tmainpage.TcTD div:eq(0) form table.ListTableMedium tbody tr:eq(4) td:eq(0)').html();
		var formCommentCommentText = $('#Tmainpage.TcTD div:eq(0) form table.ListTableMedium tbody tr:eq(4) td:eq(1)').html();
		var validateButton = $('#Tmainpage.TcTD div:eq(0) form div').html();
		
		$('link[href="./Themes/Centreon-2/style.css"]').attr('href, ""');
		
		$('#tdFormCommentHeader').append(formCommentHeader);
		$('#tdFormCommentNameHost').append(formCommentNameHost);
		$('#tdFormCommentNameHostSelect').append(formCommentNameHostSelect);
		$('#tdFormCommentAckPersist').append(formCommentAckPersist);
		$('#tdFormCommentAckPersistCheckbox').append(formCommentAckPersistCheckbox);
		$('#tdFormCommentComment').append(formCommentComment);
		$('#tdFormCommentCommentText').append(formCommentCommentText);
		$('#divValidateButton').append(validateButton);
		$('#divValidateButton').find('input').attr('class, class="ui-input-btn ui-btn ui-corner-all ui-shadow"');
		
		}, <?php echo 500*$tempoScripts+50;?>); //tempo d'exécution des scripts
	
	});

$(document).on('pageshow', '[data-role="page"]', function(){ 
    setTimeout(function(){
        $.mobile.loading('hide');
    },<?php echo 0*$tempoScripts+50;?>);      
});

</script>	