<?php
//Database Connection
$servername = "localhost";
$username = "u765616566_bakeryuser";
$password = "9;vJfy3j7DW?";
$dbname = "u765616566_Bakery";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
