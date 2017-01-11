<!--

 J-Tracker
 file: viewarticle.php
 purpose: display selected blog post

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

$login = new Login();
$register = new Registration();
?>

<head>
    <title><?php echo site_name . " - Torrent Details"; ?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="skin/default/style.css"/>
</head>
<body>

<?php
echo "
<center>
<br>
<br>
<div class='torrenttable' >
";
     
	 
$query = mysql_query("SELECT * FROM blogposts WHERE id='".htmlspecialchars($_GET['id'])."'")
or die("Database is currently AFK, it'll be back shortly."); 
             
            while($results = mysql_fetch_array($query))
			{
				
                echo 
				"<strong>" .$results['title']. "</strong><br><br><textarea style='border: none; width: 99%; height: 300px;     font-family: Verdana, Arial, Helvetica, sans-serif;'>" .
				$results['text'] . 
				"</textarea>
                Written by: " . $register->getUserLevel('System') . " <a>System</a></div><br><br>";   
            }
		
if ($login->isUserLoggedIn() == true)
{	
echo "<div class='commentpagebg'><font style='font-size: 24px; font-family: Helvetica; padding-top: 5px; padding-left: 10px; '<br>";	
}
else
{
echo "<div class='commentpagebg'><font style='font-size: 24px; font-family: Helvetica; padding-top: 5px; padding-left: 10px; '><br>Comments<br><i><font style='font-size: 12px;'>Login to write a comment ...</font></i><br>";	
}

	$query2 = mysql_query("SELECT * FROM blogcomments WHERE id='".htmlspecialchars($_GET['id'])."'") or die(mysqli_error()); 
	if (mysql_num_rows($query2) > 0)
	{
	  while($comments = mysql_fetch_array($query2))
	  {
		echo "<p align='left' class='comment-user'><strong style='font-size: 10px'>#" . $comments['id'] . "</strong>" . $register->getUserLevel($comments['user']) . " <a style='font-size: 10px;' href='user.php?id=" . $comments['user'] . "'>" . $comments['user'] . "</a> - <font class='timestamp' style='font-size: 10px;'>" . $comments['time'] . " CET</b></font><div class='comment'>" . $comments['text'] . "<br></div>";
	  }
	}
	else
	   {
	    echo "<br>";
		echo "<p align='left' class='comment-user'><font style='text-align: center; font-size: 12px; font-family: Helvetica; padding-top: 0px; padding-left: 10px; '><strong>- No comment on this blog article. -</strong></font></p>";
	   }
	   echo "</div>";

	   
if ($login->isUserLoggedIn() == true)
{
	echo "
	
	<div class='commentbox'><br>
	Write New Comment
<form method='post' action='viewarticle.php?id=" . htmlspecialchars($_GET['id']) . "' name='write_comment'>
	<textarea name='comment_text' class='commenttextarea'></textarea><br><br>
	<input type='hidden' name='torrent_id' value='" . htmlspecialchars($_GET['id']) . "' style='width: 0px; height: 0px;' />
	<input type='submit' name='addblogcomment' value='Add Comment'>
	</form><br>";
}
else
{
}
?>


</div>
<br>
<br>
<a href="../index.php">Return To Main Site</a></center>
</body>
</html>