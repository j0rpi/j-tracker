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
include('classes/Registration.php');
require('classes/paginator.php');


// Limit Search Results Per Page
$records_per_page = 15;

$functions = new Registration();

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
<a href="index.php" class="a" style="float: left; border-bottom: 0px solid lol;"><img src="skin/default/img/logo.png" width="64" height="64" id="" alt="" class="topbar-logo"></a>
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
$MySQL = 'SELECT SQL_CALC_FOUND_ROWS * FROM forum_cats LIMIT ' . (($pagination->get_page() - 1) * $records_per_page) . ', ' . $records_per_page . '';

if (!($result = @mysql_query($MySQL))) 
{

    // stop execution and display error message
    die("GAY");

}

// fetch the total number of records in the table
$rows = mysql_fetch_assoc(mysql_query('SELECT FOUND_ROWS() AS rows'));

// pass the total number of records to the pagination class
$pagination->records($rows['rows']);

// records per page
$pagination->records_per_page($records_per_page);

?>
<div class='torrenttable' style="width: 500px">
<table>

<tr>
                        
						<td width='110'>
                            Category
                        </td>
                        <td style=''>
                            Description
                        </td>
						<td style=''>
							Latest Topic
						</td>
</tr>	

<?php $index = 0?>
<?php while ($row = mysql_fetch_assoc($result)):?>		

<tr <?php echo $index++ % 2 ? ' class="even"' : ''?>>
<?php
echo "
                        
						<td width='45px'>
                            <a class='torrentlinks' href='cat.php?id=" . $row['catid'] . "'>".$row['catname']."</a>
                        </td>
                        <td>"
							. $row['catdesc'] . "
                            
                        </td>
						<td>
						
                    </tr>
					
				

"; ?>
<?php endwhile?>

</table>
</div>
<?php
echo "<div class='paginationbar'>";
$pagination->render();
echo "</div>";
?>
<br />
<br /><br>
<a href="./index.php">Return To Main Site</a></center>
</center>
</body>
</html>