
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login || Code Camp BD</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

    <link rel="stylesheet" href="css/login.css">

    <style type="text/css">
    #buttn {
        color: #fff;
        background-color: #5c4ac7;
    }
    </style>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>
<body>
    <header id="header" class="header-scroll top-header headrom">
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/logo.png" alt="" width="18%"> </a>
                <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                        <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Restaurants <span class="sr-only"></span></a> </li>

                        <?php
						if(empty($_SESSION["user_id"]))
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
							}
						else
							{
									
									
										echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
									echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
							}

						?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div style=" background-image: url('images/img/pimg.jpg');">

        <?php
include("connection/connect.php"); 
error_reporting(0); 
session_start(); 
if(isset($_POST['submit']))  
{
	$username = $_POST['username'];  
	$password = $_POST['password'];
	
	if(!empty($_POST["submit"]))   
     {
	$loginquery ="SELECT * FROM users WHERE username='$username' && password='".md5($password)."'"; //selecting matching records
	$result=mysqli_query($db, $loginquery); //executing
	$row=mysqli_fetch_array($result);
	
	                        if(is_array($row)) 
								{
                                    	$_SESSION["user_id"] = $row['u_id']; 
										 header("refresh:1;url=index.php"); 
	                            } 
							else
							    {
                                      	$message = "Invalid Username or Password!"; 
                                }
	 }
	
	
}
?>
        <div class="pen-title">
            < </div>

                <div class="module form-module">
                    <div class="toggle">

                    </div>
                    <div class="form">
                        
                        <span style="color:red;"><?php echo $message; ?></span>
                        <span style="color:green;"><?php echo $success; ?></span>
                        <form action="email_forgotpass.php" method="post">
                        <h3>Forgate Password</h3>
         <input type="email" id="email" name="email" placeholder="Enter your email" class="box">
         <span id="email-error" class="error"></span>
         <!-- <input type="password" id="password" name="password" placeholder="Enter your password" class="box">
         <span id="password-error" class="error"></span>
         <input type="password" id="repassword" name="repassword" placeholder="Re-enter your password" class="box">
         <!--<span id="repassword-error" class="error"></span> -->
         <input type="submit" name="btn_forgot" value="Login Now" class="btn">
         <p>Don't have an account? <a href="registration.php">Register Now</a></p>
         
         <?php
// Include your database connection file here
// Replace 'your_database_connection.php' with the actual file name containing your database connection code
require_once 'connection/connect.php';

if(isset($_POST['email'])) {
    $email = $_POST['email'];

    // Perform your database query to check if the email exists
    // Replace this with your actual database query
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
      
        header("Location: pass_otp.php");
        exit(); // Stop further execution
    } else {
       
        header("Location: forgate.php");
        setcookie("error", "this email is not registered.", time() + 2, "/");

    }
} else {
   //  echo json_encode(array("status" => "error", "message" => "Email is required."));
    
}
?>
<?php
if(isset($_COOKIE['error'])) {
   
    echo $_COOKIE['error'];
} else {
    
}
?>                        </form>
                    </div>

                    <div class="cta">Not registered?<a href="registration.php" style="color:#5c4ac7;"> Create an account</a></div>
                </div>
                <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>


                <div class="container-fluid pt-3">
                    <p></p>
                </div>



                <?php include "include/footer.php" ?>

</body>

</html>


