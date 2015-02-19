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
include('include/pData.class');  
include('include/pChart.class');
?>

<head>
    <title><?php echo site_name ?> - Statistics</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="skin/default/style.css"/>
</head>
<body>
<?php
echo "
<center>
<font style='font-size: 18px; font-family: Arial;'><img src='skin/default/" . site_logo . "'/><br><b>Site Statistics</b></font><br>
<br>
<br>";
         
       $torrents = mysql_query("SELECT * FROM torrents") or die(mysql_error());
	   $users = mysql_query("SELECT * FROM users") or die(mysql_error());
		
		// Dataset definition   
       $DataSet = new pData;  
       $DataSet->AddPoint(array(mysql_num_rows($users), mysql_num_rows($torrents)),"Serie1");  
       $DataSet->AddPoint(array("Users", "Torrents"),"Serie2");  
       $DataSet->AddAllSeries();  
       $DataSet->SetAbsciseLabelSerie("Serie2");  
  
       // Initialise the graph  
       $Test = new pChart(300,200);   
       $Test->drawFilledRoundedRectangle(7,7,293,193,5,240,240,240);  
       $Test->drawRoundedRectangle(5,5,295,195,5,230,230,230);  
  
       // This will draw a shadow under the pie chart  
       $Test->drawFilledCircle(122,102,70,200,200,200);  
  
       // Draw the pie chart  
       $Test->setFontProperties("arial.ttf",8);  
       $Test->drawBasicPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),120,100,70,PIE_PERCENTAGE,255,255,218);  
       $Test->drawPieLegend(200,15,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);  
  
       $Test->Render("stats.png");  

		echo "<font style='font-family: Helvetica'>";
		echo "<img src='stats.png' /><br /><br />";
		echo "As of today, we currently have <b>" . mysql_num_rows($users) . "</b> active user(s), serving a total of <b>" . mysql_num_rows($torrents) . "</b> torrent(s).";
		echo "</font>";
 
?>

</table>
</div>
<br>
<br>
<a href="./index.php">Return To Main Site</a></center>
</center>
</body>
</html>