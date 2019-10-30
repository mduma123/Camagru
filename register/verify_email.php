<?php

//When you Sign Up , a link of verification is sent to the user for verification , when the linked is clicked the user gets redirected to the Login page.
require_once "../database.php";

$email = $_GET['email'];
$sql = $connection->prepare("UPDATE users set verified= 1 where email='$email'");
$sql -> execute();
header("Location:login_reg.php");
?>