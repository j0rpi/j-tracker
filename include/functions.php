<!--

 J-Tracker
 file: functions.php
 purpose: contains various functions, usable for each and every php file.

-->

<?php
//Initiate database connection
include('../include/config.php');
include_once 'psl-config.php';
$conn = new mysqli(dbhost, dbuser, dbpass, dbname);
?>


<?php

function AddFakeComment($id, $text, $user) 
{
	
	$sql = "INSERT INTO comments (id, text, user, time) VALUES ('" . $id . "', '" . $text . "', '" . $user . "', '" . date("F j Y, H:i:s") . "')";
    if ($conn->query($sql) === TRUE) 
	{
       // We don't have to do anything here.
    }
    else	
	{
		echo "Error: Function 'AddFakeComment()' has failed.";
	}
	
}

function AddFakeTorrent($cat, $uploader, $desc, $magnetlink, $title) //Adds a fake torrent
{
	
	$sql = "INSERT INTO torrents (cat, uploader, description, link, title) VALUES ('" . $cat . "', '" . $uploader . "', '" . $desc . "', '" . $magnetlink . "', '" . $title . "')";
    if ($conn->query($sql) === TRUE) 
	{
       // We don't have to do anything here.
    } 
	else
	{
		echo "Error: Function 'AddFakeTorrent()' has failed.";
	}
}

function AddFakeUser($username, $password, $email, $level) //Adds a fake torrent
{
	
	$sql = "INSERT INTO users (username, password, email, level) VALUES ('" . $username . "', '" . md5($password) . "', '" . $email . "', '" . $level . "')";
    if ($conn->query($sql) === TRUE) 
	{
       // We don't have to do anything here.
    } 
    else 
    {
       echo "Error: Function 'AddFakeUser()' has failed.";
    }
}
?>