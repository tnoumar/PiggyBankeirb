<?php   
   // session_start();
    require_once "config.php";

    function logmeout(){
        //this function logs u out 
        alert("You have been logged out successfully");
        header("location:register.php");
        
        session_destroy();
        session_unset();
        unset($_SESSION["loggedin"]);
        $_SESSION=array();
        
      
      
    }
?>
