<?php
session_start();
include_once "db_details.php";
try {
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db_details->prepare('SELECT admin FROM user_table WHERE login = :log');
	$stmt->bindParam(':log', $_SESSION['login'], PDO::PARAM_STR);
	$stmt->execute();
} catch (PDOException $msg) {
	echo 'Error: '.$msg->getMessage();
	exit;
}
$admin = $stmt->fetchColumn();
echo "<html>
	<head>
		<title>Camagru</title>
		<link rel='stylesheet' type='text/css' href='style.css'
	</head>
	<body>";
// if ($_SESSION['login'] && $_SESSION['login'] != "")
// {
// 	echo "<ul class='topnav'>";
// 	if ($admin == 1)
// 		echo "<li class='zop' style='float:right;margin-top:1.5%;margin-right:6px'><a href=\"administration.php\">administration</a></li>";
// 	echo "  <li><a href='index.php'><img src='img/clogo.png'/></a><li>
// 		<li class='zop' style='float:right;margin-top:1.5%;margin-right:6px'><a href=\"deconnexion.php\">déconnexion</a></li>";
// 	echo "</ul>";
// }
// else {
// 	echo "<ul class='topnav'>
// 		<li><a href='index.php'><img src='img/clogo.png'/></a><li>
// 		<li class='zop' style='float:right;margin-top:1.5%;margin-right:6px'><a href='connexion_user.php'>Connexion</a></li>
// 		<li class='zop' style='float:right;margin-top:1.5%;border:1px solid #3c538b'><a href='create_user.php'>Creer un compte</a></li>";
// 	echo "</ul>";
// }
// ?>