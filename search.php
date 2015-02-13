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

?>

<head>
    <title><?php echo site_name . " - Search results for '" . $_GET['query'] . "'"; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="skin/default/style.css"/>
</head>
<body>
<div class="topbar">
<form action="search.php" id="search" method="get">
<a href="index.php" class="a" style="float: left; border-bottom: 0px solid lol;"><img src="skin/default/img/logo.png" width="64" height="64" id="" alt="" class="topbar-logo"></a><br />
<a href="index.php" title="Search Torrents">Search Torrents</a>&nbsp;&nbsp;|&nbsp;
<a href="browse.php" title="Browse Torrents">Browse Torrents</a>&nbsp;&nbsp;|&nbsp;
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
        echo "<div class='topbar'>
              <form action='search.php' id='search' method='get'>
			  <font style='font-size: 18px; font-family: Arial;'>
              <a href='index.php' class='a' style='float: left; border-bottom: 0px solid lol;'><img src='skin/default/img/logo.png' width='64' height='64' id='' alt='' class='topbar-logo'></a><br />
              <a href='index.php' title='Search Torrents'>Search Torrents</a>&nbsp;&nbsp;|&nbsp;
              <a href='browse.php' title='Browse Torrents'>Browse Torrents</a>&nbsp;&nbsp;|&nbsp;
              <a href='#' title='Recent Torrent'>Recent Torrents</a>
              <br><br><input type='search' class='search' title='Pirate Search' name='query' value=''> <input value='Search' type='submit' class='submitbutton'><br>
              <input type='hidden' name='page' value='0'>
              <input type='hidden' name='orderby' value='99'>
              </form>
              </div>
			  ";
		echo "<br>No results returned for keyword '". $query . "'</font>";
        }
         
    }
    else{ 
        ob_end_clean();
		echo '<link rel="stylesheet" type="text/css" href="skin/default/style.css"/>';
        echo "<div class='topbar'>
              <form action='search.php' id='search' method='get'>
			  <font style='font-size: 18px; font-family: Arial;'>
              <a href='index.php' class='a' style='float: left; border-bottom: 0px solid lol;'><img src='skin/default/img/logo.png' width='64' height='64' id='' alt='' class='topbar-logo'></a><br />
              <a href='index.php' title='Search Torrents'>Search Torrents</a>&nbsp;&nbsp;|&nbsp;
              <a href='browse.php' title='Browse Torrents'>Browse Torrents</a>&nbsp;&nbsp;|&nbsp;
              <a href='#' title='Recent Torrent'>Recent Torrents</a>
              <br><br><input type='search' class='search' title='Pirate Search' name='query' value=''> <input value='Search' type='submit' class='submitbutton'><br>
              <input type='hidden' name='page' value='0'>
              <input type='hidden' name='orderby' value='99'>
              </form>
              </div>
			  ";
		echo "<br>Please supply a keyword that's at least ".$min_length." characters long, or try to broaden your keyword.</font>";
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