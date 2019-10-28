<?php 
session_start();
include("reg.php");
?>
<?php
$msg = ""; 
if(isset($_POST['submit'])) {
  $name = trim($_POST['user']);
  $password = trim($_POST['password']);
  if($name != "" && $password != "") {
    try {
      $query = "select * from `user_table` where `name`=:name and `password`=:password";
      $stmt = $myPDO->prepare($query);
      $stmt->bindParam('name', $name, PDO::PARAM_STR);
      $stmt->bindValue('password', $password, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);
      if($count == 1 && !empty($row)) {
        /******************** Your code ***********************/
        $_SESSION['name']   = $row['name'];
        $_SESSION['password'] = $row['password'];
        
       
      } else {
        $msg = "Invalid username and password!";
      }
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  } else {
    $msg = "Both fields are required!";
  }
}
?>
