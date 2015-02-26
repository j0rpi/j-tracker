<!--

 J-Tracker
 file: user.php
 purpose: user page

-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include('include/config.php');
include('classes/torrent.php');
?>

<head>
    <title><?php echo site_name . " - User Details"; ?></title>
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
<?php
echo "
<center>
<br>
<br>
<div class='torrenttable' >
<center>
<span style='font-family: Helvetica; font-size: 24px'>Search Result For User <b>" .htmlspecialchars($_GET['id']). "</b></span><br><br>
<center>
<table >
<tr>
                        <td>
                            #
                        </td>
						<td >
                            Category
                        </td>
                        <td >
                            Title
                        </td>
                        <td>
                            Size
                        </td>
                    </tr>
";
     

$query = mysql_query("SELECT * FROM torrents WHERE uploader='".htmlspecialchars($_GET['id'])."'")
or die(mysql_error()); 
             
            while($results = mysql_fetch_array($query)){
				$torrent = new Torrent( $results['link'] );
                echo 
				"
                        <td>
                            <a class='torrentlinks' href='torrent.php?id=" . $results['id'] . "'>".$results['id']."</a>
                        </td>
						<td>
                            <a class='torrentlinks' href='torrent.php?id=" . $results['id'] . "'>".$results['cat']."</a>
                        </td>
                        <td>
                            <a class='torrentlinks' href='torrent.php?id=" . $results['id'] . "'>".$results['title']."<br><span class='torrentsmalldetails'>Uploaded " . $results['date'] . ", by <a class='torrentsmalldetails' href='user.php?id=" . $results['uploader'] . "'>" . $results['uploader'] . "</a> [hash: " . $torrent->hash_info() . "]</span> <font style='float:right'><a class='torrentsmalldetails' href='" . $results['link'] . "' title='Download .torrent File'><img src='skin/default/img/dl_torrent.png' width='12' height='12'></a> <a class='torrentsmalldetails' href='" . $torrent->magnet() . "' title='Download Via Magnet'><img src='skin/default/img/dl_magnet.png' width='12' height='12'></font></a>
                        </td>
                        <td>
                            <font class='torrentlinks' style='color: black'>" . $torrent->format($torrent->size()) . "</font>
                        </td>
                    </tr>
				
				";   
            }
?>

</table>
</div>
<br>
<br>
<a href="./index.php">Return To Main Site</a></center>
</center>
</body>
</html>