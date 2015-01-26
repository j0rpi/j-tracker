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

    mysql_connect(dbhost, dbuser, dbpass) or die("Error connecting to database: ".mysql_error());
    mysql_select_db(dbname) or die(mysql_error());

?>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="skin/default/style.css"/>
</head>
<body>
<?php
echo "
<center>
<font style='font-size: 18px; font-family: Arial;'><img src='skin/default/" . site_logo . "'/><br><b>". site_name . "</b></font><br>
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
                            Uploader
                        </td>
                    </tr>
";
     

$query = mysql_query("SELECT * FROM torrents WHERE uploader='".htmlspecialchars($_GET['id'])."'")
or die(mysql_error()); 
             
            while($results = mysql_fetch_array($query)){
                echo 
				"
                        <td>
                            <a class='torrentlinks' href='torrent.php?id=" . $results['id'] . "'>".$results['id']."</a>
                        </td>
						<td>
                            <a class='torrentlinks' href='torrent.php?id=" . $results['id'] . "'>".$results['cat']."</a>
                        </td>
                        <td>
                            <a class='torrentlinks' href='torrent.php?id=" . $results['id'] . "'>".$results['title']."<br><span class='torrentsmalldetails'>Uploaded by <a href='user.php?id=". $results['uploader'] . "'>" . $results['uploader'] . "</a></a>
                        </td>
                        <td>
                            <a class='torrentlinks' href='user.php?id=" . $results['id'] . "'>".$results['uploader']."</a>
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