<!--

 J-Tracker Official Module
 Module: User Ratio Module
 
 Author: j0rpi
 Version: 0.1alpha

-->
<?php

// Enable module
DEFINE("ratioModule_enabled", "yes");

// Free leech active?
DEFINE("ratioModule_freeLeech", "no");

// If yes, until when?
DEFINE("ratioModule_flEndDate", "0000-00-00");

// How many days the user has to balance their ratio before their banned
// Default 1 week (7 days)
DEFINE("ratioModule_warnDays", "7");

// When is the user considered a leecher?
// Default is 0.99, meaning that the user is considered a leecher at 0.99 ratio.
DEFINE("ratioModule_leechRatio", "0.99");

// Warning message that gets sent to their PM box 
// when user has reached 'ratioModule_leechRatio'
DEFINE("ratioModule_warnMessage", "Your ratio is currently under the desired 1.00 limit.<br />
                                   Please consider seeding a bit more. You have 7 days to balance out your ratio
								   before your account is banned.");


?>