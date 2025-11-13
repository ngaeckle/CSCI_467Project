<!--
/**
 * CSCI 467 Intro to Software Engineering
 * @author For NIU by David Jones
 * @version 1.0
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 *
 */
-->
<!doctype html>
<?php
session_start();
require_once('../config.php');
require_once('../validate_session.php');
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CSCI 467 Create Quote</title>

    <!-- Importing Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>

<body>
	<?php
    if (isset($_POST['submitButton'])) {
		$_SESSION['customer_var'] = $_POST['myDropdown'];
        // Further processing with $selectedValue can be done here
        // e.g., database operations, conditional logic, etc.	
	}
	$customer = $_SESSION['customer_var'];
	$sql = "SELECT city, street, contact FROM customers WHERE name='" .$customer . "';";
	
	$result = $conn2->query($sql);
	
	
	while($row = mysqli_fetch_assoc($result)){
		$city = $row['city'];
		$street = $row['street'];
		$contact = $row['contact'];
	}
	
	$address = $city . " " . $street . " " . $contact . " ";
	$_POST['address'] = $address;
    ?>
	
    <div style="margin-top: 20px" class="container">
        <h4>Order From: <?php echo htmlspecialchars($customer);?></h1>
        <!-- styling of the form for bootstrap https://getbootstrap.com/docs/4.5/components/forms/ -->
        <form action="create_quote.php" method="post">
            <div class="form-group">
                <?php echo $city . "<br>";
				echo $street . "<br>";
				echo $contact . "<br>";
				?>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="text" id="email" name="email">
            </div>
			<div class="form-group">
                <label for="line_item">Line Item</label>
                <input class="form-control" type="text" id="line_item" name="line_item">
            </div>
            <div class="form-group">
                <label for="line_item_price">Line Item Price</label>
                <input class="form-control" type="text" id="line_item_price" name="line_item_price">
            </div>
			<div class="form-group">
                <label for="secret_note">Secret Note</label>
                <input class="form-control" type="text" id="secret_note" name="secret_note">
            </div>
 			<div class="form-group">
                <label for="amount">Amount</label>
                <input class="form-control" type="text" id="amount" name="amount">
            </div>
			
            <div class="form-group">
                <input class="btn btn-primary" name='Submit' type="submit" value="Submit">
            </div>
        </form>
		<div>
            <br>
            <a href="Associate_menu.php">Back to Associate Menu</a></br>
        </div>

        <!-- jQuery and JS bundle w/ Popper.js -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    
    
    <?php
        if (isset($_POST['Submit']) || isset($_POST['Finalized'])){
			$currentYear = date('Y');
			$currentMonth = date('m');
			$currentDay = date('d');
		
			$dateCurrent = date('Y-m-d');
			
			if(isset($_POST['Submit'])){
				$status = '(Open)';
			}
			else if(isset($_POST['Finalized'])){
				$status = '(Finalized)';
			}
    
            /**
             * Grab information from the form submission and store values into variables.
             */
            $customer = isset($_SESSION['customer_var']) ? $_SESSION['customer_var'] : " "; 
			$associate = $_SESSION['user'];			
            $address = isset($_POST['address']) ? $_POST['address'] : " ";
            $email = isset($_POST['email']) ? $_POST['email'] : " ";
            $line_item = isset($_POST['line_item']) ? $_POST['line_item'] : " ";
			$line_item_price = isset($_POST['line_item_price']) ? $_POST['line_item_price'] : " ";
			$secret_note = isset($_POST['secret_note']) ? $_POST['secret_note'] : " ";
			$amount = isset($_POST['amount']) ? $_POST['amount'] : " ";
            
            //Insert into Quote table;
            
            $queryQuote  = "INSERT INTO quote (event_date, customer, associate, address, email, line_item, line_item_price, secret_note, amount, status)
                        VALUES ('".$dateCurrent."', '".$customer."', '".$associate."', '".$address."', '".$email."', '".$line_item."', '".$line_item_price."', '".$secret_note."', '".$amount."', '".$status."');";

            // The query sent to the DB can be printed by not commenting the following row
            //echo $queryAssociate;
            if ($conn->query($queryQuote) === TRUE) {
            echo "<br> New record created successfully for Quote Customer ".$customer;
            } else {
                echo "<br> The record was not created, the query: <br>" . $queryQuote . "  <br> Generated the error <br>" . $conn->error;
            }
		}
?>


</body>

</html>
