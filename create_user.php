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

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CSCI 467 Create User Account</title>

  <!-- Bootstrap CSS library https://getbootstrap.com/ -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  
  <!-- Custom CSS for enhanced styling -->
  <style>
    .hero-section {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 80px 0;
      min-height: 100vh;
      display: flex;
      align-items: center;
    }
    .login-card {
      background: white;
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
      margin: 20px 0;
    }
    .login-title {
      color: #333;
      font-weight: bold;
      margin-bottom: 30px;
      text-align: center;
    }
    .form-control {
      border-radius: 10px;
      border: 2px solid #e9ecef;
      padding: 12px 15px;
      font-size: 1rem;
      transition: all 0.3s ease;
    }
    .form-control:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    .btn-login {
      background: linear-gradient(45deg, #667eea, #764ba2);
      border: none;
      padding: 12px 30px;
      font-size: 1.1rem;
      border-radius: 50px;
      transition: transform 0.3s ease;
      width: 100%;
      margin-top: 10px;
    }
    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(0,0,0,0.2);
    }
    .login-links {
      text-align: center;
      margin-top: 20px;
    }
    .login-links a {
      color: #667eea;
      text-decoration: none;
      margin: 0 10px;
      transition: color 0.3s ease;
    }
    .login-links a:hover {
      color: #764ba2;
      text-decoration: none;
    }
    .back-link {
      color: white;
      text-decoration: none;
      margin-top: 20px;
      display: inline-block;
      transition: color 0.3s ease;
    }
    .back-link:hover {
      color: #f8f9fa;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <!-- Hero Section -->
  <div class="hero-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
          <div class="login-card">
            <h1 class="login-title">
              <i class="fas fa-user-plus mr-2"></i>Create User Account
            </h1>
            <form action="create_user.php" method="post">
              <div class="form-group">
                <label for="username">
                  <i class="fas fa-user mr-1"></i>User Name
                </label>
                <input class="form-control" type="text" id="username" name="username" placeholder="Enter username">
              </div>
              <div class="form-group">
                <label for="password">
                  <i class="fas fa-lock mr-1"></i>Password
                </label>
                <input class="form-control" type="password" id="password" name="password" placeholder="Enter password">
              </div>
              <div class="form-group">
                <label for="address">
                  <i class="fas fa-map-marker-alt mr-1"></i>Address
                </label>
                <input class="form-control" type="text" id="address" name="address" placeholder="Enter address">
              </div>
              <div class="form-group">
                <input class="btn btn-login text-white" name='Submit' type="submit" value="Create Account">
              </div>
            </form>
            <div class="login-links">
              <a href="login.php">
                <i class="fas fa-sign-in-alt mr-1"></i>Already have an account? Sign in here
              </a>
            </div>
          </div>
          <div class="text-center">
            <a href="index.php" class="back-link">
              <i class="fas fa-arrow-left mr-1"></i>Back to Home
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery and JS bundle w/ Popper.js -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  
  <!-- Font Awesome for icons -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
        <!-- PhP code starts here -->
    <?php
     require_once('config.php');
	 
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
	
	$associate_id = "".$randomLetter1."".$randomLetter2."-".$randomNumber1. "" . $randomNumber2 . "" . $randomNumber3 . "" . $randomNumber4 ."" . $randomNumber5 ."". $randomNumber6 ."";
        
    if (isset($_POST['Submit'])){
    $username = isset($_POST['username']) ? $_POST['username'] : " ";
    $password = isset($_POST['password']) ? $_POST['password'] : " ";
	$address = isset($_POST['address']) ? $_POST['address'] : " ";
	
    $queryUser  = "INSERT INTO User (associate_id, Uusername, Upassword, address, commission)
                VALUES ('".$associate_id."', '".$username."', '".$password."', '".$address."', '0.00');";
    if ($conn->query($queryUser) === TRUE) {
       echo "New user created successfully with the username: ".$username."</p>";
    } else {
        echo "Error: " . $queryUser . "<br>" . $conn->error;
    }
}
?>


</body>

</html>
