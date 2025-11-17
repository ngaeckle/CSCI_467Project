<!--
/**
 * CSCI 467 Intro to Software Engineering
 * @author For NIU by David Jones
 * @version 1.0
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 *
 */
-->
<?php

if (isset($_SESSION['logged_in']) || !empty($_SESSION['logged_in'])) {
     // if the user is logged in, restrict access to the page
     //header('Location: ../index.php'); 
	 die("::Access restricted to users logged in::");
} 

?>