<?php

include '../config/connection.php';
include './user.php';

session_start();

function isAuthenticated() {
  $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
  if ($username && findUserByUsername($username)) {
    return true;
  } else {
    session_unset();
    $param = http_build_query([
      'error' => 'You are not logged in'
    ]);
    header("Location: ../views/login.php?$param");
    exit();
  }
}
