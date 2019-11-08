<?php
	require_once "../database.php";
	if (isset($_POST["submit"])){
		$email = trim($_POST['email']);
		$username = trim($_POST['username']);
		$password = sha1(trim($_POST['pass']));
		$check = $connection->prepare("SELECT `email` FROM `users` WHERE `email`=?");
		$check->bindValue(1, $email);
		$check->execute();
		if($_POST['email'] == "" || $_POST['username'] == "" || $_POST['pass'] == ""){
			$alert = "<h5 class='text-danger'>Please complete form<h5>";
		}
		elseif($check->rowCount() > 0){
			$alert = "<h5 class='text-danger'>Email provided is already in use<h5>";
		}
		else {
			//insert email, username and password to database as well as adding 0 to the verified variable. Send email to the user. The "verified" variable will change to 1, once the link that is sent to your email, is clicked.
			try{
			$connection->beginTransaction();
			$sql = "INSERT INTO users (username, email, password, verified) VALUES ('$username','$email','$password', 0);";
			$connection->exec($sql);

			$headers = 'FROM:Camagru';
			$message = " Congratulations $username, you are now registered!! 
			
			Please click on the link below to login
			
			http://127.0.0.1:8080/Camagru1/register/verify_email.php?email=$email";

			mail("$email", "Verify Camagru account", "$message", "$headers");
			
			$alert = "You have been registered! Please verify your email!";

			$connection->commit();
			}catch(PDOException $e){
				echo $sql . "\n" . $e->getMessage();
			}
		}
	}


?>
	<?php
			require_once "../database.php";
			$files = glob("uploads/*.*");
			usort($files,"date_sort");
			for($i = count($files) - 1; $i >= 0;$i--){
				$image = $files[$i];
				echo '
					<img style="inline:block; margin:43px auto 0px auto;" class="img-thumbnail center-block" src="'.$image.'" alt="Image"/>
					<form method="post" action="Gallery.php">
					<div class="form-group purple-border">
						<textarea rows="3" style="width:650px;margin-left:auto;margin-right:auto;" class="form-control" name="content" required></textarea>
					</div>
					<input type="hidden" name="imageN" value="'.$image.'">
					<button class="btn btn-info center-block" type="submit" name="comment">Comment</button>
					</form>

					<form method="post" action="Gallery.php">
					<button id="like" style="margin-top:10px;" class="btn btn-danger center-block" name="delete" type="submit"> DELETE</button>
					<input type="hidden" name="imageN" value="'.$image.'">
					<button id="like" style="margin-top:10px;" class="btn btn-primary center-block" name="liked" type="submit"><i class="glyphicon glyphicon-thumbs-up"></i> LIKE</button>
				
					</form>

				';
				//get likes from the database and add each comment is added to the image.
			   
				//get comments from the database and add the likes to the associated image
				
			}
			echo $alert
		?>

<html>
    <head>
        <center><h1 style="font-size:60px; color:green; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;"><i>Welcome to Camagru</i></h1></center>
        <title>Registration</title>
        <link rel = "stylesheet" type = "text/css"  href="../css/style.css">
        <link rel = "stylesheet" type = "text/css"  href="../css/boot.css">
      
    </head>
        <body>
            <div class="container">
                <div class= "login-box">
                <div class= "row">
                    <div class= "col-md-6 login-right">
				
                        <h2><i>Register Here</i></h2>
                        <form action="sign_up.php " method="post">
                            <div class="form-group">
                                    <label>Username </label>
                                    <input type ="text" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                    <label>Password </label>
                                    <input type ="password"  id= "psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" type="password" name="pass" class="form-control" required>
                            </div>
                            <div class="form-group">
                                    <label>Email </label>
									<input type ="email" name="email" class="form-control" >
									<br>
							</div>
							</div>
                    
                    <div class="text-center p-t-46 p-b-20">
						<span class="txt2">
						or sign in <a href="login.php">here</a>
						</span>
                    </div>
                    <div class="container-login100-form-btn">
						<button style="margin:20px 0px 40px 0px" class="login100-form-btn" type="submit" name="submit">
							Register
						</button>
						<?php echo $alert;?>
							
</div>
                </div>
<!-- Message is hidden until the input form password is clicked(onfocus)-->
                                                        <div id="message">
							<h3>Password must contain the following</h3>
							<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
							<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
							<p id="number" class="invalid">A <b>number</b></p>
							<p id="length" class="invalid">Mininum <b>8 characters</b></p>
						</div>
                           
                        </form>
                    </div>
			</div>
			
</div><br>
<div style="padding:30px;background-color:green; margin-top:40px;">
            <h5 style="text-align:center;"><i>Copyright 2019. Camagru.com. All Rights Reserved</i></h5>
        
    </body>
</html>

            <script>
		/*This script checks the password input for each of these conditions: if the input contains a lowercase letter, uppercase letter
		a number with at least 8 characters. 
		If any of these conditions are met in the input field, remove the invalid classes and add the valid classes on the right p tag.
		*/
			var myInput = document.getElementById("psw");
			var letter = document.getElementById("letter");
			var capital = document.getElementById("capital");
			var number = document.getElementById("number");
			var length = document.getElementById("length");
			//when an input field is clicked on(onfocus), display id=message
			myInput.onfocus = function() {
				document.getElementById("message").style.display = "block";
			}
			//when a user leaves the input field, remove id=message
			myInput.onblur = function(){
				document.getElementById("message").style.display = "none";
			}
			/*when a user releases a key
			*/
			myInput.onkeyup = function() {
				//find any of the characters between the brackets and add to variable
				var lowerCaseLetters = /[a-z]/g;
				//if the the input contains a lowercase letter add valid class, remove invalid class on id="letter"
				if (myInput.value.match(lowerCaseLetters)){
					letter.classList.remove("invalid");
					letter.classList.add("valid");
				}else {
					letter.classList.remove("valid");
					letter.classList.add("invalid");
				}
				//find any of the characters between the brackets and add to variable
				var upperCaseLetters = /[A-Z]/g;
				//if the the input contains a uppercase letter add valid class, remove invalid class on id="capital"
				if(myInput.value.match(upperCaseLetters)) {  
    				capital.classList.remove("invalid");
    				capital.classList.add("valid");
  				} else {
    				capital.classList.remove("valid");
    				capital.classList.add("invalid");
  				}
				//find any of the characters between the brackets and add to variable
				var numbers = /[0-9]/g;
				//if the the input contains a number add valid class, remove invalid class on id="number"
				if(myInput.value.match(numbers)){
					number.classList.remove("invalid");
					number.classList.add("valid");
				}else {
					number.classList.remove("valid");
					number.classList.add("invalid");
				}
				//if the length of character is less than 7 remove valid class, add invalid class and vice versa on id="length"
				if (myInput.value.length >= 8){
					length.classList.remove("invalid");
					length.classList.add("valid");
				}else{
					length.classList.remove("valid");
					length.classList.add("invalid");
				}
				//valid and invalid style is in style.css
			}
		</script>
	




