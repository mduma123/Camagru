<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
session_start();

if(!empty($_SESSION['user'])) 
{
      header('location:../index.php');
}
require '../database.php';

if (isset($_POST["submit"])) {
    $name = $_POST['user'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (empty($name) || empty($password) || empty($email)) {
        echo "All field are required";
    } else {
        try {
               
            //alert if your username and password is not in the database
                  $query = $connection->prepare("SELECT name, password, email, verified FROM users WHERE name=? AND email=? AND password=?");
                  $query->execute(array($name, $email, $password));
                  $row = $query->fetch(PDO::FETCH_ASSOC);
                  if ($row['password'] != $password) 
                  {
                        echo "<h5 class='text-danger'>Username/Password is wrong</h5>";
                  }
                  else
                  {
                      $query = $connection->prepare("SELECT name, password, email, verified FROM users WHERE name=? AND email=? AND password=? AND verified=?;");
                      $query->execute(array($name, $email, $password, 1));
                      $row = $query->fetch(PDO::FETCH_ASSOC);
                      if ($query->rowCount() > 0) {
                          //when you are successfully logged in start the session and create a session variable that stores users email
                          session_start();
                          
                          $getComments = $connection->prepare("SELECT name, password, email, verified FROM users WHERE name='$name' AND email='$email' AND password='$password' AND verified= 1;");
                          $getComments->execute();
                          $users = $getComments->fetchAll();
                          $_SESSION['name'] = implode($users);
                          header("location:../Gallery.php");
                      }
                      //alert if email has not been verified
                      elseif ($row['verified'] == 0) {
                          echo "<h5>Please verify your email</h5>";
                      }
                  }
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
