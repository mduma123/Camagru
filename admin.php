<!-- Changing the credentials in the database (username, password and email) -->
<?php
	session_start();
	//only able to access this page if you're logged in
    if (!isset($_SESSION['id'])){
        header("location:/register/login.php");
    }
    require_once "database.php";
	$email = $_SESSION['id'];
	$mail = trim($_POST['email']);
    $username = trim($_POST['username']);
    $pass = sha1(trim($_POST['pass']));
    //reset password updating your password in the database
        if(isset($_POST['resetP'])){
        if($pass){
            $sql=$connection->prepare("update `users` set password='$pass' where email='$email'");
		    $sql->execute();
            $alert = "<h5 style='text-align:center;' class='text-default'>Password reset</h5>";
        }
    }
    //reset username updating your new username in the database
        if(isset($_POST['resetU'])){
        if($username){
            $sql=$connection->prepare("update `users` set username='$username' where email='$email'");
		    $sql->execute();
            $alert = "<h5 style='text-align:center;' class='text-default'>Username reset</h5>";
		}
	}
	//reset email updating your new email in the database
		if(isset($_POST['resetE'])){
			if($email){
				$sql=$connection->prepare("update `users` set email='$mail' where email='$email'");
				$sql->execute();
				$email = $mail;
				$alert = "<h5 style='text-align:center;' class='text-default'>Email reset</h5>";
			}
    }
?>
<!doctype html>
<html>
<html>
    <head>
        <title>Camagru</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/boot.css">
    </head>
    <body>
        <nav class="navbar navbar-light">
            <div class="navbar-header">
                <a class="navbar-brand" href="Gallery.php">Camagru</a>
            </div>
			<div style="position:absolute; right:2%;">
				<a class="navbar-nav" href="Gallery.php" style="margin:16px 5px">Gallery</a>
				<a class="navbar-nav" href="capture_upload.php" style="margin:16px 5px;">Capture or Upload </a>
				<a class="navbar-nav" href="registration/logout.php" style="margin:16px 0px">Logout <?php echo $_SESSION['id']?></a>
			</div>
        </nav>
        <h1 id="adminH">Change your username, password or email</h1>
                <form method="post" action="admin.php">
			    <div class="wrap-input100 validate-input" data-validate = "Username is required">
					<input class="input100" type="text" name="username" required>
					<span class="focus-input100"></span>
					<span class="label-input100">Change username</span>
                </div>
                <div class="container-login100-form-btn">
						<button style="margin-bottom:40px" class="login100-form-btn" type="submit" name="resetU">
							reset
						</button>
                    </div>
                </form>
				<form method="post" action="admin.php">
			    <div class="wrap-input100 validate-input" data-validate = "email is required">
					<input class="input100" type="text" name="email" required>
					<span class="focus-input100"></span>
					<span class="label-input100">Change email</span>
                </div>
                <div class="container-login100-form-btn">
						<button style="margin-bottom:40px" class="login100-form-btn" type="submit" name="resetE">
							reset
						</button>
                    </div>
                </form>
                <form method="post" action="admin.php">
				<div class="wrap-input100 validate-input" data-validate="Password is required">
					<input class="input100" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" type="password" id="psw" name="pass" required>
					<span class="focus-input100"></span>
					<span class="label-input100">Change password</span>
                </div>
                <div class="container-login100-form-btn">
						<button style="margin-bottom:40px" class="login100-form-btn" type="submit" name="resetP">
							reset
						</button>
                    </div>
                    <?php echo $alert ?>
               </form>
               <!-- Message is hidden until the input form password is clicked(onfocus)-->
               <div id="message">
							<h3>Password must contain the following</h3>
							<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
							<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
							<p id="number" class="invalid">A <b>number</b></p>
							<p id="length" class="invalid">Mininum <b>8 characters</b></p>
						</div>
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
				//valid and invalid style is in other.css
			}
		</script>
</body>
</html>