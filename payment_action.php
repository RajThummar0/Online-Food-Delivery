<?php
// Start the session
session_start();
include 'connection/connect.php';

$email = isset($_SESSION['email']) ? $_SESSION['email'] : "";
$order_id = isset($_SESSION['order_id']) ? $_SESSION['order_id'] : "";
$total = isset($_SESSION['total']) ? $_SESSION['total'] : "";

if (empty($email) || empty($order_id) || empty($total)) {
    // Redirect to an error page or handle the situation accordingly
    header("Location: your_orders.php");
    exit; // Stop further execution
}

$q = "SELECT * FROM users_orders WHERE User_email='$email'";
$result = mysqli_query($bd, $q);

while ($row = mysqli_fetch_array($result)) {
    $ord_date = date('Y-m-d');
    $q   = "INSERT INTO `orders`(`o_id`, `u_id`,`title`, `quantity`, `price`, `status`, `date`, `payment_status`) VALUES ($row[2],'$email',
    $row[3],$row[4],'$ord_date','$order_id','Confirmed','Paid')";
    if (mysqli_query($bd, $q)) {
        setcookie("success", 'Order Placed successfully', time() + 2, "/");
    } else {
        setcookie('error', 'Error in placing Order', time() + 2, "/");
    }
    $sql_delete = "DELETE FROM Shopping_cart WHERE User_email='$email' AND product_id=$row[2]";
    mysqli_query($bd, $q_delete);
}

// Redirect after processing orders
header("Location: your_orders.php");
exit; // Stop further execution
?>
