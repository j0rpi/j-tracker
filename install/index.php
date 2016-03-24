<!--

 J-Tracker
 file: install/index.php
 purpose: easy installation script

-->

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<?php
include('../include/config.php');
include('../classes/Registration.php');
$register = new Registration();

if( defined("installed") )
{
	die("J-Tracker is already istalled. Click <a href='../index.php'>here to return to main site.</a>");
}
else
{

echo "
<style type='text/css'>

.tg  {border-collapse:collapse;border-spacing:0;border-color:#999;}
.tg td{margin-left: 50px; text-align: left;font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
.tg th{margin-left: 50px; text-align: left;font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
.container {background: url('http://bibben.se/wp-content/uploads/2013/07/background.png'); width: 800px; height: 1000px; border-radius: 8px 8px 8px 8px; border: 1px solid black;}
</style>
<center>
<div align='center' class='container'>
<font style='font-size: 18px; font-family: Arial;'><b>J-Tracker</b></font><br>
<font style='font-size: 12px; font-family: Arial;'>For best results, please edit config.php.example manually.
</font>
<br>
<br>
<br>
<br>
<br>
<font style='font-size: 16px; font-family: Arial;'><b>Database Settings</b></font>
<br>
<br>
<table class='tg'>
  <tr>
    <th class='tg-031e'>Database Host</th>
    <th class='tg-031e'><input name='dbhost' id='dbhost' type='text' value='localhost'></th>
  </tr>
  <tr>
    <td class='tg-031e'>Database Username</td>
    <td class='tg-031e'><input name='dbuser' id='dbuser' type='text' value='root'></td>
  </tr>
  <tr>
    <td class='tg-031e'>Database Password</td>
    <td class='tg-031e'><input name='dbpass' id='dbpass' type='text'></td>
  </tr>
  <tr>
    <td class='tg-031e'>Database Name</td>
    <td class='tg-031e'><input name='dbname' id='dbname' type='text' value='jtracker'></td>
  </tr>
  <tr>
    <td class='tg-031e'>Database Prefix</td>
    <td class='tg-031e'><input name='db_prefix' id='db_prefix' type='text'></td>
  </tr>
</table>
<br>
<br>
<font style='font-size: 16px; font-family: Arial;'><b>Site Settings</b></font>
<br>
<br>
<table class='tg'>
  <tr>
    <th class='tg-031e'>Site Name</th>
    <th class='tg-031e'><input type='text' name='site_name' id='site_name' value='J-Tracker'></th>
  </tr>
  <tr>
    <td class='tg-031e'>Site Logo</td>
    <td class='tg-031e'><input type='text' name='site_logo' id='site_logo' value='/img/logo.png'></td>
  </tr>
  <tr>
    <td class='tg-031e'>Site Language (Specify Language Code - eg. 'en' for english, or 'sv' for swedish.</td>
    <td class='tg-031e'><input type='text' name='lang' id='site_logo' value='en'></td>
  </tr>
</table>
<br>
<br>
<font style='font-size: 16px; font-family: Arial;'><b>User Settings</b></font>
<br>
<br>
<table class='tg'>
  <tr>
    <td class='tg-031e'>Avatars Path</td>
    <td class='tg-031e'><input type='text' name='avatar_path' value='/files/avatars'></td>
  </tr>
</table>
<br>
<br>
<font style='font-size: 16px; font-family: Arial;'><b>Admin Account Settings</b></font>
<br>
<br>
<table class='tg'>
  <tr>
    <th class='tg-031e'>Admin Username</th>
    <th class='tg-031e'><input name='user_name' type='text'></th>
  </tr>
  <tr>
    <td class='tg-031e'>Admin Password</td>
    <td class='tg-031e'><input name='user_password_new' type='text' pattern='.{6,}' required autocomplete='off'></td>
  </tr>
  <tr>
    <td class='tg-031e'>Confirm Password</td>
    <td class='tg-031e'><input name='user_password_repeat' type='text' pattern='.{6,}' required autocomplete='off'></td>
  </tr>
  <tr>
    <td class='tg-031e'>Admin Email</td>
    <td class='tg-031e'><input name='user_email' type='text'></td>
  </tr>
</table>
<br>
<input type='submit' name='install' value='Install' />

</center>
</div>
</form>";
}

?>
<?php
if (isset ($_POST['install']))
{
   if ( $_POST['install'] || $_GET['install'] )
   {
	   
	   // Write config file
	   config();
	   
	   // Create SysOp account
	   createSysOp();
	   
	   // Finally redirect to main page.
	   redirect();
   }
   else
   {
	   die("Failed to install. Please try again.");
   }
}
?>

<?php

function config()
{
	$file = '../include/config.php';
	$config_content = file_get_contents($file);
	$config_content .= "<?php\n";
	$config_content .= "###########################################\n";
	$config_content .= "# Config file for J-Tracker\n";
	$config_content .= "# generated by J-Tracker install script\n";
	$config_content .= "###########################################\n";
	$config_content .= "\n";
	$config_content .= "# Is J-Tracker installed? \n";
	$config_content .= "define('installed', true);\n";
	$config_content .= "\n";
	$config_content .= "# SQL Settings\n";
	$config_content .= "define('dbhost', '" . $_POST['dbhost'] . "');\n";
	$config_content .= "define('dbuser', '" . $_POST['dbuser'] . "');\n";
    $config_content .= "define('dbpass', '" . $_POST['dbpass'] . "');\n";
	$config_content .= "define('dbname', '" . $_POST['dbname'] . "');\n";
	$config_content .= "\n";
	$config_content .= "# Site Settings\n";
	$config_content .= "define('site_logo', '" . $_POST['site_logo'] . "');\n";
    $config_content .= "define('site_name', '" . $_POST['site_name'] . "');\n";
	$config_content .= "\n";
	$config_content .= "# User Settings\n";
	$config_content .= "define('avatars_dir', '" . $_POST['avatar_path'] . "');\n";
	$config_content .= "# Localization\n";
    $config_content .= "define('lang', '" . $_POST['lang'] . "');\n";
	$config_content .= "mysql_connect(dbhost, dbuser, dbpass) or die('Error connecting to database: '.mysql_error());";
	$config_content .= "mysql_select_db(dbname) or die(mysql_error());";
	$config_content .= "?>";
	
	file_put_contents($file, $config_content);
}

function createSysOp()
{
	$conn = new mysqli($_POST['dbhost'], $_POST['dbuser'], $_POST['dbpass'], $_POST['dbname']);
	if ($conn->connect_error) 
	{
		die("<b>Installation has failed!</b>\n\nCould not connect and populate the database with data.\nPlease check your configuration.");
	}
	
$sql = "INSERT INTO users (user_name, user_password_hash, user_email, user_avatar, user_level) VALUES ('" . $_POST['user_name'] ."', '" . password_hash($_POST['user_password_repeat'], PASSWORD_DEFAULT) . "', '" . $_POST['user_email'] . "', 'http://we3cares.com/Images/User-64x64.jpg',  '10')";
    if ($conn->query($sql) === TRUE) 
	{
       
    } 
    else 
    {
       echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function redirect()
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=ok.php">';    
    exit;  
}
?>

