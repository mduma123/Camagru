<?php
    /*When you sign up, an email is sent to the user with a link to the login page.
    When you click on the link the "verified" variable in the database is changed from 0 to 1 this is needed for you to login. If this is not changed you cannot login.
    Then redirect back to the login page.
    */
    require_once "../database.php";
    $email = $_GET['email'];
    $sql=$connection->prepare("update `users` set verified=1 where email='$email'");
	$sql->execute();
    header("Location:login.php");
?>