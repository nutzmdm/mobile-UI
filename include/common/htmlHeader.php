<?php
require_once ("header.php");

if 		($theme == 2){include("htmlMaterialThemeHeader.html");}
elseif 	($theme == 3){include("htmlWPThemeHeader.html");}
else {include("htmlDefaultThemeHeader.html");}

?>