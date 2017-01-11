<?php
class jtrackerFunctions
{
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
	public function getUserAvatar($user)
	{
		$this->db_connection = new mysqli(dbhost, dbuser, dbpass, dbname);
		$sql = "SELECT * FROM users WHERE user_name='" . $user . "'";
		$sql2 = mysql_query("SELECT * FROM users WHERE user_name='" . $user . "'");
		$query_get_level = $this->db_connection->query($sql);
		
	if ($query_get_level) 
	{
        while($avatar = mysql_fetch_array($sql2))
		{
			if($avatar['user_avatar'] <= 0)
			{
				return "<img src='" . $avatar['user_avatar'] . "' height='64' width='64' />";
			}
			else
			{
				echo "No avatar.";
			}
        } 
		
		
	}
	}
	public function getUserCountry($user)
	{
		$total = mysql_query("SELECT user_country FROM users WHERE user_name='" . $user . "'") or die(mysql_error());
		$row = mysql_fetch_array($total);
		if(!$row['user_country'] <= 0)
		{
			return "<img src='../skin/default/img/flags/" .  $row['user_country'] . ".png'  height='11' width='16' />";
		}
		else
		{
		}
	}

  public function getUserPosts($user)
	{
		$total = mysql_query("SELECT * FROM forum_post WHERE user='" . $user . "'") or die(mysql_error());
		return mysql_num_rows($total);
    }
}

?>