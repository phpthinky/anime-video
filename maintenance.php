<?php $ini = parse_ini_file("config.ini.php", true);


if($ini['installation']['maintenance'] == 'off'){
	header("Location: index.php");
} ?><!DOCTYPE html>
<html>
<head>
	<title>System Maintenance</title>
        <link rel="shortcut icon" href="public/images/logo-only-icon.png"/>
</head>
<body>
<h1>Our System is under maintenance.</h1>
<p>Please try again later.</p>
<p>Contact us: info@coloftech.com</p>
</body>
</html>