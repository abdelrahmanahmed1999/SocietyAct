<?php
session_start();  


session_unset(); 

// destroy the session 
session_destroy(); 


 echo"<script>self.location='logins.php'</script>";
?>
