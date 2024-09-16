<?php
include_once("registration.php");

$em = $_REQUEST['email'];
$token = $_REQUEST['token'];

// echo $em;
// echo $token;

$q = "select * from registration where email='$em' and token='$token'";
$result = mysqli_query($db, $q);
$count = mysqli_num_rows($result);

if ($count == 1) {
    while ($row = mysqli_fetch_array($result)) {
        $status = $row[8];
        if ($status == "Active") {

            $_SESSION['success'] = "Account is already activated";
        } else {
            $updt = "update registration set `status`='Active' where email='$em' and token='$token'";
            if (mysqli_query($db, $updt)) {
                setcookie('success', "Activation activated successfully", time() + 2, "/");
            } else {
                setcookie('error', "Error in activating Account. Please try again later.", time() + 2, "/");
            }
        }
?>
        <!-- <script>
            window.location.href = "login.php";
        </script> -->
    <?php
    header("Location: login.php");
    }
} else {
    setcookie('error', "Either Email is not registered or token is incorrect.", time() + 2, "/");
    ?>
    <!-- <script>
        window.location.href = "registration.php";
    </script> -->
<?php
header("Location: registration.php");
}