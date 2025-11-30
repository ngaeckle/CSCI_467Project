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
session_start();
require_once('../config.php');
require_once('../validate_session.php');

if (isset($_GET['quote_id'])) {
    $quoteid = $_GET['quote_id'];
    $sql = "SELECT * FROM quote WHERE quote_id = $quoteid";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);
}
else {
    echo "No user id received on request at update_quote_interface get";
    die();
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CSCI 467 Quote Sanction</title>
	
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
                        <i class="fas fa-user-tie mr-2"></i>Headquarters
                    </h1>
					
                </div>
                <div class="col-auto">
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="main-content">
        <div class="container">
            <div class="content-area">
                <!-- Content will be displayed here -->
    <div style="margin-top: 20px" class="container">
        <h1>Sanction Quote</h1>
        <!-- styling of the form for bootstrap https://getbootstrap.com/docs/4.5/components/forms/ -->
        <!-- Displaying a form with the information of the user so values can be modified 
             Note that the ID is not shown to be modified, only other attributes. -->

        <form action="sanction_quote.php" method="post">
			<input type="hidden" name="quote_id" id="quote_id" value="<?php echo $row['quote_id'] ?>">
			<div class="form-group">
                <label for="customer"><b>Customer:</b></label>
				<br>
                <?php echo $row['customer'];
				  echo "<br>"; ?>
            </div>
            <div class="form-group">
                <label for="address"><b>Address:</b></label>
				<br>
                <?php
					echo $row['address'];?>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="text" id="email" name="email" value="<?php echo $row['email'] ?>">
            </div>
			<label for="Line Items">Line Items:</label>
			<br>
			<?php 
			$sql = "SELECT q.quote_id AS quote_id, l.line_itemName AS name, l.line_itemID AS item_id, l.line_itemPrice AS price FROM Quote q LEFT JOIN line_items l ON q.quote_id = l.quote_id WHERE q.quote_id = $quoteid ORDER by l.line_itemName, l.line_itemPrice";
			
			$result = $conn->query($sql);
			$price = 0;
			while($data = $result->fetch_assoc()){
				echo "<input type=text placeholder= " . '"' . $data["name"] . '"' . " disabled>";
				echo "<input type=text placeholder= " . '"' . $data["price"] . '"' . " disabled>";
				if($data["item_id"] != ''){
					echo "<a href=delete_line_item.php?item_id=". $data["item_id"] . ">Delete</a></td>";
				}
				echo "<br>\n";
					$price = $data["price"] + $price;
				}
			$conn->query($sql);
			?>
			
			<label for="Line Items">Secret Notes:</label>
			<br>
			
			<?php 
			$sql = "SELECT q.quote_id AS id, n.secret_noteID AS note_id, n.secret_noteSTRING AS note FROM quote q LEFT JOIN secret_notes n ON q.quote_id = n.quote_id WHERE q.quote_id = $quoteid ORDER by n.secret_noteSTRING";
			
			$result = $conn->query($sql);
			while($data = $result->fetch_assoc()){
				echo "<input type=text placeholder= " . '"' . $data["note"] . '"' . " disabled>";
				if($data["note_id"] != ''){
					echo "<a href=delete_note.php?note_id=". $data["note_id"] . ">Delete</a></td>";
				}
				echo "<br>\n";
				}
			?>
			
			<div class="form-group">
                <label for="amount"><b>Amount: </b></label><?php echo ' ' . $row['amount'] ?>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" name='Submit' type="submit" value="Sanction Quote">
            </div>
        </form>
        <div>
            <br>
            <a href="view_finalized_quote.php">Back to Finalized Quotes</a></br>
        </div>

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
	</body>
            </div>
        </div>
    </main>

</body>



</html>

<?php
mysqli_close($conn2);
mysqli_close($conn);
?>