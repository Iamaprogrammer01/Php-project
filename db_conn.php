<?php

$sname= "localhost";
$uname= "root";
$password = "";

$conn = mysqli_connect($sname, $uname, $password);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_select_db($conn,'system');

?>