<?php

require_once '../config/connection.php';
require_once 'user.php';

session_start();

function isAuthenticated() {
  $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
  if (!($username && findUserByUsername($username))) {
    session_unset();
    $param = http_build_query([
      'type' => 'error',
      'message' => 'You are not logged in'
    ]);
    header("Location: ../views/login.php?$param");
    exit();
  }
}

function login($username, $password) {
  if (!isset($username) || empty($username) || !isset($password) || empty($password)) {
    $param = http_build_query([
      'type' => 'error',
      'message' => 'Credentials incomplete'
    ]);
    header("Location: ../views/login.php?$param");
    exit();
  }

  $user = findUserByUsername($username);
  if ($user === []) {
    $param = http_build_query([
      'type' => 'error',
      'message' => 'User could not be found'
    ]);
    header("Location: ../views/login.php?$param");
    exit();
  }

  if (!password_verify($password, $user['password'])) {
    $param = http_build_query([
      'type' => 'error',
      'message' => 'Incorrect password'
    ]);
    header("Location: ../views/login.php?$param");
    exit();
  }

  $_SESSION['username'] = $username;
  header("Location: ../views/index.php");
}

function logout() {
  session_destroy();
  $param = http_build_query([
    'type' => 'success',
    'message' => 'You are logged out'
  ]);
  header("Location: ../views/login.php?$param");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'] ?? '';

  switch ($_POST['action']) {
    case 'login':
      login($_POST['username'], $_POST['password']);
      break;
  }
}
