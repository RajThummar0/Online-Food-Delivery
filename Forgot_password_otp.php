<?php
include_once("login.php");

$em = $_SESSION['forgot_em'];
$token = $_SESSION['forgot_token'];
$q1 = "select * from `token` where email='$em' and token='$token'";
$result = mysqli_query($db, $q1);

if (isset($_POST['btn'])) {
    $otp = $_POST['otp'];
    while ($r = mysqli_fetch_array($result)) {
        if ($otp == $r[4]) {
?>
            <script>
                window.location.href = "new_password.php";
            </script>
        <?php
        } else {
            setcookie('error', 'Incorrect OTP', time() + 2, "/");
        ?>
<?php
header("Location: Forgot_password_otp.php");
        }
    }
}   