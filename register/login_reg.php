<html>
    <head>
        <center><h1 style="font-size:60px; color:green; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;"><i>Welcome to Camagru</i></h1></center>
        <title>User Login and Registration</title>
        <link rel = "stylesheet" type = "text/css"  href="../css/style.css">
        <link rel = "stylesheet" type = "text/css"  href="../css/boot.css">
      
    </head>
        <body>
            <div class="container">
                <div class= "login-box">
                <div class= "row">
                    <div class= "col-md-6 login-left">
                    <h2><i>Login here</i></h2>
                    <form action ="login.php" method="post">
                        <div class="form-group">
                                <label>Username </label>
                                <input type ="text" name="user" class="form-control" >
                        </div>
                        <div class="form-group">
                                <label>Email </label>
                                <input type ="text" name="email" class="form-control" >
                        </div>
                        <div class="form-group">
                                <label>Password </label>
                                <input type ="password" name="password" class="form-control" >
                        </div>
                        <input type="submit" name="submit" class= "btn btn_primary" value="Login" />
                        <!-- <button type ="submit" class= "btn btn_primary">Login</button> <br\> -->
                        <a style="font-size:20px;" class="btn btn_primary" href="forgot_pass.php">Forgotten Password?</a>
                
                <!-- <input type ="submit" name= "forgot" class= "btn btn_primary" value="Forgotten Password?" /> -->
                        </form>
                </div>
                </div>

               <div class= "col-md-6 login-right">
                        <h2><i>Register Here</i></h2>
                        <form action="reg.php " method="post">
                            <div class="form-group">
                                    <label>Username </label>
                                    <input type ="text" name="user" class="form-control">
                            </div>
                            <div class="form-group">
                                    <label>Password </label>
                                    <input type ="password"  id= "psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                    <label>Email </label>
                                    <input type ="text" name="email" class="form-control">
                            </div>
                            <input type="submit" name="submit" class= "btn btn_primary" value="Register" />
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

        </body>
</html>