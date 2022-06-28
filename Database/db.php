<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "crud_all_fields";
$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
echo "Connected Sucessfully";
