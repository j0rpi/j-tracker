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
include('classes/torrent.php');
include('classes/Login.php');

$login = new login();
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
<a href="browse.php?p=1" title="Browse Torrents">Browse Torrents</a>&nbsp;&nbsp;|&nbsp;
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
<span style='font-family: Helvetica; font-size: 24px'>Search results from keyword: <b>" . $_GET['query'] . " </b></span><br><br>
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
    $query = $_GET['query']; 
     
    $min_length = 3;
     
    if(strlen($query) >= $min_length){ 
         
        $query = htmlspecialchars($query); 
         
        $query = mysql_real_escape_string($query);
        
        $raw_results = mysql_query("SELECT * FROM torrents
            WHERE (`title` LIKE '%".$query."%') OR (`description` LIKE '%".$query."%')") or die(mysql_error());
         
        if(mysql_num_rows($raw_results) > 0){ 
             
            while($results = mysql_fetch_array($raw_results)){
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
             
        }
        else{ 
            ob_end_clean();
		echo '<link rel="stylesheet" type="text/css" href="skin/default/style.css"/>';
        echo "<div class='topbar'>
              <form action='search.php' id='search' method='get'>
			  <font style='font-size: 18px; font-family: Arial;'>
              <a href='index.php' class='a' style='float: left; border-bottom: 0px solid lol;'><img src='skin/default/img/logo.png' width='64' height='64' id='' alt='' class='topbar-logo'></a><br />
              <a href='index.php' title='Search Torrents'>Search Torrents</a>&nbsp;&nbsp;|&nbsp;
              <a href='browse.php?p=0' title='Browse Torrents'>Browse Torrents</a>&nbsp;&nbsp;|&nbsp;
              <a href='#' title='Recent Torrent'>Recent Torrents</a>
              <br><br><input type='search' style='margin-bottom: 10px;' class='search' title='Pirate Search' name='query' value=''> <input value='Search' type='submit' class='submitbutton'><br>
              <input type='hidden' name='page' value='0'>
              <input type='hidden' name='orderby' value='99'>
              </form>
              </div>
			  ";
		echo "<center><br>No results returned for keyword '". $query . "'</font></center>";
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
		echo "<center>Please supply a keyword that's at least ".$min_length." characters long, or try to broaden your keyword.</font>";
    }
?>

</table>
</div>
<br>
<br>
<center>
<?php
if ($login->isUserLoggedIn() == true)
{
$unread = mysql_query("SELECT * FROM pms WHERE unread='yes' AND reciever='" . $_SESSION['user_name'] . "'") or die(mysql_error());
echo "<br />Logged in as <b>" . $_SESSION['user_name'] . "</b> <a href='index.php?logout'>Logout</a><a href='inbox.php'> | Inbox(<font style='color: maroon'><b>" . mysql_num_rows($unread) . "</b></font>) |";
}
else
{
echo "<a href='login.php'>Login</a> |
      <a href='register.php'> Register</a> |";
      
}

echo "
<a href='upload.php'>Upload Torrent</a> |
<a href='my.php'>UCP</a> |
<a href='/blog/'>Blog</a> |
<a href='legal.php'>Legal</a> |
<a href='stats.php'>Site Statistics</a> |
<a href='about.php'>About J-Tracker</a>
</nav>
<br>
<br>
<span class='footertext'>Site Powered by <a href='http://www.github.com/j0rpi/j-tracker'>J-Tracker v0.3</a><br></span>
<br>
<br>
<br>
<br>
<a href='http://www.kopimi.com/kopimi/' class='torrentlinks'><img src='skin/default/img/kopimi.gif'/></a>
</center>
</body>";
?>
</body>
</html>