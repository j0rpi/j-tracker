<?php
###########################################
# Config file for J-Tracker
# generated by J-Tracker install script
###########################################

# Is J-Tracker installed? 
define('installed', true);

# SQL Settings
define('dbhost', 'localhost');
define('dbuser', 'root');
define('dbpass', '123456');
define('dbname', 'jtracker');

# Site Settings
define('site_logo', '/img/logo.png');
define('site_name', 'J-Tracker');

# User Settings
define('avatars_dir', '/files/avatars');
# Localization
define('lang', 'en');

# Version
define('version', '0.6');
mysql_connect(dbhost, dbuser, dbpass) or die('Error connecting to database: '.mysql_error());mysql_select_db(dbname) or die(mysql_error());?>