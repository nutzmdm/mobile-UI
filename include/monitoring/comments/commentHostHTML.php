<!-----------------------------------------------------------------------------------------------------------------
HTML
------------------------------------------------------------------------------------------------------------------>
<?php include ("./modules/mobile-UI/include/common/htmlHeader.php");?>
<?php include ("./modules/mobile-UI/include/monitoring/comments/commentHostJS.php");?>


<div data-role="page" id="mainContentMod" data-url="mainContentMod" data-dom-cache="false">

<!-- menu -->
<?php require_once "./modules/mobile-UI/include/common/menu.php";?>	

<!-- header -->
<div data-role="header" data-theme="a">
	<a href="#menuPanel" class="ui-btn ui-icon-bullets ui-btn-icon-notext ui-corner-all" data-role="button" role="button"></a>
	<h3 style="font-size:15px">Centreon</h3>
	<div class="ui-btn-right" data-type="horizontal">
	<a href="#backButton" class="ui-btn ui-icon-arrow-l ui-btn-icon-notext ui-corner-all" data-role="button" role="button" data-rel="back"></a>
	</div>
</div>

<!-- content -->

<div id="divFormComment">
	<form action="?p=100207" method="post" name="Form" id="Form" class="ui-field-contain" data-mini="true">
		<table id="tableFormComment" class="tableDetails tbl_100 tbl_Border2">
			<tbody>
				<tr class="trImpair trTitre">
					<td id="tdFormCommentHeader" colspan="2" class="tdCommentPadding" data-mini="true"></td>
				</tr>
				<tr class="trPair">
					<td id="tdFormCommentNameHost" class="tdCommentPadding" data-mini="true"></td>
					<td class="tdCommentPadding" data-mini="true"><div id="tdFormCommentNameHostSelect" class="ui-btn ui-icon-carat-d ui-btn-icon-right ui-corner-all ui-shadow"></div></td>
				</tr>
				<tr class="trImpair">
					<td id="tdFormCommentAckPersist" class="tdCommentPadding" data-mini="true"></td>
					<td><div id="tdFormCommentAckPersistCheckbox" class="ui-checkbox tdCommentPadding" data-mini="true"></div></td>
				</tr>
				<tr class="trPair">
					<td id="tdFormCommentComment" class="tdCommentPadding" data-mini="true"></td>
					<td id="tdFormCommentCommentText" class="tdCommentPadding" data-mini="true"></td>
				</tr>
			</tbody>
		</table>
	</form>
	<div id="divValidateButton" class="ui-field-contain span-align-center" data-mini="true"></div>
	<input name="o" type="hidden" value="ah">

</div>