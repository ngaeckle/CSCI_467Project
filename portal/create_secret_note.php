<?php
session_start();
require_once('../config.php');
require_once('../validate_session.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$string = $_POST['my_secret_note'];
	
	$quote_id = $_SESSION['quoteid'];
	
	$sql = "INSERT INTO secret_notes(secret_noteSTRING, quote_id) VALUES('$string', $quote_id)";
	
	if($conn->query($sql) === TRUE){
		echo "Secret note added successfully";
		header("Location: update_quote_interface.php?quote_id=$quote_id");
	} else{
		echo "Error creating secret note";
	}
	
	$conn->close();
}
?>

<?php
mysqli_close($conn2);
mysqli_close($conn);
?>