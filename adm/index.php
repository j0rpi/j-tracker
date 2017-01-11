<!--

 J-Tracker
 file: inbox.php
 purpose: shows all recieved pm's

-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include('include/config.php');
require('classes/paginator.php');
include('classes/Login.php');
include('classes/Registration.php');



$login = new Login();
$register = new Registration();

if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo $message;
        }
    }
}

// Limit Search Results Per Page
$records_per_page = 2;

// Define Pagination Class
$pagination = new Zebra_Pagination();
?>

<head>
    <title><?php echo site_name . " - Browsing Torrents "; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="skin/default/style.css"/>
	<link rel="stylesheet" type="text/css" href="skin/default/pagination.css" />
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
<span style='font-family: Helvetica; font-size: 24px'>Admin Control Panel<br><i><font style="font-size: 12px">site is running in normal mode</i><br>
<br>
<nav>
<img src="skin/default/img/user.png" style="vertical-align: middle;" /> Manage Users |
<img src="skin/default/img/torrent.png" style="vertical-align: middle;" /> Manage Torrents |
<img src="skin/default/img/comments.png" style="vertical-align: middle;" /> Manage Comments |
<img src="skin/default/img/blog.gif" style="vertical-align: middle;" /> Manage Blog |
<img src="skin/default/img/server.png"style="vertical-align: middle;"  /> Manage System 
</nav>
<br>
<b>jtracker version:</b> <?php echo version ?><br>
<div class="torrentpagebg" style="width: 200px; height: 125px; padding:10px">
<b>server info:</b><br>host: <?php echo dbhost . "<br>database: " . dbname . "<br>avatar size usage:</b> N/A<br>modules (loaded, usage):</b> 0 / 0<br>install date: unknown<br><br><span style='font-size: 10px'><i><b>Note:</b> 
These stats may or may not work depending on server OS."?>
</div>
</font></b></span>
<br />
<br />
<div class='torrenttable' style="width: 400px; text-overflow: clip;" >
</div>
<br />
<br />
<a href="./index.php">Return To Main Site</a></center>
</center>
</body>
</html>