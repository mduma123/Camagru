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
  
 $myPDO = new PDO('mysql:host=localhost;dbname=user_registeration', 'root', 'Rodrick12');


 $myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line

 $sql = 'SELECT ID FROM user_table WHERE name = '.$name ;
 
 $name   = $_POST['user'];
 $password   = $_POST['password'];
 $email  = $_POST['email'];
$sql = "INSERT INTO user_table (name, password, email)
VALUES ('$name', '$password', '$email')";
if ($myPDO->exec($sql)) 
{
echo "Your Registeration was Successful , Welcome to Camagru, You can now Login at the Homepage";
}
else
{
echo "Account not Created";
}

$myPDO = null;
}
catch(PDOException $e)
{
echo $e->getMessage();
}

}
?>
 <!-- $name   = $_POST['user'];
 $pass   = $_POST['password'];
 $email  = $_POST['email'];

$q = $pdo->query($sql);
$SQL = 'SELECT ID FROM user_table WHERE name = '.$name ;
$result = $myPDO->query($SQL);
$number_of_rows = $result;fetchColumn();
// $num    = mysql_num_rows($result);

    if($num == 1)
    {
        echo "Username Already/ Email Already Used";
    }
    else
    {
        $reg = "insert into user_table(name, passsword, email) values( '$name', '$pass', '$email')";

        $myPDO->query($reg);
        echo "Your Registeration was Successful , Welcome to Camagru, You can now Login at the Homepage";
    }

?>
$myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line
$sql = "INSERT INTO user_table (name, password, email)
VALUES ('".$_POST["name"]."','".$_POST["password"]."','".$_POST["email"]."')";
if ($myPDO->query($sql)) {
echo "<script type= 'text/javascript'>alert('Your Registeration was Successful , Welcome to Camagru, You can now Login at the Homepage');</script>";
}
else{
echo "<script type= 'text/javascript'>alert('Account not Created');</script>";
}

$myPDO = null;
}
catch(PDOException $e)
{
echo $e->getMessage();
}

}
?> -->
