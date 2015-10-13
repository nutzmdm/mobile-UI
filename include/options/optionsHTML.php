<!-----------------------------------------------------------------------------------------------------------------
HTML
------------------------------------------------------------------------------------------------------------------>
<?php include ("./modules/mobile-UI/include/common/htmlHeader.php");?>
<?php include ("./modules/mobile-UI/include/options/optionsJS.php");?>


<div data-role="page" id="mainContentMod" data-url="mainContentMod" data-dom-cache="false">

<!-- menu -->
<?php require_once "./modules/mobile-UI/include/common/menu.php";?>	

<!-- header -->
<div data-role="header" data-theme="a">
	<h3 style="font-size:15px">Centreon</h3>
	<a href="#menuPanel" class="ui-btn ui-icon-bullets ui-btn-icon-notext ui-corner-all" data-role="button" role="button"></a>
	<a href="#backButton" class="ui-btn ui-icon-arrow-l ui-btn-icon-notext ui-corner-all" data-role="button" role="button" data-rel="back"></a>
</div>

<!-- /content -->

<div data-role="content" class="ui-content">

	<table id="path" class="tblPath">
		<tbody>
			<tr>
				<td id="pathImg1"><img src="./img/icones/8x14/pathWayBlueStart.gif"></td>
				<td id="pathItem1" class="pathItem"><a href="#"><?php echo _("Options")?></a></td>
			</tr>
		</tbody>
	</table>

	<br />
	Version 2.1
	<br />
	<br />
	
	<form action="main.php?p=1005" method="post">
		<fieldset>
			<legend><h2>General :</h2><br /></legend>
			<label for="tempoScripts"><h5>Javascript tempo
											<a href="#popupInfoTempo" data-rel="popup" data-transition="pop" class="my-tooltip-btn ui-btn ui-alt-icon ui-nodisc-icon ui-btn-inline ui-icon-info ui-btn-icon-notext" title="Learn more">Learn more</a></p>
												<div data-role="popup" id="popupInfoTempo" class="ui-content" data-theme="a" style="max-width:350px;">
												<p>Here you can change the Javascript timer. This is useful in case of slow connection or slow server. 
												The default value (2) should be suitable in most cases.</p>
												</div>
									</h5>				
			</label>
			<input type="range" name="tempoScripts" id="slider-1" min="0" max="20" value="<?php echo $tempoScripts;?>" data-popup-enabled="true">
		</fieldset>
		<br /><br /><br />
		<fieldset>
		<legend><h2>Display options :</h2><br /></legend>
			<label for="pageLimit"><h5>Page limit
										<a href="#popupInfoPageLimit" data-rel="popup" data-transition="pop" class="my-tooltip-btn ui-btn ui-alt-icon ui-nodisc-icon ui-btn-inline ui-icon-info ui-btn-icon-notext" title="Learn more">Learn more</a></p>
												<div data-role="popup" id="popupInfoPageLimit" class="ui-content" data-theme="a" style="max-width:350px;">
												<p>Here you can change the page limit value. With the default value (10), 10 hosts are shown on each host state page.</p>
												</div>
									</h5>
			</label>
			<input type="range" name="pageLimit" id="slider-2" min="5" max="100" value="<?php echo $pageLimit;?>" data-popup-enabled="true">
			<table class="tbl_100">
			<tr>
				<td class="tbl-align-left">
					<label for="syslogModDisplay"><h5>Syslog module &rarr;</h5></label>
				</td>
				<td class="tbl-align-right tdFlip">
					<select name="syslogModDisplay" id="flip-1" data-role="slider" disabled="disabled">
						<option value="off">Off</option>
						<option value="on">On</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="tbl-align-left">
				<label for="nagvisModDisplay"><h5>Nagvis module &rarr;</h5></label>
				</td>
				<td class="tbl-align-right tdFlip">
					<select name="nagvisModDisplay" id="flip-2" data-role="slider" disabled="disabled">
						<option value="off">Off</option>
						<option value="on">On</option>
					</select>
				</td>
			</tr>
			</table>
		</fieldset>
		<div class="div-align-center">
			<input type="submit" name="update" value="Enregistrer">
		</div>
	</form>
	

</div>

</div>