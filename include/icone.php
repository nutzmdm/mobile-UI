<?php


//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------------

$icon_host_path = $_GET['HostIconPath'];
$ext_icon_info = pathinfo($icon_host_path, PATHINFO_EXTENSION);

$width_template_icon_resampled = $_GET['IconSize'];
$height_template_icon_resampled = $_GET['IconSize'];
$width_host_icon_resampled = $width_template_icon_resampled / 1.5;
$height_host_icon_resampled = $height_template_icon_resampled / 1.5;

if ($icon_host_path != null)
	{
		//header pour un icone en png
		header ("Content-type: image/png");

		// On charge d'abord les images
		$template_icon = imagecreatefrompng('img/icon-template.png'); // Le template
		if ($ext_icon_info == "png")
			{$host_icon = imagecreatefrompng('../../../img/media/'.$icon_host_path.'');} // L'icone si elle est en png
		elseif (($ext_icon_info == "jpg") or ($ext_icon_info = 'jpeg'))
			{$host_icon = imagecreatefromjpeg('../../../img/media/'.$icon_host_path.'');} // L'icone si elle est en jpg
		elseif ($ext_icon_info == "gif")
			{$host_icon == imagecreatefromgif('../../../img/media/'.$icon_host_path.'');} // L'icone si elle est en gif
			
		// On crée les images qui nous serviront à redéfinir la taille
		$template_icon_resampled = imagecreatetruecolor($width_template_icon_resampled, $height_template_icon_resampled);
		$host_icon_resampled = imagecreatetruecolor($width_host_icon_resampled, $height_host_icon_resampled); 

		//On applique la conservation de la transparence aux images importées
		imagealphablending($template_icon,false);
		imagesavealpha($template_icon,true);
		imagealphablending($host_icon,false);
		imagesavealpha($host_icon,true);

		//On rend les images vides transparentes
		imagealphablending($template_icon_resampled,false);
		$black1 = imagecolorallocate($template_icon_resampled,0,0,0);
		imagefill($template_icon_resampled,0,0,$black1);
		imagecolortransparent($template_icon_resampled,$black1);

		imagealphablending($host_icon_resampled,false);
		$black2 = imagecolorallocate($host_icon_resampled,0,0,0);
		imagefill($host_icon_resampled,0,0,$black2);
		imagecolortransparent($host_icon_resampled,$black2);

		//On stocke les tailles des images
		$largeur_template = imagesx($template_icon);
		$hauteur_template = imagesy($template_icon);
		$largeur_host_icon = imagesx($host_icon);
		$hauteur_host_icon = imagesy($host_icon);
		$largeur_template_icon_resampled = imagesx($template_icon_resampled);
		$hauteur_template_icon_resampled = imagesy($template_icon_resampled);
		$largeur_host_icon_resampled = imagesx($host_icon_resampled);
		$hauteur_host_icon_resampled = imagesy($host_icon_resampled);

		//On applique la conservation de la transparence aux images crées
		imagealphablending($template_icon_resampled,false);
		imagesavealpha($template_icon_resampled,true);
		imagealphablending($host_icon_resampled,false);
		imagesavealpha($host_icon_resampled,true);

		//On fixe la taille du template à celle définie et on harmonise la taille des icones
		imagecopyresampled($template_icon_resampled, $template_icon, 0, 0, 0, 0, $largeur_template_icon_resampled, $hauteur_template_icon_resampled, $largeur_template, $hauteur_template);
		imagecopyresampled($host_icon_resampled, $host_icon, 0, 0, 0, 0, $largeur_host_icon_resampled, $hauteur_host_icon_resampled, $largeur_host_icon, $hauteur_host_icon);

		// Calcul des coordonnées ou placer l'icone, ici, elle sera centrée
		$destination_x = $largeur_template_icon_resampled/2 - $largeur_host_icon_resampled/2;
		$destination_y =  $hauteur_template_icon_resampled/2 - $hauteur_host_icon_resampled/2;

		// On met l'icone redimensionné dans l'image de destination (le template)
		imagecopymerge($template_icon_resampled, $host_icon_resampled, $destination_x, $destination_y, 0, 0, $largeur_template_icon_resampled, $hauteur_template_icon_resampled, 60);

		// On affiche l'image de destination qui a été fusionnée avec le logo
		imagepng($template_icon_resampled);
	}
elseif ($_GET['hst'] = 1)
	{
	exit();
	}
elseif ($_GET['svce'] = 1)
	{
	exit();
	}
else {exit();}
?>