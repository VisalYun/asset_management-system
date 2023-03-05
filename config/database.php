<?php
define("DB_HOST", "146.190.97.61");
define("DB_USER", "app_user");
define("DB_PASS", "zq4odp]J*8!JFwIe");
define("DB_NAME", "asset_managment_system");

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// echo 'Connected successfully';
?>