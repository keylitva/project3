<?php
$servername = "localhost";
$username = "PII30064UR";
$password = "jkm_PII30064UR";
$dbname = "PII30064UR";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed". $conn->connect_error);
}

?>
