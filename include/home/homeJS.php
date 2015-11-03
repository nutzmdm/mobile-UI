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
		$('#header').hide();
		$('#forMenuAjax').hide();
		$('.imgPathWay').hide();
		$('.pathWay').hide();
		$('hr').hide();
		$('#footer').hide();
		$('#footerline1').hide();
		$('#footerline2').hide();
		$('img[src="./img/icones/7x7/sort_asc.gif"]').hide();
		
			var msg = $('table#Tcontener tbody tr td#Tmainpage.TcTD div.msg').attr('class');
		if (msg == 'msg')
		{return false;}
	
		
		//Getting page elements	-->
		var resumeCollectorStateHeader = $('#resume_light table table.Resume_light_table:eq(0) tr.Resume_light_header').find('td:eq(0)').text();
		var resumeCollectorState1img = $('.Resume_light_table td#latency').html();
		var resumeCollectorState2img = $('.Resume_light_table td#pollingState').html();
		var resumeCollectorState3img = $('.Resume_light_table td#activity').html();
		var resumeCollectorState1text = $('.Resume_light_table td#latency').find('img').attr('title');
		var resumeCollectorState2text = $('.Resume_light_table td#pollingState').find('img').attr('title');
		var resumeCollectorState3text = $('.Resume_light_table td#activity').find('img').attr('title');
		var pathImg1 = $('table#Tcontener tr:eq(0) td#Tmainpage img.imgPathWay').attr('src');
		var pathItem1 = $('table#Tcontener tr:eq(0) td#Tmainpage a:eq(0)').text();

		//Applying modifications	-->
		$(".Resume_light_table:eq(1) tr:eq(1) td:eq(0) div a").attr('href','main.php?p=100203&o=h&limit=10&num=0');
		$(".Resume_light_table:eq(1) tr:eq(1) td:eq(1) div a").attr('href','main.php?p=100203&o=h_up&limit=10&num=0');
		$(".Resume_light_table:eq(1) tr:eq(1) td:eq(2) div a").attr('href','main.php?p=100203&o=h_down&limit=10&num=0');
		$(".Resume_light_table:eq(1) tr:eq(1) td:eq(3) div a").attr('href','main.php?p=100203&o=h_unreachable&limit=10&num=0');
		$(".Resume_light_table:eq(1) tr:eq(1) td:eq(4) div a").attr('href','main.php?p=100203&o=h_pending&limit=10&num=0');
		$('.Resume_light_table:eq(2) tr:eq(1) td:eq(0) div a').attr('href','main.php?p=100303&o=svc&limit=10&num=0');
		$('.Resume_light_table:eq(2) tr:eq(1) td:eq(1) div a').attr('href','main.php?p=100303&o=svc_ok&limit=10&num=0');
		$('.Resume_light_table:eq(2) tr:eq(1) td:eq(2) div a').attr('href','main.php?p=100303&o=svc_warning&limit=10&num=0');
		$('.Resume_light_table:eq(2) tr:eq(1) td:eq(3) div a').attr('href','main.php?p=100303&o=svc_critical&limit=10&num=0');
		$('.Resume_light_table:eq(2) tr:eq(1) td:eq(4) div a').attr('href','main.php?p=100303&o=svc_unknown&limit=10&num=0');
		$('.Resume_light_table:eq(2) tr:eq(1) td:eq(5) div a').attr('href','main.php?p=100303&o=svc_pending&limit=10&num=0');
		
		//append elements -->
		$('#resumeCollectorStateHeader').append(resumeCollectorStateHeader);
		$('#resumeCollectorState1img').append(resumeCollectorState1img);
		$('#resumeCollectorState2img').append(resumeCollectorState2img);
		$('#resumeCollectorState3img').append(resumeCollectorState3img);
		$('#resumeCollectorState1text').append(resumeCollectorState1text);
		$('#resumeCollectorState2text').append(resumeCollectorState2text);
		$('#resumeCollectorState3text').append(resumeCollectorState3text);
		$("#resumeHostStateTd_title").append($('.Resume_light_header:eq(1) td:eq(0)').text()+' ('+$(".Resume_light_table:eq(1) tr:eq(1) td:eq(0) div").html()+')');
		$("#resumeHostStateTd_title_State1").append($('.Resume_light_header:eq(1) td:eq(1)').text());
		$("#resumeHostStateTd_title_State2").append($('.Resume_light_header:eq(1) td:eq(2)').text());
		$("#resumeHostStateTd_title_State3").append($('.Resume_light_header:eq(1) td:eq(3)').text());
		$("#resumeHostStateTd_title_State4").append($('.Resume_light_header:eq(1) td:eq(4)').text());
		$("#resumeHostStateTd_value_State1").append($('.Resume_light_table:eq(1) tr:eq(1) td:eq(1)').html());
		$("#resumeHostStateTd_value_State2").append($('.Resume_light_table:eq(1) tr:eq(1) td:eq(2)').html());
		$("#resumeHostStateTd_value_State3").append($('.Resume_light_table:eq(1) tr:eq(1) td:eq(3)').html());
		$("#resumeHostStateTd_value_State4").append($('.Resume_light_table:eq(1) tr:eq(1) td:eq(4)').html());
			$('div#host_up').addClass('div_host_up');
			$('div#host_down').addClass('div_host_down');
			$('div#host_unreachable').addClass('div_host_unreachable');
			$('div#host_pending').addClass('div_host_pending');
		$("#resumeServiceStateTd_title").append($('.Resume_light_table:eq(2) tr:eq(0) td:eq(0)').text()+' ('+$(".Resume_light_table:eq(2) tr:eq(1) td:eq(0) div").html()+')');
		$("#resumeServiceStateTd_title_State1").append($('.Resume_light_table:eq(2) tr:eq(0) td:eq(1)').html());
		$("#resumeServiceStateTd_title_State2").append($('.Resume_light_table:eq(2) tr:eq(0) td:eq(2)').html());
		$("#resumeServiceStateTd_title_State3").append($('.Resume_light_table:eq(2) tr:eq(0) td:eq(3)').html());
		$("#resumeServiceStateTd_title_State4").append($('.Resume_light_table:eq(2) tr:eq(0) td:eq(4)').html());
		$("#resumeServiceStateTd_title_State5").append($('.Resume_light_table:eq(2) tr:eq(0) td:eq(5)').html());
		$("#resumeServiceStateTd_value_State1").append($('.Resume_light_table:eq(2) tr:eq(1) td:eq(1)').html());
		$("#resumeServiceStateTd_value_State2").append($('.Resume_light_table:eq(2) tr:eq(1) td:eq(2)').html());
		$("#resumeServiceStateTd_value_State3").append($('.Resume_light_table:eq(2) tr:eq(1) td:eq(3)').html());
		$("#resumeServiceStateTd_value_State4").append($('.Resume_light_table:eq(2) tr:eq(1) td:eq(4)').html());
		$("#resumeServiceStateTd_value_State5").append($('.Resume_light_table:eq(2) tr:eq(1) td:eq(5)').html());

		$('#pathImg1').append($('<img src='+pathImg1+'>'));
		$('#pathItem1').append($('<a href="#">'+pathItem1+'</a>'));

	}, <?php echo 500*$tempoScripts+500;?>); //tempo d'exécution des scripts
});

$(document).on('pageshow', '[data-role="page"]', function(){  
    setTimeout(function(){
        $.mobile.loading('hide');
    },<?php echo 500*$tempoScripts+550;?>);	//tempo d'exécution des scripts
});

//Drawing first pie
$(function () {
	setTimeout(function(){
	
			var resumeHostStateTd_value_State1 = $('.Resume_light_table:eq(1) tr:eq(1) td:eq(1) div a').text();
			var resumeHostStateTd_value_State2 = $('.Resume_light_table:eq(1) tr:eq(1) td:eq(2) div a').text();
			var resumeHostStateTd_value_State3 = $('.Resume_light_table:eq(1) tr:eq(1) td:eq(3) div a').text();
			var resumeHostStateTd_value_State4 = $('.Resume_light_table:eq(1) tr:eq(1) td:eq(4) div a').text();
			
			$('#chart1').highcharts({
				exporting: {
					buttons: {
						contextButton: {
							enabled: false
							}
						}
					},
				chart: {
					backgroundColor: null,
					plotBackgroundColor: null,
					plotBorderWidth: '0',
					plotShadow: false
				},
				credits: {
					enabled: false
				},
				title: {
					text: null
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							format: '{point.percentage:.1f} %',
							style: {
								color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
							}
						}
					}
				},
				colors: ['#C3EFB3', '#F2DEDF', '#B6EDF6', '#A3C9D8'],
				series: [{
					type: 'pie',
					name: 'Pourcentage',
					data: 	[
							[$('.Resume_light_header:eq(1) td:eq(1)').text(), +resumeHostStateTd_value_State1],
							{
							name: $('.Resume_light_header:eq(1) td:eq(2)').text(),
							y: +resumeHostStateTd_value_State2,
							sliced: true,
							selected: true
							},
							[$('.Resume_light_header:eq(1) td:eq(3)').text(), +resumeHostStateTd_value_State3],
                
							[$('.Resume_light_header:eq(1) td:eq(4)').text(), +resumeHostStateTd_value_State4]
							]
				}]
			});
		}, <?php echo 500*$tempoScripts+1000;?>);	//tempo d'exécution des scripts
	});

//Drawing second pie
$(function () {
	setTimeout(function(){
	
			var resumeServiceStateTd_value_State1 = $('.Resume_light_table:eq(2) tr:eq(1) td:eq(1) div a').text();
			var resumeServiceStateTd_value_State2 = ($('.Resume_light_table:eq(2) tr:eq(1) td:eq(2) div a').text()).substring(($('.Resume_light_table:eq(2) tr:eq(1) td:eq(2) div a').text()).lastIndexOf('/')+1);
			var resumeServiceStateTd_value_State3 = ($('.Resume_light_table:eq(2) tr:eq(1) td:eq(3) div a').text()).substring(($('.Resume_light_table:eq(2) tr:eq(1) td:eq(3) div a').text()).lastIndexOf('/')+1);
			var resumeServiceStateTd_value_State4 = ($('.Resume_light_table:eq(2) tr:eq(1) td:eq(4) div a').text()).substring(($('.Resume_light_table:eq(2) tr:eq(1) td:eq(4) div a').text()).lastIndexOf('/')+1);
			var resumeServiceStateTd_value_State5 = $('.Resume_light_table:eq(2) tr:eq(1) td:eq(5) div a').text();

			$('#chart2').highcharts({
				exporting: {
					buttons: {
						contextButton: {
							enabled: false
							}
						}
					},
				chart: {
					backgroundColor: null,
					plotBackgroundColor: null,
					plotBorderWidth: '0',
					plotShadow: false
				},
				credits: {
					enabled: false
				},
				title: {
					text: null
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							format: '{point.percentage:.1f} %',
							style: {
								color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
							}
						}
					}
				},
				colors: ['#C3EFB3', '#FFE187', '#F2DEDF', '#CBCBD8', '#A3C9D8'],
				series: [{
					type: 'pie',
					name: 'Pourcentage',
					data: 	[
							[$('.Resume_light_table:eq(2) tr:eq(0) td:eq(1)').text(), +resumeServiceStateTd_value_State1],
							{
							name: $('.Resume_light_table:eq(2) tr:eq(0) td:eq(2)').text(),
							y: +resumeServiceStateTd_value_State2,
							sliced: true,
							selected: true
							},
							[$('.Resume_light_table:eq(2) tr:eq(0) td:eq(3)').text(), +resumeServiceStateTd_value_State3],
							[$('.Resume_light_table:eq(2) tr:eq(0) td:eq(4)').text(), +resumeServiceStateTd_value_State4],
							[$('.Resume_light_table:eq(2) tr:eq(0) td:eq(4)').text(), +resumeServiceStateTd_value_State5]
							]
				}]
			});
		}, <?php echo 500*$tempoScripts+1000;?>);	//tempo d'exécution des scripts
	});
</script>