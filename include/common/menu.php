<div data-role="panel" id="menuPanel" data-theme="a" data-display="overlay" data-inset="true">
	<div data-role="content"><h1>menu</h1></div>
		<ul data-role="listview" data-theme="a" data-corners="false" data-inset="true">
			<li><a href="./main.php?p=10">Accueil</a></li>
		</ul>
                <div data-role="collapsible" data-inset="true" data-iconpos="right"  data-theme="a">
                     <h3>H&ocirc;tes</h3>
                        <ul data-role="listview" data-theme="b">
							<li><a href="./main.php?p=100201&o=h_unhandled&limit=10&num=0"><?php echo _("Not Acknowledged")?></a></li>
							<li><a href="./main.php?p=100202&o=hpb&limit=10&num=0"><?php echo _("Hosts Problems")?></a></li>
							<li><a href="./main.php?p=100203&o=h&limit=10&num=0"><?php echo _("Hosts")?></a>
							<li><a href="./main.php?p=100204"><?php echo _("All Hostgroups")?></a>
						</ul>
				</div>
				<div data-role="collapsible" data-inset="true" data-iconpos="right" data-theme="a">
                     <h3>Services</h3>
                        <ul data-role="listview" data-theme="b">
							<li><a href="./main.php?p=100301&o=svc_unhandled&limit=10&num=0"><?php echo _("Not Acknowledged")?></a></li>
							<li><a href="./main.php?p=100302&o=svcpb&limit=10&num=0"><?php echo _("Services Problems")?></a></li>
							<li><a href="./main.php?p=100303&o=svc&limit=10&num=0"><?php echo _("All Services")?></a>
						</ul>
				</div>
		<ul data-role="listview" data-theme="a" data-corners="false" data-inset="true">
			<li><a href="./main.php?p=1005"><?php echo _("Options")?></a></li>
		</ul>
		<br />
		<ul data-role="listview" data-theme="a" data-corners="false" data-inset="true" data-icon="delete">
			<li><a href="./index.php?disconnect=1">Disconnect</a></li>
		</ul>
</div>