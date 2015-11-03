<!-----------------------------------------------------------------------------------------------------------------
HTML
------------------------------------------------------------------------------------------------------------------>
<?php include ("./modules/mobile-UI/include/common/htmlHeader.php");?>
<?php include ("./modules/mobile-UI/include/monitoring/hosts/monitoringHostMainJS.php");?>


<div data-role="page" id="mainContentMod" data-url="mainContentMod" data-dom-cache="false">

<!-- menu -->
<?php require_once "./modules/mobile-UI/include/common/menu.php";?>	

<!-- header -->
<div data-role="header" data-theme="a">
	<a href="#menuPanel" class="ui-btn ui-icon-bullets ui-btn-icon-notext ui-corner-all" data-role="button" role="button"></a>
	<h3 style="font-size:15px">Centreon</h3>
	<div class="ui-btn-right" data-type="horizontal">
	<a href="#popupSearch" id="searchButton" data-rel="popup" class="ui-btn ui-icon-search ui-btn-icon-notext ui-corner-all" data-role="button" role="button" data-transition="pop" data-position-to="window"></a>
	<a href="#backButton" class="ui-btn ui-icon-arrow-l ui-btn-icon-notext ui-corner-all" data-role="button" role="button" data-rel="back"></a>
	</div>
</div>

<!-- content -->

<div data-role="popup" id="popupSearch" class="div_popup"><!-- popup search -->
	<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
	<div id="searchPopup" class="ui-field-contain">
		<form id="formSearch" class="ui-field-contain">
			<input type="hidden" name="p" value="<?php echo $_GET["p"]?>">
			<input type="hidden" name="o" value="<?php echo $_GET["o"]?>">
			<input type="hidden" name="limit" value="<?php echo $_GET["limit"]?>">
			<input type="hidden" name="num" value="0">
			<label id="hostSearchInputLabel" for="hostSearchInput" data-mini="true" ></label>
				<input type="search" name="host_search" id="hostSearchInput" value="<?php echo $monitoringHostSearch;?>" data-mini="true">
			<br />
			<label id="statusSearchSelectLabel" for="statusSearchSelect" class="select"></label>
				<select name="statusFilter" id="statusSearchSelect" data-mini="true" data-inline="true"></select>
			<!--<br /><br />
			<label id="collectorSearchSelectLabel" for="collectorSearchSelect" class="select"></label>
				<select name="select_instance" id="collectorSearchSelect" data-mini="true" data-inline="true"></select>
			<br /><br />
			<label id="hostgroupSearchSelectLabel" for="hostgroupSearchSelect" class="select"></label>
				<select name="hostgroups" id="hostgroupSearchSelect" data-mini="true" data-inline="true"></select><br />-->
			<br /><br />
			<input type="submit" value="<?php echo _("Search");?>">
			<br />
		</form>
		<form id="formReset" class="ui-field-contain">
			<input type="hidden" name="p" value="<?php echo $_GET["p"]?>">
			<input type="hidden" name="o" value="<?php echo $_GET["o"]?>">
			<input type="hidden" name="limit" value="<?php echo $_GET["limit"]?>">
			<input type="hidden" name="num" value="0">
			<?php 	unset ($_SESSION['centreon']->historySearch);?>
			<!--<input type="hidden" name="statusFilter" value="">-->
			<!--<input type="hidden" name="select_instance" value='""'>
			<input type="hidden" name="hostgroups" value='""'>-->
			<input type="submit" value="<?php echo _("reset");?>">
		</form>
	</div>
</div>

<div data-role="content" class="ui-content">

	<table id="path" class="tblPath">
		<tr>
			<td id="pathImg1"></td>
			<td id="pathItem1" class="pathItem"></td>
			<td id="pathImg2"></td>
			<td id="pathItem2" class="pathItem"></td>
			<?php
			if (isset($monitoringHostSearch)){
				echo '<td>';
				echo _('(filtered results)');
				echo '</td>';}
			?>
		</tr>
	</table>
	<div id="content" data-role="content" class="ui-content">
		<div id="pagination" class="div-align-center"></div>
		<ul id="showHost" data-role="listview" data-corners="false" data-inset="true"></ul>
	</div>
</div>

</div>