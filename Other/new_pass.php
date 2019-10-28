<?php
include_once('header.php');
if ($_GET[msg]) {echo "<script>alert(\"".htmlentities($_GET[msg])."\");window.location.href = \"new_pass.php\";</script>";}
if (empty($_POST[mdp]) || empty($_POST[remdp]) || empty($_POST[email])) {
	header("Location: new_pass.php?msg=Please fill in all the blank spaces\n");
} else if (strlen($_POST[mdp]) < 8) {
	header("Location: new_pass.php?msg=The password must contain at least 8 characters.\n");
} else if ($_POST[mdp] != $_POST[remdp]) {
	header("Location: new_pass.php?msg=Passwords are not the same.\n");
}
try {
    include_once('db_deatils.php');
    include once(' reg.php');
	include_once('escape.php');
	$email = Escape::bdd($_POST[email]);
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db_details->prepare('SELECT COUNT(*) FROM user_table WHERE email = :email');
	$stmt->bindParam(':email', $email, PDO::PARAM_STR);
	$stmt->execute();
} catch (PDOException $msg) {
	echo "Error : ".$msg->getMessage();
	exit;
}
$password = hash('whirlpool', Escape::bdd($_POST[mdp]));
if ($stmt->fetchColumn()) {
	try {
		$stmt = $db_details->prepare("UPDATE user_table SET password = :password WHERE email = :email WHERE name= user");
		$stmt->bindParam(':password', $password, PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':user', $name, PDO::PARAM_STR);
		$stmt->execute();
	} catch (PDOException $msg) {
		echo "Error : ".$msg->getMessage();
		exit;
	}
	header("Location: index.php?msg=Your password has been changed.\n");
}
?>

			<form class='logform' action="new_pass.php" method="post">
				<center>
				<label class='mytext' for='email'>Your email address</label><br>
				<input class='mybar' type='email' name="email" placeholder="exemple@exemple.com"/><br/>
				<label class='mytext' for="mdp">Your new password</label><br>
				<input class='mybar' type="password" name="mdp" placeholder="Enter your password" /><br/>
				<label class='mytext' for="remdp">Confirm your password</label><br>
				<input class='mybar' type="password" name="remdp" placeholder="Please re-enter your password" /><br/>
				<input class='mybutton' type="submit" name="connection" /><br/>
				</center>
			</form>
		</div>
		<a class='mylink' href = "index.php">Back to the homepage</a>
	</body>
</html>