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
/*
* Reference for tables: https://getbootstrap.com/docs/4.5/content/tables/
*/

session_start();
require_once('../config.php');
require_once('../validate_session.php');
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
<b>List of finalized quotes:</b></header>

    <?php $sql = "SELECT * FROM quote WHERE status='(Finalized)'";
	$sql2 = "SELECT COUNT(*) AS numOfFinalized FROM quote WHERE status='(Finalized)'";
	$result2 = $conn->query($sql2);
    if ($result = $conn->query($sql)) {
    ?>
        <table class="table" width=50%>
            <thead>
                <td> ID</td>
                <td> Date</td>
                <td> Customer</td>
                <td> Associate</td>
				<td> Amount</td>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_row()) {
                ?>
                    <tr>
                    <td><?php printf("%s", $row[0]); ?></td>
                        <td><?php printf("%s", $row[1]); ?></td>
                        <td><?php printf("%s", $row[2]); ?></td>
                        <td><?php printf("%s", $row[3]); ?></td>
						<td><?php printf("$" ."%s", $row[6]); ?></td>
                        <td><a href="sanction_quote_interface.php?quote_id=<?php echo $row[0] ?>">Sanction</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    }
    ?>
	<b>Number of finalized quotes:</b>
	<?php
	$row=$result2->fetch_assoc();
	$num = $row["numOfFinalized"];
	echo $num;
	
	?>
	
	    <!-- Link to return to Associate_menu-->
    <br><a href="hq_menu.php">Back to HQ Menu</a><br>
    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
	</body>
            </div>
        </div>
    </main>



</html>

<?php
mysqli_close($conn2);
mysqli_close($conn);
?>