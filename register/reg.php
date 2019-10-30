<?php 
// echo '<pre>';
// var_dump($_POST);
// echo '</pre>'; 
if(isset($_POST["submit"]))
{
    $hostname='localhost';
    $username='root';
    $password='';
try{
  
 $myPDO = new PDO('mysql:host=localhost;dbname=camagru', 'root', 'Rodrick12');


 $myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line

 $sql = 'SELECT ID FROM users WHERE name = '.$name ;
 
 $name   = $_POST['user'];
 $password   = $_POST['password'];
 $hash = hash('md5', $password, false);
 $email  = $_POST['email'];
$sql = "INSERT INTO users (name, password, email, verified)
VALUES ('$name', '$password', '$email', 0)";
if ($myPDO->exec($sql)) 
{
echo "Your Registeration was Successful , Welcome to Camagru, You can now Login at the Homepage";
}
else
{
echo "Account not Created";
}

$headers = 'FROM:Camagru';
                $message = " Congratulations $name, you are now registered!! 
			
			Please click on the link below to login
			
			http://127.0.0.1:8080/Camagru_/register/verify_email.php?email=$email";
                mail("$email", "Verify Camagru account", "$message", "$headers");
            
                echo "You have been registered! Please verify your email!";
                // $connection->commit();


$myPDO = null;
}
catch(PDOException $e)
{
echo $e->getMessage();
}

}
?>
 
  <!-- <?php
	require_once "../database.php";
    if (isset($_POST["submit"])) {
        $email = trim($_POST['email']);
        $name = trim($_POST['user']);
        $password = sha1(trim($_POST['password']));
        $check = $connection->prepare("SELECT `email` FROM `user_table` WHERE `email`=?");
        $check->bindValue(1, $email);
        $check->execute();
        if ($_POST['email'] == "" || $_POST['user'] == "" || $_POST['password'] == "") {
            $alert = "<h5 class='text-danger'>Please complete form<h5>";
        } elseif ($check->rowCount() > 0) {
            $alert = "<h5 class='text-danger'>Email provided is already in use<h5>";
        } else {
            //insert email, username and password to database as well as adding 0 to the verified variable. Send email to the user. The "verified" variable will change to 1, once the link that is sent to your email, is clicked.
            try {
                $connection->beginTransaction();
                $sql = "INSERT INTO user_table (`name`, `password`, email, verified) VALUES ('$name','$password','$email', 0);";
                $connection->exec($sql);
                $headers = 'FROM:Camagru';
                $message = " Congratulations $name, you are now registered!! 
			
			Please click on the link below to login
			
			http://127.0.0.1:8080/Camagru_/register/verify_email.php?email=$email";
                mail("$email", "Verify Camagru account", "$message", "$headers");
            
                $alert = "You have been registered! Please verify your email!";
                $connection->commit();
            } catch (PDOException $e) {
                echo $sql . "\n" . $e->getMessage();
            }
        }
	}
?> -->
