<?php
    //If logout is clicked end the session and redirect back to the login page.
    session_start();
    if(session_destroy()){
        header("Location:login.php");
    }
?>