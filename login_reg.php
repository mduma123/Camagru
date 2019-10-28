<html>
    <head>
        <center><h1 style="font-size:60px; color:green; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;"><i>Welcome to Camagru</i></h1></center>
        <title>User Login and Registration</title>
        <link rel = "stylesheet" type = "text/css"  href="style.css">
      
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
                                <input type ="text" name="user" class="form-control" required>
                        </div>
                        <div class="form-group">
                                <label>Password </label>
                                <input type ="password" name="password" class="form-control" required>
                        </div>
                        <input type="submit" name="submit" class= "btn btn_primary" value="Login" />
                        <!-- <button type ="submit" class= "btn btn_primary">Login</button> <br\> -->
                
                <!-- <button type ="submit" class= "btn btn_primary">Forgotten Password?</button> -->
                        </form>
                </div>

               <div class= "col-md-6 login-right">
                        <h2><i>Register Here</i></h2>
                        <form action="reg.php" method="post">
                            <div class="form-group">
                                    <label>Username </label>
                                    <input type ="text" name="user" class="form-control">
                            </div>
                            <div class="form-group">
                                    <label>Password </label>
                                    <input type ="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                    <label>Email </label>
                                    <input type ="text" name="email" class="form-control">
                            </div>
                            <input type="submit" name="submit" class= "btn btn_primary" value="Register" />
                            <!-- <button type ="submit" class= "btn btn_primary">Register</button> -->
                        </form>
                    </div>
            </div>
            <footer>
                        <p style= "font-size:30px; color:aqua"; align="right"><font face="monospace" > &copy 2019 Camagru</p> </font>
            </footer>

        </body>
</html>