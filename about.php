<!--

 J-Tracker
 file: about.php
 purpose: it's what you think it is..

-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include('include/config.php');
?>

<head>
    <title><?php echo site_name . " - Legal Information"; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="skin/default/style.css"/>
</head>
<body>
<div class="topbar">
<form action="search.php" id="search" method="get">
<a href="index.php" class="a" style="float: left; border-bottom: 0px solid lol;"><img src="skin/default/img/logo.png" width="64" height="64" id="" alt="" class="topbar-logo"></a><br />
<a href="index.php" title="Search Torrents">Search Torrents</a>&nbsp;&nbsp;|&nbsp;
<a href="browse.php?p=0" title="Browse Torrents">Browse Torrents</a>&nbsp;&nbsp;|&nbsp;
<a href="#" title="Recent Torrent">Recent Torrents</a>
<br><br><input type="search" class="search" required="" name="query" value=""> <input value="Search" type="submit" class="submitbutton"><br>
<input type="hidden" name="page" value="0">
<input type="hidden" name="orderby" value="99">
</form>
</div>
<center>
<br>
<br>
<div class='torrenttable' >

					<center>
					<div class='legalpage'>
				<br />
				This site is powered by the free and legal software <b><a href="https://github.com/j0rpi/j-tracker">J-Tracker</b></a><br /><br />
				<br />
				torrent-rw by <a href="https://github.com/adriengibrat"><b>adriengibrat</b></a><br />
				php-login by <a href="http://www.php-login.net"><b>The PHP-Login Project</b></a><br />
				OpenPGP by <a href="https://github.com/Sassoft/OpenPGP"><b>PhpStorm</b></a><br />
				<br />
                    
</div>
			


</div>
<br>
<br>
<a href="./index.php">Return To Main Site</a></center>
</body>
</html>