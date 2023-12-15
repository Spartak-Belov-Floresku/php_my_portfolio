<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
<title>Spartak web programmer | Asheville, NC</title>
<meta name="description" content="SPARTAK WEB DEVELOPER ASHEVILLE, SPARTAN WEB DEVELOPER ASHEVILLE, SPARTAN ASHEVILLE, SPARTAK ASHEVILLE, SPARTAN USA, SPARTAN USA, SPARTAK US, SPARTAN US, NC BACKEND AND FRONTEND DEVELOPMENT  PHP, JAVA, JAVASCRIPT" />
<meta name="keywords" content="PHP, JAVA, JAVASCRIPT, CSS, CSS3, HTML, HTML5, WEB DEVELOPMENT, WEB PROGRAMMER, PHP DEVELOPER, JAVA EE DEVELOPER, JAVASCRIPT DEVELOPER, PHP ENGINEER, JAVA ENGINEER, JAVASCRIPT ENGINEER, PROGRAMMER ENGINEER, ASHEVILLE, SPARTAK" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<link href="images/codes.png" sizes="192x192" rel="icon" />

<link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet' type='text/css'>
<link href="https://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
<?php CssAndJsFilesConnector::writepath("css");?>

<?php CssAndJsFilesConnector::writepath("js");?>

<!--[if lt IE 9]>
	<script src="js\shiv.js"></script>
<![endif]-->
</head>
<body>
<div id="startloader"></div>
<div id="container" class="<?php echo $class;?>">
	<header id="header">
		<div class="logo">
		<a href="."><img src="images/codes.png" alt="technology"/><span>SP</span></a>
		</div>
		<div id="drivemenu" onclick="popUpMenu();">
		<p></p>
		<p></p>
		<p></p>
		</div>
		<?php GetMenu::getMenu("menu.xml", $class, 'desktop'); ?>
		<?php GetMenu::getMenu("menu.xml", $class, 'mobile'); ?>
		<div class="clear"></div>
	</header>
	