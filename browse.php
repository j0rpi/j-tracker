<!--

 J-Tracker
 file: browse.php
 purpose: shows all torrents ever uploaded

-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include('include/config.php');
include('classes/torrent.php');
require('classes/paginator.php');

// Limit Search Results Per Page
$records_per_page = 15;

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
<?php
$MySQL = 'SELECT SQL_CALC_FOUND_ROWS * FROM torrents LIMIT ' . (($pagination->get_page() - 1) * $records_per_page) . ', ' . $records_per_page . '';

if (!($result = @mysql_query($MySQL))) 
{

    // stop execution and display error message
    die(mysql_error());

}

// fetch the total number of records in the table
$rows = mysql_fetch_assoc(mysql_query('SELECT FOUND_ROWS() AS rows'));

// pass the total number of records to the pagination class
$pagination->records($rows['rows']);

// records per page
$pagination->records_per_page($records_per_page);

?>
<div class='torrenttable' >
<table>

<tr>
                        
						<td width='110'>
                            Category
                        </td>
                        <td style=''>
                            Title
                        </td>
						<td width='80'>
						    Size
						</td>
</tr>	

<?php $index = 0?>
<?php while ($row = mysql_fetch_assoc($result)):?>		

<tr <?php echo $index++ % 2 ? ' class="even"' : ''?>>
<?php

$torrent = new Torrent( $row['link'] );
echo "
                        
						<td width='45px'>
                            <a class='torrentlinks' href='torrent.php?id=" . $row['id'] . "'>".$row['cat']."</a>
                        </td>
                        <td>
                            <a class='torrentlinks' href='torrent.php?id=" . $row['id'] . "'>".$row['title']."<br><span class='torrentsmalldetails'>Uploaded " . $row['date'] . ", by <a class='torrentsmalldetails' href='user.php?id=" . $row['uploader'] . "'>" . $row['uploader'] . "</a> [hash: " . $torrent->hash_info() . "]</span> <font style='float:right'><a class='torrentsmalldetails' href='" . $row['link'] . "' title='Download .torrent File'><img src='skin/default/img/dl_torrent.png' width='12' height='12'></a> <a class='torrentsmalldetails' href='" . $torrent->magnet() . "' title='Download Via Magnet'><img src='skin/default/img/dl_magnet.png' width='12' height='12'></font></a>
                        </td>
						<td>
						    <font class='torrentlinks' style='color: black'>" . $torrent->format($torrent->size()) . "</font>
						</td>
						
                    </tr>
				

";?>
<?php endwhile?>

</table>
</div>
<?php
echo "<div class='paginationbar'>";
$pagination->render();
echo "</div>";
?>
<br />
<br />
<a href="./index.php">Return To Main Site</a></center>
</center>
</body>
</html>