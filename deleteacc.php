<?php
session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
    header("Location: index.php");
}
$conn = new mysqli("dockerDB","root","password","myDB");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$username = $_SESSION['username'];
$sql = "DELETE from users WHERE nickname = '$username'";
if ($conn->query($sql) == TRUE) {
    echo "Successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
session_destroy();
header("Location: index.php");
