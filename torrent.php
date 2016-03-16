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
include('classes/torrent.php');

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
     
	 
$query = mysql_query("SELECT * FROM torrents WHERE id='".htmlspecialchars($_GET['id'])."'")
or die("Database is currently AFK, it'll be back shortly."); 
             
            while($results = mysql_fetch_array($query))
			{
				$torrent = new Torrent( $results['link'] );
                echo 
				"
				<table >
                    <tr>

		               <td colspan='3' >"
					   .$results['title']."
                       </td>
                    </tr>
                        
						<td>
                           Torrent ID: ".$results['id']."
                        </td>
						<td>
                           Category: ".$results['cat']."
                        </td>
                        <td>
                           Uploader: <a href='user.php?id=".$results['uploader']."'>" . $results['uploader'] . "
                        </td>
	 
                    </tr>
					</table>
					</center>
					<center>
					<div class='torrentpagebg'><br>
				<textarea class='torrentdescription' disabled=''>"
					.$results['description'].
					"
                    </textarea>
					<br />
					<div style='float:left; margin-left: 15px;'><a class='torrentdl' href='" . $results['link'] . "'><font class='torrentdl'><img width='16' height='16' src='skin/default/img/dl_torrent.png'  /> Download Torrent</font></a> or <a class='torrentdl' href=' " . $torrent->magnet() . "'><img width='16' height='16' src='skin/default/img/dl_magnet.png' style='vertical-align: middle; margin-bottom: 3px' /> Download Magnet</a><br /></div>
					</div>
					
<br />					
				";   
            }
		
if ($login->isUserLoggedIn() == true)
{	
echo "<div class='commentpagebg'><font style='font-size: 24px; font-family: Helvetica; padding-top: 5px; padding-left: 10px; '><br>Comments<br>";	
}
else
{
echo "<div class='commentpagebg'><font style='font-size: 24px; font-family: Helvetica; padding-top: 5px; padding-left: 10px; '><br>Comments<br><i><font style='font-size: 12px;'>Login to write a comment ...</font></i><br>";	
}

	$query2 = mysql_query("SELECT * FROM comments WHERE id='".htmlspecialchars($_GET['id'])."'") or die(mysqli_error()); 
	if (mysql_num_rows($query2) > 0)
	{
	  while($comments = mysql_fetch_array($query2))
	  {
		echo "<p align='left' class='comment-user'><a href='user.php?id=" . $comments['user'] . "'>" . $comments['user'] . "</a> - <font class='timestamp'>" . $comments['time'] . " CET</b></font><div class='comment'>" . $comments['text'] . "<br></div>";
	  }
	}
	else
	   {
	    echo "<br>";
		echo "<font style='font-size: 16px; font-family: Helvetica; padding-top: 0px; padding-left: 10px; '>- No Comments For This Torrent -</font>";
	   }
	   echo "</div>";

	   
if ($login->isUserLoggedIn() == true)
{
	echo "
	
	<div class='commentbox'><br>
	Write New Comment
<form method='post' action='torrent.php?id=" . htmlspecialchars($_GET['id']) . "' name='write_comment'>
	<textarea name='comment_text' class='commenttextarea'></textarea><br><br>
	<input type='hidden' name='torrent_id' value='" . htmlspecialchars($_GET['id']) . "' style='width: 0px; height: 0px;' />
	<input type='submit' name='addcomment' value='Add Comment'>
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