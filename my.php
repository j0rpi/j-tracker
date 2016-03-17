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
?>

<head>
    <title><?php echo site_name . " - User Details"; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="skin/default/style.css"/>
</head>
<body>
<div class='topbar'>
<form action='search.php' id='search' method='get'>
<a href='index.php' class='a' style='float: left; border-bottom: 0px solid lol;'><img src='skin/default/img/logo.png' width='64' height='64' id='' alt='' class='topbar-logo'></a><br />
<a href='index.php' title='Search Torrents'>Search Torrents</a>&nbsp;&nbsp;|&nbsp;
<a href='browse.php?p=0' title='Browse Torrents'>Browse Torrents</a>&nbsp;&nbsp;|&nbsp;
<a href='#' title='Recent Torrent'>Recent Torrents</a>
<br><br><input type='search' class='search' required='' name='query' value=''> <input value='Search' type='submit' class='submitbutton'><br>
<input type='hidden' name='page' value='0'>
<input type='hidden' name='orderby' value='99'>
</form>
</div>
<?php
if ($login->isUserLoggedIn() == true)
{
echo "
	
	<center>
<br>
<br>
<div class='torrenttable'  >
<span style='font-family: Helvetica; font-size: 24px'>". $_SESSION['user_name'] . " :: User Control Panel</b></span><br><br>
";
     

$query = mysql_query("SELECT * FROM users WHERE user_name='" . $_SESSION['user_name'] . "'") or die(mysql_error()); 

while($user_results = mysql_fetch_array($query))
{
	echo "
	     <div class='profilebg' style='height: 750px'>
		 <br><br><div class='profilepage_section'>
		 <form method='post' action='my.php' name='avatar'> 
         <br><br><img class='profilepage_avatar' src='" . $user_results['user_avatar'] . "' width='64' height='64' /><br><br><input type='text' name='avatar_url' value='" . $user_results['user_avatar'] . "' style='width: 350px';><br>
		 <br><input type='submit' name='updateavatar' value='Update Avatar ...'>
		 </form>
		 <br />
		 <br />
		 <br><br><div class='profilepage_section'>
		 <form method='post' action='my.php'> 
         <br><br><textarea name='pgp' class='search' style='width: 325px; height: 110px'>" . $user_results['user_pgp'] . "</textarea><br>
		 <br><input type='submit' name='updatepgp' value='Update PGP Key'>
		 </form>
		 </div>
		 <br>";
}
?>
<form method='post' action='my.php' name='password'>      
<br><br><div class='profilepage_section'><br><br><br>New Password<br><input type='password' name='user_password_new' pattern='.{6,}' required autocomplete='off'><br>
<br>Confirm New Password<br>
<input type='password' name='user_password_repeat' pattern='.{6,}' required autocomplete='off'>
<br><br>
<input type='submit' name='updatepassword' value='Update Password ...'>
</form>
<br>
</div>
</div>

<?php
}
else
{
	echo "<br><center>You need to login to visit the user control panel. Please <a href='login.php'>LOGIN</a> to access your user settings.<br /><br /></font></center>";
}

?>

</table>
</div>
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
</body>
</html>";
?>