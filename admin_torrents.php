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
<span style='font-family: Helvetica; font-size: 24px'><?php echo $_SESSION['user_name'] ?> :: Admin Panel > Manage Torrents & Comments</b></span><br><br>
<a href="admin_users.php">Manage Users</a>&nbsp;&nbsp;|&nbsp;
Manage Torrents&nbsp;&nbsp;|&nbsp;
<a href="sent.php">Manage Comments</a>
<br />
<br />
<?php
if ($login->isUserLoggedIn() == true)
{
$MySQL = "SELECT SQL_CALC_FOUND_ROWS * FROM torrents LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . ", " . $records_per_page . "";

if (!($result = @mysql_query($MySQL))) 
{

    // stop execution and display error message
    die(mysql_error());

}

// fetch the total number of records in the table
$rows = mysql_fetch_assoc(mysql_query('SELECT FOUND_ROWS() AS rows'));

// pass the total number of records to the pagination class
$pagination->records($rows['rows']);

// give our temp string the total rows found
$totalpms = $rows['rows'];

// records per page
$pagination->records_per_page($records_per_page);

?>
<div class='torrenttable' >

<table>

<tr>
                        
						
                        <td style=''>
                            ID
                        </td>
						<td width='80'>
						    Category
						</td>
						<td style=''>
                            Torrent
                        </td>
						<td width='80'>
						    Uploader
						</td>
						<td width='190'>
						    Date
						</td>
</tr>	

<?php $index = 0?>

<?php while ($row = mysql_fetch_assoc($result)):?>		

<tr <?php echo $index++ % 2 ? ' class="even"' : ''?>>

<?php

echo "
                        
						
                        <td>
                            <a class='torrentlinks'>" .$row['id']. "</a>
                        </td>
						<td>
                            <a class='torrentlinks'>" .$row['cat']. "</a>
                        </td>	
						<td>
                            <a class='torrentlinks' href='torrent.php?id=" . $row['id'] . "'>" .$row['title']. "</a>
                        </td>	
						<td>
                            <a class='torrentlinks' href='user.php?id=" . $row['uploader'] . "'>" .$row['uploader']. "</a>
                        </td>
						<td>
                            <a class='torrentlinks'>" .$row['date']. "</a>
                        </td>
                    </tr>
				

";
?>
<?php endwhile?>

</table>
</div>
<?php
if($totalpms < 1)
{
	echo "<br />There are no messages in your inbox.";
}
echo "<div class='paginationbar'>";
$pagination->render();
echo "</div>";
}
else
{
	echo "<br><center>You need to login to visit your inbox. Please <a href='login.php'>LOGIN</a> to access your inbox and personal messages.<br /><br /></font></center>";
}
?>
<br />
<br />
<a href="./index.php">Return To Main Site</a></center>
</center>
</body>
</html>