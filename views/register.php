<?php
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo $error;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo $message;
        }
    }
}
?>


<!-- register form -->
<form method="post" action="register.php" name="registerform">

    <div class='registerbox'><br /><br />
      <font style='font-family: Helvetica'>Username<br>
      <input type='text' class='authboxes' name='user_name' required='' id='username' width='100'><br /><br />
      Password<br>
      <input type='password' class='authboxes' name='user_password_new' required='' id='password' width='100' pattern=".{6,}" required autocomplete="off"><br /><br />
      Confirm Password<br>
      <input id="login_input_password_new" class='authboxes' type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" /><br /><br />
      Email<br>
      <input type='email' class='authboxes' name='user_email' id='email' required='' width='100'><br /><br />
      <input type='submit'  name='register' value='Register' /></font><br><br><br>
</div>
</form>

