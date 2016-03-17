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
<br>";

if ($login->isUserLoggedIn() == true)
{
echo "
<div class='torrenttable' style='width: 600px'>";

     
	 
$query = mysql_query("SELECT * FROM pms WHERE id='".htmlspecialchars($_GET['id'])."'")
or die("Database is currently AFK, it'll be back shortly."); 
             
            while($results = mysql_fetch_array($query))
			{
				
                echo 
				"
				<table >
                    <tr>

		               <td colspan='3' ><b>"
					   .$results['title']."</b> from <b>" . $results['sender'] . "</b> - " . $results['date'] . "
                       </td>
                    </tr>
                        
					</table>
					</center>
					<center>
					<div class='torrentpagebg'  style='width: 600px; height: 350px'><br>
					<font style='float: left; margin-left: 12px;'><b>Message</b></font><br /><br />
				<textarea class='torrentdescription' disabled='' style='background: rgba(0,0,0,0.02); height: 100px'>"
					.$results['message'].
					"
                    </textarea>
					<br /><br />
					<font style='float: left; margin-left: 12px;'><b>Reply</b></font><br /><br />
					<form action='readpm.php' method='post'>
<textarea class='torrentdescription' name='message' style='height: 100px'>	
</textarea>
<input type='hidden' name='title' value='" . $results['title'] . "'>
<input type='hidden' name='sender' value='" . $_SESSION['user_name'] . "'>
<input type='hidden' name='reciever' value='" . $results['sender'] . "'><br />
<input type='submit' name='sendpm' value='Reply' style='float: right; margin-right: 12px'>
</form>


</div>";
			}
}
else
{
	echo "You need to login to read your messages. Click <a href='login.php'>HERE</a> to login.<br />";
}
?>
<br>
<br>
<a href="./index.php">Return To Main Site</a></center>
</body>
</html>