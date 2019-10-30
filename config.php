<?php
    //create the database if it does not already exist
	$sql = "CREATE DATABASE IF NOT EXISTS Camagru_";
    $connection->exec($sql);
    //connect to the database db_cam
    $sql = "USE Camagru_";
    $connection->exec($sql);
    //create table users (where the users sign up information is stored)
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        password varchar(255) NOT NULL,
        verified INT(11)
    )";
    $connection->exec($sql);
    //create table comments.
    $sql = "CREATE TABLE IF NOT EXISTS comments (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        user varchar(255) NOT NULL,
        img varchar(255) NOT NULL,
        comments varchar(255) NOT NULL
    )";
    $connection->exec($sql);
    //create like table
    $sql = "CREATE TABLE IF NOT EXISTS likes (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        user_id INT(11),
        img_id varchar(255)
    )";
    $connection->exec($sql);
    //create img table (name of the image and the user it belongs to. As well as where the like are stored)
    $sql = "CREATE TABLE IF NOT EXISTS image (
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        user varchar(255) NOT NULL,
        img varchar(255) NOT NULL,
        article_likes INT(11) NOT NULL
    )";
    $connection->exec($sql);
    //During each creation the sql is stored in a variable and executed with the exec method($connection->exec($sql);)
    //The connection variable was created in database.php
?>