<?php

include 'db_config.php';

$conn_status = "Pending";
$conn = null;

try {
  $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $conn_status = "\nConnected";
  if (!$conn) {
    $conn_status = "\nConnection failed";
  }
} catch (Exception $e) {
  $conn_status = "\nAn error occurred";
}
