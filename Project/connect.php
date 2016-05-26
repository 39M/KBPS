<?php
$con = mysqli_connect("localhost", "root", "", "KBPS_SYSTEM");
if(!$con) die("Couldn't connect mysql server: ".mysql_error());
if (!$con) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
mysqli_query($con, "set names 'utf8'");
?>
