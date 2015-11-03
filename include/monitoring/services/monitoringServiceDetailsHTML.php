<!-----------------------------------------------------------------------------------------------------------------
HTML
------------------------------------------------------------------------------------------------------------------>

<?php include ("./modules/mobile-UI/include/common/htmlHeader.php");?>	
<?php include ("./modules/mobile-UI/include/monitoring/services/monitoringServiceDetailsJS.php");?>
	
<div data-role="page" id="mainContentMod" data-url="mainContentMod" data-dom-cache="false">

<!-- menu -->
<?php require_once "./modules/mobile-UI/include/common/menu.php";?>	

<!-- header -->
<div data-role="header" data-theme="a">
	<h3 style="font-size:15px">Centreon</h3>
	<a href="#menuPanel" class="ui-btn ui-icon-bullets ui-btn-icon-notext ui-corner-all" data-role="button" role="button"></a>
	<a href="#backButton" class="ui-btn ui-icon-arrow-l ui-btn-icon-notext ui-corner-all" data-role="button" role="button" data-rel="back"></a>
</div>

<!-- content -->

<div data-role="content" class="ui-content">

	<table id="path" class="tblPath"> <!-- path -->
		<tr>
			<td id="pathImg1"></td>
			<td id="pathItem1" class="pathItem"></td>
		</tr>
	</table>

	<table class="tbl_spacer"><tr><td></td></tr></table>
	
	<span id="hostTitle" class="ui-bar ui-bar-a"></span> <!-- title -->
	<div class="div-align-center"> <!-- tabs -->
		<a id="tabs1" onclick="showTab(this)" href="#" class="tabBtn ui-btn ui-btn-inline ui-mini ui-icon-info ui-btn-icon-notext ui-btn-active"></a>
		<a id="tabs2" onclick="showTab(this)" href="#" class="tabBtn ui-btn ui-btn-inline ui-mini ui-icon-gear ui-btn-icon-notext"></a>
		<a id="tabs3" onclick="showTab(this)" href="#" class="tabBtn ui-btn ui-btn-inline ui-mini ui-icon-star ui-btn-icon-notext"></a>
		<a id="tabs4" onclick="showTab(this)" href="#" class="tabBtn ui-btn ui-btn-inline ui-mini ui-icon-tag ui-btn-icon-notext"></a>
		<a id="tabs5" onclick="showTab(this)" href="#" class="tabBtn ui-btn ui-btn-inline ui-mini ui-icon-video ui-btn-icon-notext"></a>
		<a id="tabs6" onclick="showTab(this)" href="#" class="tabBtn ui-btn ui-btn-inline ui-mini ui-icon-comment ui-btn-icon-notext"></a>
	</div>

	<div id="tabs-1" class="tabContent" style="display:block;"> <!-- Tab1 - Details -->
		<table class="tbl_spacer"><tr><td></td></tr></table>
		<table id="table1HostDetails" class="tableDetails tbl_100 tbl_Border2">
			<tbody>
				<tr class="trImpair trTitre"><td id="table1Tr0Td0" colspan="2" class="tdDetails"></td></tr>
				<tr class="trPair">
					<td id="table1Tr1Td1" class="borderRight"></td>
					<td id="table1Tr1Td2"></td>
				</tr>
				<tr class="trImpair">
					<td id="table1Tr2Td1" class="borderRight"></td>
					<td id="table1Tr2Td2"></td>
				</tr>
				<tr class="trPair">
					<td id="table1Tr3Td1" class="borderRight"></td>
					<td id="table1Tr3Td2"></td>
				</tr>
				<tr class="trImpair">
					<td id="table1Tr5Td1" class="borderRight"></td>
					<td id="table1Tr5Td2"></td>
				</tr>
				<tr class="trPair">
					<td id="table1Tr6Td1" class="borderRight"></td>
					<td id="table1Tr6Td2"></td>
				</tr>
				<tr class="trImpair">
					<td id="table1Tr7Td1" class="borderRight"></td>
					<td id="table1Tr7Td2"></td>
				</tr>
				<tr class="trPair">
					<td id="table1Tr8Td1" class="borderRight"></td>
					<td id="table1Tr8Td2"></td>
				</tr>
				<tr class="trImpair">
					<td id="table1Tr9Td1" class="borderRight"></td>
					<td id="table1Tr9Td2"></td>
				</tr>
				<tr class="trPair">
					<td id="table1Tr10Td1" class="borderRight"></td>
					<td id="table1Tr10Td2"></td>
				</tr>
				<tr class="trImpair">
					<td id="table1Tr11Td1" class="borderRight"></td>
					<td id="table1Tr11Td2"></td>
				</tr>
				<tr class="trPair">
					<td id="table1Tr12Td1" class="borderRight"></td>
					<td id="table1Tr12Td2"></td>
				</tr>
				<tr class="trImpair">
					<td id="table1Tr13Td1" class="borderRight"></td>
					<td id="table1Tr13Td2"></td>
				</tr>
				<tr class="trPair">
					<td id="table1Tr14Td1" class="borderRight"></td>
					<td id="table1Tr14Td2"></td>
				</tr>
				<tr class="trImpair">
					<td id="table1Tr15Td1" class="borderRight"></td>
					<td id="table1Tr15Td2"></td>
				</tr>
				<tr class="trPair">
					<td id="table1Tr16Td1" class="borderRight"></td>
					<td id="table1Tr16Td2"></td>
				</tr>
				<tr class="trImpair">
					<td id="table1Tr17Td1" class="borderRight"></td>
					<td id="table1Tr17Td2"></td>
				</tr>
				<tr class="trPair">
					<td id="table1Tr18Td1" class="borderRight"></td>
					<td id="table1Tr18Td2"></td>
				</tr>
				<tr class="trImpair">
					<td id="table1Tr19Td1" class="borderRight borderLeft2 borderBottom"></td>
					<td id="table1Tr19Td2" class="borderLeft borderRight2 borderBottom"></td>
				</tr>
			</tbody>
		</table>
	</div>
	
	<div id="tabs-2" class="tabContent " style="display:none"> <!-- Tab2 - options -->
		<table id="table2HostDetails" class="tableDetails tbl_100 tbl_Border2">
			<tbody>
				<tr class="trImpair trTitre"><td id="table2Tr0Td0" colspan="3" class="tdDetails"></td></tr>
				<tr class="trPair">
					<td id="table2Tr1Td1" class="tdDetails"></td>
					<td id="table2Tr1Td2" class="tdDetails tdCenter"></td>
					<td id="table2Tr1Td3" class="tdDetails tdCenter"></td>
				</tr>
				<tr class="trImpair">
					<td id="table2Tr2Td1" class="tdDetails"></td>
					<td id="table2Tr2Td2" class="tdDetails tdCenter"></td>
					<td id="table2Tr2Td3" class="tdDetails tdCenter"></td>
				</tr>
				<tr class="trPair">
					<td id="table2Tr3Td1" class="tdDetails"></td>
					<td id="table2Tr3Td2" class="tdDetails tdCenter"></td>
					<td id="table2Tr3Td3" class="tdDetails tdCenter"></td>
				</tr>
				<tr class="trImpair">
					<td id="table2Tr4Td1" class="tdDetails"></td>
					<td id="table2Tr4Td2" class="tdDetails tdCenter"></td>
					<td id="table2Tr4Td3" class="tdDetails tdCenter"></td>
				</tr>
				<tr class="trPair">
					<td id="table2Tr5Td1" class="tdDetails"></td>
					<td id="table2Tr5Td2" class="tdDetails tdCenter"></td>
					<td id="table2Tr5Td3" class="tdDetails tdCenter"></td>
				</tr>
				<tr class="trImpair">
					<td id="table2Tr6Td1" class="tdDetails"></td>
					<td id="table2Tr6Td2" class="tdDetails tdCenter"></td>
					<td id="table2Tr6Td3" class="tdDetails tdCenter"></td>
				</tr>
			</tbody>
		</table>		
	</div>
	
	<div id="tabs-3" class="tabContent" style="display:none"> <!-- Tab3 - commands -->
		<table id="table3HostDetails" class="tableDetails tbl_100 tbl_Border2">
			<tbody>
				<tr class="trImpair trTitre"><td id="table3Tr0Td1" class="tdDetails"></td></tr>
				<tr class="trPair"><td id="table3Tr1Td1" class="tdCommands"></td></tr>
				<tr class="trImpair"><td id="table3Tr2Td1" class="tdCommands"></td></tr>
				<tr class="trPair"><td id="table3Tr3Td1" class="tdCommands"></td></tr>
				<tr class="trImpair"><td id="table3Tr4Td1" class="tdCommands"></td></tr>
				<!--<tr class="trPair"><td id="table3Tr5Td1" class="tdCommands"></td></tr>-->
			</tbody>
		</table>
	</div>
	
	<div id="tabs-4" class="tabContent" style="display:none"> <!-- Tab4 - perf datas, tools, links & notifications -->
		<table id="table4HostDetails" class="tableDetails tbl_100 tbl_Border2"> <!-- perf datas -->
			<tbody>
				<tr class="trImpair tbl_100  trTitre tbl_Border2"><td id="table4Tr0Td0" class="tdDetails"></td></tr>
				<tr class="trPair"><td id="table4Tr0Td1" class="tdDetails"></td></tr>
			</tbody>
		</table>
		<table class="tbl_spacer"><tr><td></td></tr></table>
		<table class="tbl_spacer"><tr><td></td></tr></table>
		<table id="table5HostDetails" class="tableDetails tbl_100 tbl_Border2"> <!-- links -->
			<tbody>
				<tr class="trImpair tbl_100  trTitre tbl_Border2"><td id="table5Tr0Td0" class="tdDetails"  colspan="2"></td></tr>
				<tr class="trPair">
					<td id="table5Tr1Td0" class="tdDetails"></td>
					<td id="table5Tr1Td1" class="tdDetails"></td>
				</tr>
				<tr class="trImpair">
					<td id="table5Tr2Td0" class="tdDetails"></td>
					<td id="table5Tr2Td1" class="tdDetails"></td>
				</tr>
				<tr class="trPair">
					<td id="table5Tr3Td0" class="tdDetails"></td>
					<td id="table5Tr3Td1" class="tdDetails"></td>
				</tr>
			</tbody>
		</table>
		<table class="tbl_spacer"><tr><td></td></tr></table>
		<table class="tbl_spacer"><tr><td></td></tr></table>
		<table id="table6HostDetails" class="tableDetails tbl_100 tbl_Border2"> <!-- notifications -->
			<tbody>
				<tr class="trImpair tbl_100  trTitre tbl_Border2"><td id="table6Tr0Td0" class="tdDetails"></td></tr>
				<tr class="trPair"><td id="table6Tr1Td0" class="tdDetails"></td></tr>
				<tr class="trImpair"><td id="table6Tr2Td0" class="tdDetails"></td></tr>
			</tbody>
		</table>
	</div>
	
	<div id="tabs-5" class="tabContent" style="display:none"> <!-- Tab6 - Graphs -->
		<table id="table7GraphDetails" class="tableDetails tbl_100 tbl_Border2"> <!-- Graph details -->
			<tbody>
				<tr class="trImpair tbl_100  trTitre tbl_Border2"><td id="table7Tr0Td0" class="tdDetails"></td></tr>
				<tr class="trPair"><td id="table7Tr1Td0" class="tdGraph"></td></tr>
			</tbody>
		</table>
		<table class="tbl_spacer"><tr><td></td></tr></table>
		<table class="tbl_spacer"><tr><td></td></tr></table>
		<table id="table8GraphStatus" class="tableDetails tbl_100 tbl_Border2"> <!-- Graph Status -->
			<tbody>
				<tr class="trImpair tbl_100  trTitre tbl_Border2"><td id="table8Tr0Td0" class="tdDetails"></td></tr>
				<tr class="trPair"><td id="table8Tr1Td0" class="tdGraph"></td></tr>
			</tbody>
		</table>
	</div>
	
	<div id="tabs-6" class="tabContent" style="display:none"> <!-- Tab6 - comments -->
		<table id="table9HostDetails" class="tableDetails tbl_100 tbl_Border2">
			<tbody>
				<tr class="trImpair tbl_100  trTitre tbl_Border2"><td id="table9Tr0Td0" class="tdDetails" colspan="6"></td></tr>
				<tr class="trImpair tbl_Border2">
					<td id="table9Tr1Td0" class="tbl_Border2"></td>
					<td id="table9Tr1Td1" class="tbl_Border2"></td>
					<td id="table9Tr1Td2" class="tbl_Border2"></td>
					<td id="table9Tr1Td3" class="tbl_Border2"></td>
					<td id="table9Tr1Td4" class="tbl_Border2"></td>
					<td id="table9Tr1Td5" class="tbl_Border2"></td>
				</tr>
				<!-- append JS here (loop) -->
			</tbody>
		</table>
	</div>
</div>

</div>

