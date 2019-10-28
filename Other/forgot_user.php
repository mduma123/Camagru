<?php
if ($_GET[msg]) {echo "<script>alert(\"".htmlentities($_GET[msg])."\");window.location.href = \"forgot_user.php\";</script>";}
include_once('header.php');
include_once('login.html');

?>

	<form class='form-group' action="Forgot_password.php" method="post">
		<center>
		<h3>Forgotten Password?<h3>
		<label class='mytext' for="email">Your email address</label><br>
		<input class='mybar' type="email" name="email" placeholder='Enter your email address' /><br/>
		<input class='mybutton' type="submit" name="connection" /><br/>
		</center>
	</form>
</html>