<?php
	require_once "../database.php";
		if (isset($_POST['login'])){
		$user = $_POST['email'];
		$pass = sha1($_POST['pass']);
		//alert if any of the fields are empty
		if (empty($user) || empty($pass)){
			$alert = "<h5 class='text-danger'>All fields are required</h5>";
		}
		else {
			$query = $connection->prepare("SELECT email, password FROM users WHERE email=? AND password=? AND verified=true");
			$query->execute(array($user, $pass));
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if ($query->rowCount() > 0){
				//when you are successfully logged in start the session and create a session variable that stores users email
				session_start();
				$_SESSION['id'] = $_POST['email'];
				$email = $_SESSION['id'];
				$getComments = $connection->prepare("SELECT username FROM users WHERE email='$email'");
    			$getComments->execute();
				$users = $getComments->fetchAll();
				$_SESSION['user'] = implode($users);
				header("location:../Gallery.php");
			}
			//alert if email has not been verified
			elseif($row['verified'] == 0){
				$alert = "<h5>Please verify your email</h5>";
			}
			//alert if your username and password is not in the database
			else {
				$alert = "<h5 class='text-danger'>Username/Password is wrong</h5>";
			}
		}
	}
?>

<html>
    <head>
        <center><h1 style="font-size:60px; color:green; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;"><i>Welcome to Camagru</i></h1></center>
        <title>Sign_In</title>
        <link rel = "stylesheet" type = "text/css"  href="../css/style.css">
        <link rel = "stylesheet" type = "text/css"  href="../css/boot.css">
      
    </head>
        <body>
            <div class="container">
                <div class= "login-box">
                <div class= "row">
                    <div class= "col-md-6 login-left">
                    <h2><i>Login here</i></h2>
                    <form action ="login.php" method="post" >
					<div class="form-group">
                                <label>Email </label>
                                <input type ="text" name="email" class="form-control"  required>
                        </div>
                        <!-- <div class="form-group">
                                <label>Username </label>
                                <input type ="text" name="user" class="form-control" >
                        </div> -->
                        <div class="form-group">
                                <label>Password </label>
                                <input type ="password" name="pass" class="form-control" required>
						</div>
						
						<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							or sign up <a href="sign_up.php">here</a>
						</span>
                    </div>
					<div class="text-center p-t-46 p-b-20" style="margin-top:20px">
						<span class="txt2">
							<a href="reset_pass.php">Forgot Password?</a>
						</span>
                    </div>
                    <div class="container-login100-form-btn">
						<button style="margin-bottom:40px" class="login100-form-btn" type="submit" name="login">
							Login
						</button>
						<?php 
						$alert = "";
						echo $alert?>
					</div>
					</div>
                </form>
			</div>
		</div>
	    </div>
                
				<?php require '../head_foot/footer.php' ?>
              
