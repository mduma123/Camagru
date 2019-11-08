<?php
    //create the database if it does not already exist
	$sql = "CREATE DATABASE IF NOT EXISTS Camagru";
    $connection->exec($sql);
    //connect to the database db_cam
    $sql = "USE Camagru";
    $connection->exec($sql);
    //create table users (where the users sign up information is stored)
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        username varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        password varchar(255) NOT NULL,
        verified INT(11)
    )";
    $connection->exec($sql);
    //create table comments.
    $sql = "CREATE TABLE IF NOT EXISTS comment (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        user varchar(255) NOT NULL,
        img varchar(255) NOT NULL,
        comment varchar(255) NOT NULL
    )";
    $connection->exec($sql);
    //create like table
    $sql = "CREATE TABLE IF NOT EXISTS likes (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        userid INT(11),
        imgid varchar(255)
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