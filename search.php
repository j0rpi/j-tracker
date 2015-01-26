<!--

 J-Tracker
 file: search.php
 purpose: search page

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
    <title><?php echo site_name . " - Search results for '" . $_GET['query'] . "'"; ?></title>
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
    $query = $_GET['query']; 
     
    $min_length = 3;
     
    if(strlen($query) >= $min_length){ 
         
        $query = htmlspecialchars($query); 
         
        $query = mysql_real_escape_string($query);
         
        $raw_results = mysql_query("SELECT * FROM torrents
            WHERE (`title` LIKE '%".$query."%') OR (`description` LIKE '%".$query."%')") or die(mysql_error());
         
        if(mysql_num_rows($raw_results) > 0){ 
             
            while($results = mysql_fetch_array($raw_results)){
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
             
        }
        else{ 
            ob_end_clean();
			echo '<link rel="stylesheet" type="text/css" href="skin/default/style.css"/>';
        echo "<font style='font-size: 18px; font-family: Arial;'><center><font style='font-size: 18px; font-family: Arial;'><img src='skin/default/" . site_logo . "'/><br><b>". site_name . "</b></font><br>";
		echo "<br>No results returned for keyword '". $query . "'</font>";
        }
         
    }
    else{ 
        ob_end_clean();
		echo '<link rel="stylesheet" type="text/css" href="skin/default/style.css"/>';
        echo "<font style='font-size: 18px; font-family: Arial;'><center><font style='font-size: 18px; font-family: Arial;'><img src='skin/default/" . site_logo . "'/><br><b>". site_name . "</b></font><br>";
		echo "<br>Please supply a keyword that's at least ".$min_length." characters long.</font>";
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