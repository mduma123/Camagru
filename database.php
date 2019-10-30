<?php
    $servername = 'localhost';
    $username = 'root';
    $password = 'Rodrick12';
    //create a connection'
    try
    {
        //create the connection using PHP DATA OBJECTS
        $connection = new PDO("mysql:host=$servername", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //create the database with all the tables needed. (config.php)
        include_once("config.php");
    }
    //if there is an error with the connection output an error message
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }
?>