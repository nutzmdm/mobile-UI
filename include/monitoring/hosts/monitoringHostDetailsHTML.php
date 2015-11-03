<!-----------------------------------------------------------------------------------------------------------------
HTML
------------------------------------------------------------------------------------------------------------------>

<?php include ("./modules/mobile-UI/include/common/htmlHeader.php");?>	
<?php include ("./modules/mobile-UI/include/monitoring/hosts/monitoringHostDetailsJS.php");?>
<?php include ("./include/monitoring/comments/common-Func.php");?>

<!--get host_id and host address by hostname-->
						<?php 
						$hostObj = new CentreonHost($pearDB);
						$hostID = $hostObj->getHostId($_GET['host_name']);
						$hostAddress = $hostObj->getHostAddress($hostID);
						?> 
						<script>
							$(document).ready(function(){
							$("#linkPing").click(function() {
								$("pingResultContener").css('display', 'block')
								$("#pingResult").load("./include/tools/ping.php?host=<?php echo $hostAddress;?>");
								});
							$("#linkTracert").click(function() {
								$("tracertResultContener").css('display', 'block')
								$("#tracertResult").load("./include/tools/traceroute.php?host=<?php echo $hostAddress;?>");
								});
							$("#linkComment").click(function() {
								$("commentContener").css('display', 'block')
								});	
							});
						</script>

						
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
		<a id="tabs5" onclick="showTab(this)" href="#" class="tabBtn ui-btn ui-btn-inline ui-mini ui-icon-comment ui-btn-icon-notext"></a>
	</div>

	<div id="tabs-1" class="tabContent" style="display:block;"> <!-- Tab1 - Details -->
		<table class="tbl_spacer"><tr><td></td></tr></table>
		<table id="table1HostDetails" class="tableDetails tbl_100 tbl_Border2"> <!-- details -->
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
					<td id="table1Tr4Td1" class="borderRight"></td>
					<td id="table1Tr4Td2"></td>
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
		<table id="table2HostDetails" class="tableDetails tbl_100 tbl_Border2"> <!-- options -->
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
				<!--<tr class="trImpair">
					<td id="table2Tr6Td1" class="tdDetails"></td>
					<td id="table2Tr6Td2" class="tdDetails tdCenter"></td>
					<td id="table2Tr6Td3" class="tdDetails tdCenter"></td>
				</tr>-->
			</tbody>
		</table>		
	</div>
	
	<div id="tabs-3" class="tabContent" style="display:none"> <!-- Tab3 - commands -->
		<table id="table3HostDetails" class="tableDetails tbl_100 tbl_Border2"> <!-- commands -->
			<tbody>
				<tr class="trImpair trTitre"><td id="table3Tr0Td1" class="tdDetails"></td></tr>
				<tr class="trPair"><td id="table3Tr1Td1" class="tdCommands"></td></tr>
				<tr class="trImpair">
					<td id="table3Tr2Td1" class="tdCommands">
						<a href="#popupComment" id="linkComment" data-rel="popup" data-transition="pop"></a><!-- link for popup comment -->
								
								<!-- popup comment -->
								<div data-role="popup" id="popupComment" class="ui-content div_popup" data-theme="a">
								<div id="commentContener" class="display:none">
									<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
										<br /><br/><br />
										<form id="formSearch" class="ui-field-contain">
												<input type="text" name="host_search" id="hostSearchInput" class="ui-state-disabled"value="<?php echo $_GET['host_name'];?>" data-mini="true"><br />
												<label for="checkboxPersistent"><?php echo _("Persistent");?>
												<input type="checkbox" name="checkboxPersistent" id="checkbox-mini-0" data-mini="true"></label><br />
												<label for="comment"><?php echo _("Comment");?></label>
												<textarea cols="10" rows="20" name="comment" id="comment"></textarea><br /><br />
												<input type="submit" data-mini="true" value="<?php echo _("Save");?>">
										</form>
								</div>
								</div>
								<!-- end of popup -->
								
					</td>
				</tr>
				<tr class="trPair"><td id="table3Tr3Td1" class="tdCommands"></td></tr>
				<tr class="trImpair"><td id="table3Tr4Td1" class="tdCommands"></td></tr>
				<tr class="trPair"><td id="table3Tr5Td1" class="tdCommands"></td></tr>
				<tr class="trImpair"><td id="table3Tr6Td1" class="tdCommands"></td></tr>
				<tr class="trPair"><td id="table3Tr7Td1" class="tdCommands"></td></tr>
				<tr class="trImpair"><td id="table3Tr8Td1" class="tdCommands"></td></tr>
				<tr class="trPair"><td id="table3Tr9Td1" class="tdCommands"></td></tr>
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
		<table id="table6HostDetails" class="tableDetails tbl_100 tbl_Border2"> <!-- tools -->
			<tbody>
				<tr class="trImpair tbl_100 trTitre tbl_Border2"><td id="table6Tr0Td0" class="tdDetails"></td></tr>
				<tr class="trPair">
					<td id="table6Tr1Td0" class="tdDetails">
						<a href="#popupPing" id="linkPing" data-rel="popup" data-transition="pop"></a><!-- link for ping -->
							
							<!-- popup ping -->
							<div data-role="popup" id="popupPing" class="ui-content" data-theme="a" style="max-width:350px;">
							<div id="pingResultContener" class="display:none">
								<table class="tbl_100 tableDetails tbl_Border2">
									<tr class="trImpair tbl_100  trTitre tbl_Border2"><td class="tdDetails"><?php echo $_GET['host_name'];?></td></tr>
									<tr class="trPair"><td class="tdDetails"><?php 	echo _("IP Address");
																					echo " : ";
																					echo $hostAddress;?></td>
									</tr>
									<tr><td><br /><div id="pingResult"><img src="./modules/mobile-UI/css/images/loaderb32.gif" class="loader"></img></div><br /></td></tr>
								</table>
							</div>
							</div>
							<!-- end of popup ping -->
							
					</td>
				</tr>
				<tr class="trImpair">
					<td id="table6Tr2Td0" class="tdDetails">
						<a href="#popupTracert" id="linkTracert" data-rel="popup" data-transition="pop"></a>
							<div data-role="popup" id="popupTracert" class="ui-content" data-theme="a" style="max-width:350px;"><!-- link for traceroute -->
							
							<!-- popup traceroute -->
							<div id="pingResultContener" class="display:none">
								<table class="tbl_100 tableDetails tbl_Border2">
									<tr class="trImpair tbl_100  trTitre tbl_Border2"><td class="tdDetails"><?php echo $_GET['host_name'];?></td></tr>
									<tr class="trPair"><td class="tdDetails"><?php 	echo _("IP Address");
																					echo " : ";
																					echo $hostAddress;?></td>
									</tr>
									<tr><td><br /><div id="tracertResult"><img src="./modules/mobile-UI/css/images/loaderb32.gif" class="loader"></img></div><br /></td></tr>
								</table>
							</div>
							<!-- end of popup traceroute -->
							
					</td>
				</tr>
			</tbody>
		</table>
		<table class="tbl_spacer"><tr><td></td></tr></table>
		<table class="tbl_spacer"><tr><td></td></tr></table>
		<table id="table7HostDetails" class="tableDetails tbl_100 tbl_Border2"> <!-- links -->
			<tbody>
				<tr class="trImpair tbl_100  trTitre tbl_Border2"><td id="table7Tr0Td0" class="tdDetails"></td></tr>
				<tr class="trPair"><td id="table7Tr1Td0" class="tdDetails"></td></tr>
			</tbody>
		</table>
		<table class="tbl_spacer"><tr><td></td></tr></table>
		<table class="tbl_spacer"><tr><td></td></tr></table>
		<table id="table8HostDetails" class="tableDetails tbl_100 tbl_Border2"> <!-- notifications -->
			<tbody>
				<tr class="trImpair tbl_100  trTitre tbl_Border2"><td id="table8Tr0Td0" class="tdDetails"></td></tr>
				<tr class="trPair"><td id="table8Tr1Td0" class="tdDetails"></td></tr>
				<tr class="trImpair"><td id="table8Tr2Td0" class="tdDetails"></td></tr>
			</tbody>
		</table>
	</div>
	
	<div id="tabs-5" class="tabContent" style="display:none"> <!-- Tab5 - comments -->
		<table id="table9HostDetails" class="tableDetails tbl_100 tbl_Border2"> <!-- comments -->
			<tbody>
				<tr class="trImpair tbl_100  trTitre tbl_Border2"><td id="table9Tr0Td0" class="tdDetails" colspan="5"></td></tr>
				<tr class="trImpair tbl_Border2">
					<td id="table9Tr1Td0" class="tbl_Border2"></td>
					<td id="table9Tr1Td1" class="tbl_Border2"></td>
					<td id="table9Tr1Td2" class="tbl_Border2"></td>
					<td id="table9Tr1Td3" class="tbl_Border2"></td>
					<td id="table9Tr1Td4" class="tbl_Border2"></td>
				</tr>
				<!-- append JS here (loop) -->
			</tbody>
		</table>
	</div>
</div>

</div>