<!--

 J-Tracker
 file: torrent.php
 purpose: torrent detail page

-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
<?php
include('include/config.php');
include('classes/Login.php');
include('classes/Registration.php');
include('classes/Functions.php');


$login = new Login();
$register = new Registration();
$functions = new jtrackerFunctions();
?>

<head>
    <title><?php echo site_name . " - Torrent Details"; ?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="skin/default/style.css"/>
	<style>
.tg td{background: #f6f1ee;font-family:Arial;font-size:14px;overflow:hidden;word-break:normal;}
	.tg  {background: #f6f1ee;border-spacing:0;}
.tg th{padding-left: 25px;background: #f6f1ee;font-family:Arial;font-size:14px;font-weight:normal;text-align: left;overflow:hidden;word-break:normal; border-bottom: 1px solid rgba(0,0,0,0.08)}
.tg .tg-yw4l{vertical-align:top}
</style>
</head>
<body>

<?php
echo "
<center>
<br>
<br>
<div class='torrenttable' >
";
     
	 
$query = mysql_query("SELECT * FROM forum_threads WHERE id='".htmlspecialchars($_GET['id'])."'")
or die("Database is currently AFK, it'll be back shortly."); 
	while($first = mysql_fetch_array($query))
	{
		echo "<div class='commentpagebg'><font style='font-size: 24px; font-family: Helvetica; padding-top: 5px; padding-left: 10px; '><br>" . $first['threadtitle'] . "<br></div>";	
	}

		
if ($login->isUserLoggedIn() == true)
{	
echo "<div class='commentpagebg'><font style='font-size: 24px; font-family: Helvetica; padding-top: 5px; padding-left: 10px; '>";	
}
else
{
echo "<div class='commentpagebg'><font style='font-size: 12px; font-family: Helvetica; padding-top: 5px; padding-left: 10px; '><br>Replies<br><i><font style='font-size: 12px;'>Login to write a reply to this thread..</font></i><br>";	
}
	echo "<table class='tg'>";
	$query2 = mysql_query("SELECT * FROM forum_post WHERE threadid='".htmlspecialchars($_GET['id'])."'") or die(mysqli_error()); 
	if (mysql_num_rows($query2) > 0)
	{
	  while($comments = mysql_fetch_array($query2))
	  {
		echo "<b<tr><th class='tg-yw4l' style='width: 128px'><div class='comment'><br>" . $functions->getUserAvatar($comments['user']) . "<p align='left' class='comment-user'>" . $functions->getUserLevel($comments['user']) . " <a href='user.php?id=" . $comments['user'] . "'>" . $comments['user'] . "</a><span style='font-size: 12px'><br><a>Posts: " . $functions->getUserPosts($comments['user']) . "</a></span><br>" . $functions->getUserCountry($comments['user']) . "</th><th class='tg-yw4l'><br><font class='timestamp'>" . $comments['date'] . " CET</b></font><br><br><span style='font-size: 12px'>" . $comments['comment'] . "</span><br><br></th></tr>";
	  }
	}
	else
	   {
	    echo "<br>";
		echo "<font style='font-size: 16px; font-family: Helvetica; padding-top: 0px; padding-left: 10px; '>- No Replys -</font>";
	   }
	   echo "</table></div></div>";

	   
if ($login->isUserLoggedIn() == true)
{
	echo "
	
	<div class='commentbox' style='width: 708px;'><br>
	Write Reply<br><br>
<form method='post' action='viewpost.php?id=" . htmlspecialchars($_GET['id']) . "' name='write_comment'>
	<textarea name='comment_text' class='commenttextarea'></textarea><br><br>
	<input type='hidden' name='torrent_id' value='" . htmlspecialchars($_GET['id']) . "' style='width: 0px; height: 0px;' />
	<input type='submit' name='addcomment' value='Reply'>
	</form><br>";
}
else
{
}
?>


</div>
<br>
<br>
<a href="./index.php">Return To Main Site</a></center>
</body>
</html>