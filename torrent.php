<!--

 J-Tracker
 file: torrent.php
 purpose: torrent detail page

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
";
     

$query = mysql_query("SELECT * FROM torrents WHERE id='".htmlspecialchars($_GET['id'])."'")
or die(mysql_error()); 
             
            while($results = mysql_fetch_array($query)){
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
                           Uploader: ".$results['uploader']."
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
					</div>
				";   
            }
?>


</div>
<br>
<br>
<a href="./index.php">Return To Main Site</a></center>
</body>
</html>