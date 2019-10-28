<?php
include_once 'db_details.php';
include_once 'escape.php';
if (empty($_POST['email'])) {
	header("location: forgot_user.php?msg=Thank you for filling the email field.\n");
}
try {
	$email = Escape::bdd($_POST[email]);
	$db_details = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$db_details->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db_details->prepare('SELECT * FROM user_table WHERE email = :email');
	$stmt->bindParam(':email', $email, PDO::PARAM_STR);
	$stmt->execute();
} catch (PDOException $msg) {
	echo 'Error :'.$msg->getMessage();
}
if ($stmt->fetchColumn()) {
	try {
		$newpass = rand(5, 4000000);
		$stmt = $db_details->prepare('UPDATE user_table SET password = :password WHERE email = :email WHERE name = :user');
		$stmt->bindParam(':password', $newpass, PDO::PARAM_STR);
		$stmt->bindParam('email', $email, PDO::PARAM_STR);
		$stmt->bindParam('user', $name, PDO::PARAM_STR);
		$stmt->execute();
		$to = $email;
		$subject = 'New Password | Camagru';
		$message = '
        Click this link to change your password :
	---------------------
		http://localhost:8080/Camagru/new_pass.php?email='.$email.'&hash='.$newpass.'
	---------------------
	Enjoy!';
		$headers = 'From:mduma@camagru.co.za' . "\r\n";
		mail($to, $subject, $message, $headers);
	} catch (PDOException $msg) {
		echo "Error : ".$msg->getMessage();	
		exit;
	}
	header("Location: login.html?msg=Please check your email to change your password !.\n");
} else {
	header("Location: login.html?msg=Error.\n");
}
?>