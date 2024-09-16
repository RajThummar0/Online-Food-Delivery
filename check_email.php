<?php
include_once("connection/connect.php");

$em = $_REQUEST['email'];
$q = "select * from registration where email='$em'";
$result = mysqli_query($db, $q);
$count = mysqli_num_rows($result);

if ($count == 1) {  
    echo "email registered";
}