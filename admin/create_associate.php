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
<html lang="en">
<?php
/*
* Reference for tables: https://getbootstrap.com/docs/4.5/content/tables/
*/

session_start();
require_once('../config.php');
require_once('../validate_session.php');
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CSCI 467 Create Associate</title>

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
                        <i class="fas fa-user-tie mr-2"></i>Admin Dashboard
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

    <div style="margin-top: 20px" class="container">
        <h1>Create Associate</h1>
        <!-- styling of the form for bootstrap https://getbootstrap.com/docs/4.5/components/forms/ -->
        <form action="create_associate.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" type="text" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input class="form-control" type="password" id="new_password" name="new_password">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input class="form-control" type="text" id="address" name="address">
            </div>
            
            <div class="form-group">
                <input class="btn btn-primary" name='Submit' type="submit" value="Submit">
            </div>
        </form>
        <div>
            <br>
            <a href="admin_menu.php">Back to Admin Menu</a></br>
        </div>
            </div>
        </div>
    </main>


        <!-- jQuery and JS bundle w/ Popper.js -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    
    
    <?php
		
		 // Generate two random letters
		$alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomLetter1 = $alphabet[random_int(0, strlen($alphabet) - 1)];
		$randomLetter2 = $alphabet[random_int(0, strlen($alphabet) - 1)];

		// Generate six random numbers
		$randomNumber1 = random_int(0, 9);
		$randomNumber2 = random_int(0, 9);
		$randomNumber3 = random_int(0, 9);
		$randomNumber4 = random_int(0, 9);
		$randomNumber5 = random_int(0, 9);
		$randomNumber6 = random_int(0, 9);
		
		$associate_id = "".$randomLetter1."".$randomLetter2."-".$randomNumber1. "" . $randomNumber2 . "" . $randomNumber3 . "" . $randomNumber4 ."" .$randomNumber5 ."". $randomNumber6 ."";
		
        if (isset($_POST['Submit'])){
            /**
             * Grab information from the form submission and store values into variables.
             */ 
            $username = isset($_POST['username']) ? $_POST['username'] : " ";
            $new_pass = isset($_POST['new_password']) ? $_POST['new_password'] : " ";
            $address = isset($_POST['address']) ? $_POST['address'] : " ";
			
            //Insert into Student table;
            
			$query  = "INSERT INTO User (associate_id, Uusername, Upassword, address, commission)
                VALUES ('".$associate_id."', '".$username."', '".$new_pass."', '".$address."', 0.00)";

            // The query sent to the DB can be printed by not commenting the following row
            //echo $queryStudent;
            if ($conn->query($query) === TRUE) {
            echo "<br> New record created successfully for user";
            } else {
                echo "<br> The record was not created, the query: <br>" . $query . "  <br> Generated the error <br>" . $conn->error;	
            }
			header("Location: admin_menu.php");
}
?>


</body>

</html>

<?php
mysqli_close($conn2);
mysqli_close($conn);
?>