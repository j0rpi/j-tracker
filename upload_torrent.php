<?php
include("include/config.php");
include('classes/Login.php');
$login = new Login();
define("SITE_ROOT", realpath(dirname(__FILE__)));
define("UPLOAD_DIR", SITE_ROOT . "/torrents/");
 
if (!empty($_FILES["torrentfile"])) 
{
    $myFile = $_FILES["torrentfile"];
 
    if ($myFile["error"] !== UPLOAD_ERR_OK) 
	{
        echo "<p>An error occurred.</p>";
        exit;
    }
 
    // ensure a safe filename
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);
 
    // don't overwrite an existing file
    $i = 0;
    $parts = pathinfo($name);
    while (file_exists(UPLOAD_DIR . $name)) 
	{
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }
 
    // preserve file from temporary directory
    $success = move_uploaded_file($myFile["tmp_name"],
        UPLOAD_DIR . $name);
    if (!$success) 
	{ 
        echo "<p>Unable to save file.</p>";
        exit;
    }
	else
	{
		insertTorrent();
		 
		echo "Torrent has been uploaded.<br>";
		echo "For security reasons, we will redirect you to your profile page<br>";
		echo "where you will find your latest uploaded torrents.";
		echo "<br>";
		echo "Redirecting in 5 seconds..";
		echo "<META HTTP-EQUIV='Refresh' Content='5; URL=user.php?id=" . $_SESSION['user_name'] . "'>";   
	}
 
    // set proper permissions on the new file
    chmod(UPLOAD_DIR . $name, 0644);
}

function insertTorrent()
{
	$myFile = $_FILES["torrentfile"];
	$name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);
	$conn = new mysqli(dbhost, dbuser, dbpass, dbname);
	if ($conn->connect_error) 
	{
		die("<b>Installation has failed!</b>\n\nCould not connect and populate the database with data.\nPlease check your configuration.");
	}
	
$sql = "INSERT INTO torrents (cat, uploader, description, link, title, date) VALUES ('" . $_POST['cat'] . "', '" . $_SESSION['user_name'] . "', '" . mysql_real_escape_string($_POST['desc']) . "', 'torrents/" . $name . "',  '" . mysql_real_escape_string($_POST['title']) . "', '" . date('F j Y, H:i:s') . "')";
    if ($conn->query($sql) === TRUE) 
	{
       
    } 
    else 
    {
       echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

