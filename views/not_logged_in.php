<?php
// show potential errors / feedback (from login object)
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

<!-- login form box -->

<form method="post" action="login.php" name="loginform">
<div class='loginbox'>
    <br />
	<br />
	Username<br />
    <input id="login_input_username" class='authboxes' type="text" name="user_name" required /><br /><br />
    Password<br />
    <input id="login_input_password" class='authboxes' type="password" name="user_password" autocomplete="off" required />
    <br /><br />
    <input type="submit"  name="login" value="Log in" />
</div>

</form>

<br />
or <a href="register.php">Register new account</a>
<br />
