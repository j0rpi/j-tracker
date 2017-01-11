<?php

/**
 * Class registration
 * handles the user registration
 */
class Registration
{
    /**
     * @var object $db_connection The database connection
     */
    private $db_connection = null;
    /**
     * @var array $errors Collection of error messages
     */
    public $errors = array();
    /**
     * @var array $messages Collection of success / neutral messages
     */
    public $messages = array();
	
	public $password_change_status = "";

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$registration = new Registration();"
     */
    public function __construct()
    {
        if (isset($_POST["register"])) 
		{
            $this->registerNewUser();
        }
		if (isset($_POST["updatepassword"]))
		{
			$this->updatePassword();
		}
		if (isset($_POST["updateavatar"]))
		{
			$this->updateAvatar();
		}
		if (isset($_POST["updatepgp"]))
		{
			$this->updatePGP();
		}
		if (isset($_POST["addcomment"]))
		{
			$this->addComment();
		}
		if (isset($_POST["install"]))
		{
			$this->registerSysOp();
		}
		if (isset($_POST["sendpm"]))
		{
			$this->sendPM();
		}
		if (isset($_POST["replypm"]))
		{
			$this->replyPM();
		}
		if (isset($_POST["block"]))
		{
			$this->blockUser();
		}
    }
	
	public function getUserLevel($user)
    {
    $this->db_connection = new mysqli(dbhost, dbuser, dbpass, dbname);
	$sql = "SELECT * FROM users WHERE user_name='" . $user . "'";
	$sql2 = mysql_query("SELECT * FROM users WHERE user_name='" . $user . "'");
	$query_get_level = $this->db_connection->query($sql);

	if ($query_get_level) 
	    {
            while($level = mysql_fetch_array($sql2))
			{
				if($level['user_level'] == '0')
				{
					return null;
				}
				
				if($level['user_level'] == 'bot')
				{
					return '<img alt="Bot" src="skin/default/img/users/ghost.gif" width="12" height="12" /> ';
				}
				
				if($level['user_level'] == '8')
				{
					return '<img alt="VIP" src="skin/default/img/users/vip.png" width="12" height="12" /> ';
				}
				
				if($level['user_level'] == '9')
				{
					return '<img alt="Moderator" src="skin/default/img/users/mod.png" width="12" height="12" /> ';
				}
				
				if($level['user_level'] == '10')
				{
					return '<img alt="Administrator" src="skin/default/img/users/sysop.png" width="12" height="12" /> ';
				}
				if($level['user_level'] == 'system')
				{
					return '<img alt="System" src="skin/default/img/users/system.png" width="12" height="12" /> ';
				}
				
			}
        } 
		else 
		{
            echo "<center>Error: Function <strong>getUserLevel()</strong> has failed. Please contact administrators.";
        }
	}
	
	public function updatePassword()
    {
    $this->db_connection = new mysqli(dbhost, dbuser, dbpass, dbname);
	$sql = "UPDATE users SET user_password_hash = '" . password_hash($_POST['user_password_new'], PASSWORD_DEFAULT) . "' WHERE user_name = '" . $_SESSION['user_name'] . "'";
	$query_update_password = $this->db_connection->query($sql);
	
	if ($query_update_password) 
	    {
            $password_change_status = "<center>Password has been updated successfully!</center><br />";
			echo $password_change_status;
        } 
		else 
		{
            $password_change_status = "<center>An error occured while trying to update password. Please try again.</center><br />";
			echo $password_change_status;
        }
	}
	
	public function updateAvatar()
    {
    $this->db_connection = new mysqli(dbhost, dbuser, dbpass, dbname);
	$sql = "UPDATE users SET user_avatar = '" . $_POST['avatar_url'] . "' WHERE user_name = '" . $_SESSION['user_name'] . "'";
	$query_update_avatar = $this->db_connection->query($sql);
	
	if ($query_update_avatar) 
	    {
            echo "<center>Avatar updated successfully!</center><br />";
        } 
		else 
		{
            echo "An error occured while trying to update avatar. Please try again.";
        }
	}
	
	public function updatePGP()
    {
    $this->db_connection = new mysqli(dbhost, dbuser, dbpass, dbname);
	$sql = "UPDATE users SET user_pgp = '" . $_POST['pgp'] . "' WHERE user_name = '" . $_SESSION['user_name'] . "'";
	$query_update_avatar = $this->db_connection->query($sql);
	
	if ($query_update_avatar) 
	    {
            echo "<center>PGP key updated successfully!</center><br />";
        } 
		else 
		{
            echo "An error occured while trying to update PGP key. Please try again.";
        }
	}
	
	
	
	public function addComment()
    {
    $this->db_connection = new mysqli(dbhost, dbuser, dbpass, dbname);
	$sql = "INSERT INTO comments (id, text, user, time) VALUES ('" . $_POST['torrent_id']  . "', '" . mysql_real_escape_string($_POST['comment_text']) . "', '" . $_SESSION['user_name'] . "', '" . date('F j Y, H:i:s') . "')";
	$query_add_comment = $this->db_connection->query($sql);
	
	if ($query_add_comment) 
	    {
            echo "<center>Comment added successfully!</center><br />";
        } 
		else 
		{
            echo "<center>An error occured while trying to add comment. Please try again.</center><br />";
        }
	}
	
	public function sendPM()
    {
    $this->db_connection = new mysqli(dbhost, dbuser, dbpass, dbname);
	$sql = "INSERT INTO pms (title, message, sender, reciever, date, unread) VALUES ('" . $_POST['title']  . "', '" . mysql_real_escape_string($_POST['message']) . "', '" . $_POST['sender'] . "', '" . $_POST['reciever'] . "', '" . date('F j Y, H:i:s') . "', 'yes')";
	$query_send_pm = $this->db_connection->query($sql);
	
	if ($query_send_pm) 
	    {
            header('Location: inbox.php');
        } 
		else 
		{
			echo "<font style='color: maroon'><center>Message could not be sent. The recipent might have turned off PM's, or blacklisted you.</font></center><br />";
        }
	}
	
	public function replyPM()
    {
    $this->db_connection = new mysqli(dbhost, dbuser, dbpass, dbname);
	$sql = "INSERT INTO pms (title, message, sender, reciever, date) VALUES ('" . $_POST['title']  . "', '" . mysql_real_escape_string($_POST['message']) . "', '" . $_POST['reciever'] . "', '" . $_POST['sender'] . "', '" . date('F j Y, H:i:s') . "')";
	$query_send_pm = $this->db_connection->query($sql);
	
	if ($query_send_pm) 
	    {
            echo "<font style='color: darkgreen'><center>Message sent successfully.</font></center><br />";
        } 
		else 
		{
			echo "<font style='color: maroon'><center>Message could not be sent. The recipent might have turned off PM's, or blacklisted you.</font></center><br />";
        }
	}
	
	public function blockUser()
    {
    $this->db_connection = new mysqli(dbhost, dbuser, dbpass, dbname);
	$sql = "INSERT INTO friends (user, friendid, blocked) VALUES ('". $_SESSION['user_name'] . "', '" . $_POST['friendid'] . "', 'yes') ON DUPLICATE KEY UPDATE user = VALUES(user), friendid = VALUES(friendid), blocked = VALUES(blocked)";
	$sql2 = "DELETE FROM friends WHERE user='" . $_SESSION['user_name'] ."' AND friendid='" . $_POST['friendid'] . "' AND blocked='no'";
	$query_block = $this->db_connection->query($sql);
	$query_delete = $this->db_connection->query($sql2);
	
	if ($query_block) 
	    {
            echo "<font style='color: darkgreen'><center><b>" . $_POST['friendid'] . "</b> has been added to the blocklist.</font></center><br />";
            if($query_delete)
			{
				// Don't do nothin'
			}
			else
			{
				// Nothin' here either!
			}
		} 
		else
		{
			echo "<font style='color: maroon'><center>Failed to block user. This user might not exist anymore.</font></center>";
			echo "<br><br><br><b>[DEBUG]</b> user: " . $_SESSION['user_name'] . " friendid: " . $_POST['friendid'];
		}
	}
	
	
    public function registerSysOp()
    {
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Empty Username";
        } elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
            $this->errors[] = "Empty Password";
        } elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
            $this->errors[] = "Password and password repeat are not the same";
        } elseif (strlen($_POST['user_password_new']) < 6) {
            $this->errors[] = "Password has a minimum length of 6 characters";
        } elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) {
            $this->errors[] = "Username cannot be shorter than 2 or longer than 64 characters";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) {
            $this->errors[] = "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters";
        } elseif (empty($_POST['user_email'])) {
            $this->errors[] = "Email cannot be empty";
        } elseif (strlen($_POST['user_email']) > 64) {
            $this->errors[] = "Email cannot be longer than 64 characters";
        } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Your email address is not in a valid email format";
        } elseif (!empty($_POST['user_name'])
            && strlen($_POST['user_name']) <= 64
            && strlen($_POST['user_name']) >= 2
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])
            && !empty($_POST['user_email'])
            && strlen($_POST['user_email']) <= 64
            && filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)
            && !empty($_POST['user_password_new'])
            && !empty($_POST['user_password_repeat'])
            && ($_POST['user_password_new'] === $_POST['user_password_repeat'])
        ) {
            // create a database connection
            $this->db_connection = new mysqli(dbhost, dbuser, dbpass, dbname);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escaping, additionally removing everything that could be (html/javascript-) code
                $user_name = $this->db_connection->real_escape_string(strip_tags($_POST['user_name'], ENT_QUOTES));
                $user_email = $this->db_connection->real_escape_string(strip_tags($_POST['user_email'], ENT_QUOTES));

                $user_password = $_POST['user_password_new'];

                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

                // check if user or email address already exists
                $sql = "SELECT * FROM users WHERE user_name = '" . $user_name . "' OR user_email = '" . $user_email . "';";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) {
                    $this->errors[] = "Sorry, that username / email address is already taken.";
                } else {
                    // write new user's data into database
                    $sql = "INSERT INTO users (user_name, user_password_hash, user_email, user_avatar, user_level)
                            VALUES('" . $user_name . "', '" . $user_password_hash . "', '" . $user_email . "', 'http://we3cares.com/Images/User-64x64.jpg', '10');";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $this->messages[] = "Your account has been created successfully. You can now log in.";
                    } else {
                        $this->errors[] = "Sorry, your registration failed. Please go back and try again.";
                    }
                }
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        } else {
            $this->errors[] = "An unknown error occurred.";
        }
    }
	

    /**
     * handles the entire registration process. checks all error possibilities
     * and creates a new user in the database if everything is fine
     */
    private function registerNewUser()
    {
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Empty Username";
        } elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
            $this->errors[] = "Empty Password";
        } elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
            $this->errors[] = "Password and password repeat are not the same";
        } elseif (strlen($_POST['user_password_new']) < 6) {
            $this->errors[] = "Password has a minimum length of 6 characters";
        } elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) {
            $this->errors[] = "Username cannot be shorter than 2 or longer than 64 characters";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) {
            $this->errors[] = "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters";
        } elseif (empty($_POST['user_email'])) {
            $this->errors[] = "Email cannot be empty";
        } elseif (strlen($_POST['user_email']) > 64) {
            $this->errors[] = "Email cannot be longer than 64 characters";
        } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Your email address is not in a valid email format";
        } elseif (!empty($_POST['user_name'])
            && strlen($_POST['user_name']) <= 64
            && strlen($_POST['user_name']) >= 2
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])
            && !empty($_POST['user_email'])
            && strlen($_POST['user_email']) <= 64
            && filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)
            && !empty($_POST['user_password_new'])
            && !empty($_POST['user_password_repeat'])
            && ($_POST['user_password_new'] === $_POST['user_password_repeat'])
        ) {
            // create a database connection
            $this->db_connection = new mysqli(dbhost, dbuser, dbpass, dbname);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escaping, additionally removing everything that could be (html/javascript-) code
                $user_name = $this->db_connection->real_escape_string(strip_tags($_POST['user_name'], ENT_QUOTES));
                $user_email = $this->db_connection->real_escape_string(strip_tags($_POST['user_email'], ENT_QUOTES));

                $user_password = $_POST['user_password_new'];

                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

                // check if user or email address already exists
                $sql = "SELECT * FROM users WHERE user_name = '" . $user_name . "' OR user_email = '" . $user_email . "';";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) {
                    $this->errors[] = "Sorry, that username / email address is already taken.";
                } else {
                    // write new user's data into database
                    $sql = "INSERT INTO users (user_name, user_password_hash, user_email)
                            VALUES('" . $user_name . "', '" . $user_password_hash . "', '" . $user_email . "');";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $this->messages[] = "Your account has been created successfully. You can now log in.";
                    } else {
                        $this->errors[] = "Sorry, your registration failed. Please go back and try again.";
                    }
                }
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        } else {
            $this->errors[] = "An unknown error occurred.";
        }
    }
}
