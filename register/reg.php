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
  
 $myPDO = new PDO('mysql:host=localhost;dbname=Camagru_', 'root', 'Rodrick12');


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
 
  