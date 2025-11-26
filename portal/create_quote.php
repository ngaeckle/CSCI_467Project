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
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin: 0;
        }
        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
        }
        .main-content {
            padding: 40px 0;
            min-height: calc(100vh - 100px);
        }
        .content-area {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            min-height: 400px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="header-title">
                        <i class="fas fa-user-tie mr-2"></i>Associate Dashboard
                    </h1>
                </div>
                <div class="col-auto">
                    <a href="logout.php" class="logout-btn">
                        <i class="fas fa-sign-out-alt mr-1"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="main-content">
        <div class="container">
            <div class="content-area">
                <!-- Content will be displayed here -->
<?php
	$sql = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'csci_467' AND TABLE_NAME = 'quote'";
	
	$result = $conn->query($sql);
	$row=$result->fetch_assoc();
	
	$quote_id = $row["AUTO_INCREMENT"];

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
			
			<form method="post" action="create_line_item.php">
				<label for "line_item">Line Item: </label><br>
				<input type="text" id="item_name" name="item_name" placeholder="Enter Item Name">
				<input type="text" id="item_price" name="item_price" placeholder="Enter Item Price">
				<input type="submit" name="line_item" value="New Item">
			</form>
			
			<?php 
			$sql = "SELECT q.quote_id AS quote_id, l.line_itemName AS item_name FROM Quote q LEFT JOIN line_items l ON q.quote_id = l.quote_id ORDER by l.line_itemName, l.line_itemPrice";
			
			$result = $conn->query($sql);
			
			echo var_dump($result);
			?>
			
			<form method="post" action="create_secret_note.php">
				<label for "secret_note"> Note: </label><br>
				<input type="text" id="secret_note" name="secret_note" placeholder= "Enter Note">
				<input type="submit" name="secret_note" value="New Note">
			</form>
			
			<?php 
			"SELECT q.quote_id AS quote_id, n.secret_noteSTRING AS note_STRING FROM Quote q LEFT JOIN secret_notes n ON q.quote_id = n.quote_id ORDER by n.secret_noteSTRING";
			
			$result = $conn->query($sql);
			
			echo var_dump($result);
		
			?>
			
 			<div class="form-group">
                <label for="amount">Amount:</label>
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
			$amount = isset($_POST['amount']) ? $_POST['amount'] : " ";
            
            //Insert into Quote table;

			$queryQuote = "UPDATE quote SET event_date = '$dateCurrent', customer = '$customer', associate = '$associate', address = '$address', email = '$email', amount = '$amount', '$status', WHERE quote_id = '$quote_id'";
			
 //           $queryQuote  = "INSERT INTO quote (event_date, customer, associate, address, email, amount, status)
 //                       VALUES ('".$dateCurrent."', '".$customer."', '".$associate."', '".$address."', '".$email."','".$amount."', '".$status."');";

            // The query sent to the DB can be printed by not commenting the following row
            if ($conn->query($queryQuote) === TRUE) {
            echo "<br> New record created successfully for Quote Customer ".$customer;
            } else {
                echo "<br> The record was not created, the query: <br>" . $queryQuote . "  <br> Generated the error <br>" . $conn->error;
            }
		}
?>
            </div>
        </div>
    </main>
</body>

</html>


<?php
mysqli_close($conn2);
mysqli_close($conn);
?>