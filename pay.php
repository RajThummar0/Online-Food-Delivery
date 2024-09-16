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
// Start the session
session_start();

include 'connection/connect.php';
require_once 'vendor/autoload.php'; // Include the Razorpay library

use Razorpay\Api\Api;

$api_key = 'rzp_test_opkNn6lG4X2KTQ';
$api_secret = 'pMbWs8BTUwqJWGYSNR7hNi0m';

// Check if the total is set in the session
if(isset($_SESSION['total'])) {
    $total = $_SESSION['total'];
} else {
    // Set a default value if total is not set
    $total = 0;
}

$api = new Api($api_key, $api_secret);

// Create a new order
$order = $api->order->create(array(
    'receipt' => 'order_rcptid_' . time(),
    'amount' => $total * 100, // Amount in paise
    'currency' => 'INR'
));

$order_id = $order->id;
$_SESSION['order_id'] = $order_id;

?>
<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <form action="payment_action.php" method="POST">
                <h1>Paying to raj thummar</h1>
                <div class="form-group">
                    <label for="total1">Net Payable Amount</label>
                    <input type="text" class="form-control" name="total" id="total1" value="<?php echo $total; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="total1">Order ID</label>
                    <input type="text" class="form-control" name="total" id="total1" value="<?php echo $order_id ?>" disabled>
                </div>
                <script src="https://checkout.razorpay.com/v1/checkout.js"
                    data-key="<?php echo $api_key; ?>"
                    data-amount="<?php echo $total * 100; ?>"
                    data-currency="INR"
                    data-order_id="<?php echo $order_id; ?>"
                    data-buttontext="Pay"
                    data-name="raj thummar"
                    data-description="Test Transaction"
                    data-image="C:/xampp/htdocs/janki mem/food/images/logo.png"
                    data-prefill.name="raj thummar"
                    data-prefill.email="rthummar308@rku.ac.in"
                    data-prefill.contact="9016412305"
                    data-theme.color="#3b5998">
                </script>
                <input type="hidden" custom="Hidden Element" name="hidden">
            </form>
        </div>
    </div>

</div>
<br>
<br>
<br>
<br>
<br>

<br>
<br>
<br>
<br>
<?php include "include/footer.php" ?>


</body>
</hmtl>
