<?php

if (!isset($_SESSION['logged_in']) || empty($_SESSION['logged_in'])) { 
     //header('Location: ../index.php'); 
	 die("::Access restricted to users logged in::");
} 

?>