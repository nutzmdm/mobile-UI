<!-----------------------------------------------------------------------------------------------------------------
HTML
------------------------------------------------------------------------------------------------------------------>

<?php include ("./modules/mobile-UI/include/common/htmlHeader.php");?>

<script src="./modules/mobile-UI/include/js/charts/highcharts.js"></script>
<script src="./modules/mobile-UI/include/js/charts/exporting.js"></script>

<?php include ("homeJS.php"); ?>

<!-- page -->
<div data-role="page" id="mainContentMod" data-url="mainContentMod" data-dom-cache="false" class="ui-responsive-panel">

<!-- menu -->
<?php require_once "./modules/mobile-UI/include/common/menu.php";?>	

<!-- header -->

<div data-role="header" data-theme="a">
	<h3 style="font-size:15px">Centreon</h3>
		<a href="#menuPanel" class="ui-btn ui-icon-bullets ui-btn-icon-notext ui-corner-all" data-role="button" role="button"></a>
</div>

<!-- /content -->
<div id="content" data-role="content" class="ui-content">

	<table id="path" class="tblPath">
		<tr>
			<td id="pathImg1"></td>
			<td id="pathItem1" class="pathItem"></td>
		</tr>
	</table>
	<br />
			<div id="resumeCollectorStateDiv">
			<table id="resumeCollectorStateTable">
			<tbody>
				<tr>
					<td colspan="3">
						<div id="resumeCollectorStateHeader" class="content_med_bold"><!-- append JS content --></div>
					</td>
				</tr>
				<tr>
					<td id="resumeCollectorState1img"><!-- append JS content --></td>
					<td id="resumeCollectorState2img"><!-- append JS content --></td>
					<td id="resumeCollectorState3img"><!-- append JS content --></td>
				</tr>
				<tr>
					<td id="resumeCollectorState1text"><!-- append JS content --></td>
					<td id="resumeCollectorState2text"><!-- append JS content --></td>
					<td id="resumeCollectorState3text"><!-- append JS content --></td>
				</tr>
			</tbody>
			</table>
			</div>
			<div id="resumeHostStateDiv">
			<table id="resumeHostStateTable" >
				<tbody>
					<tr id="resumeHostStateTr">
						<td id="resumeHostStateTd_title" colspan="2" rowspan="1" class="borderTop borderBottom borderLeft"><!-- append JS content --></td>
						<td id="resumeHostStateTd_chart" colspan="1" rowspan="5" class="borderTop borderRight borderLeft"><div id="chart1"><!-- Chart1 - append JS content --></div></td>
					</tr>	
					<tr class="borderBottom">
					  <td id="resumeHostStateTd_title_State1" class="borderRight borderBottom borderLeft"><!-- append JS content --></td>
					  <td id="resumeHostStateTd_value_State1" class="resumeStateTdContentValueGreen"><!-- append JS content --></td>
					</tr>
					<tr>
					  <td id="resumeHostStateTd_title_State2" class="borderRight borderBottom borderLeft"><!-- append JS content --></td>
					  <td id="resumeHostStateTd_value_State2" class="resumeStateTdContentValueRed"><!-- append JS content --></td>
					</tr>
					<tr>
					  <td id="resumeHostStateTd_title_State3" class="borderRight borderBottom borderLeft"><!-- append JS content --></td>
					  <td id="resumeHostStateTd_value_State3" class="resumeStateTdContentValueLightBlue"><!-- append JS content --></td>
					</tr>
					<tr>
					  <td id="resumeHostStateTd_title_State4" class="borderRight borderLeft"><!-- append JS content --></td>
					  <td id="resumeHostStateTd_value_State4" class="resumeStateTdContentValueBlue"><!-- append JS content --></td>
					</tr>
					<tr id="resumeHostStateTr">
						<td id="resumeServiceStateTd_title" colspan="2" rowspan="1" class="borderTop borderBottom borderLeft"><!-- append JS content --></td>
						<td id="resumeServiceStateTd_chart" colspan="1" rowspan="6" class="borderTop borderRight borderLeft"><div id="chart2"><!-- Chart2 - append JS content --></div></td>
					</tr>
					<tr>
					  <td id="resumeServiceStateTd_title_State1" class="borderRight borderBottom borderLeft"><!-- append JS content --></td>
					  <td id="resumeServiceStateTd_value_State1" class="resumeStateTdContentValueGreen"><!-- append JS content --></td>
					</tr>
					<tr>
					  <td id="resumeServiceStateTd_title_State2" class="borderRight borderBottom borderLeft"><!-- append JS content --></td>
					  <td id="resumeServiceStateTd_value_State2" class="resumeStateTdContentValueOrange"><!-- append JS content --></td>
					</tr>
					<tr>
					  <td id="resumeServiceStateTd_title_State3" class="borderRight borderBottom borderLeft"><!-- append JS content --></td>
					  <td id="resumeServiceStateTd_value_State3" class="resumeStateTdContentValueRed"><!-- append JS content --></td>
					</tr>
					<tr>
					  <td id="resumeServiceStateTd_title_State4" class="borderRight borderBottom borderLeft"><!-- append JS content --></td>
					  <td id="resumeServiceStateTd_value_State4" class="resumeStateTdContentValueGrey"><!-- append JS content --></td>
					</tr>
					<tr>
					  <td id="resumeServiceStateTd_title_State5" class="borderRight borderLeft"><!-- append JS content --></td>
					  <td id="resumeServiceStateTd_value_State5" class="resumeStateTdContentValueBlue"><!-- append JS content --></td>
					</tr>
					<tr><td class="borderTop"></td><td class="borderTop"></td><td class="borderTop"></td></tr>
				</tbody>
			</table>
			</div>
	</div>
</div>

</div>