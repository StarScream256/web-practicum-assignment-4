<?php

include '../config/connection.php';

function index(): array {
  global $conn;

  $statement = $conn->prepare("SELECT * FROM users");
  $statement->execute();
  $result = $statement->get_result();
  $users = [];

  while ($row = $result->fetch_assoc()) {
    $users[] = $row;
  }

  return $users;
}

function createUser($username, $password) {
  global $conn;
  if (empty($username) || empty($password)) {
    $param = http_build_query([
      'error' => 'Username and password must be filled'
    ]);
    header("Location: ../views/register.php?$param");
    exit(); 
  }

  if (findUserByUsername($username) !== []) {
    $param = http_build_query([
      'error' => 'Username already used, please try another'
    ]);
    header("Location: ../views/register.php?$param");
    exit(); 
  }

  $passwordHash = password_hash($password, PASSWORD_DEFAULT);
  $statement = $conn->prepare("INSERT INTO users (username, password) VALUES(?, ?)");
  $statement->bind_param("ss", $username, $passwordHash);
  $statement->execute();

  $param = http_build_query([
    'success' => 'Registration success'
  ]);
  header("Location: ../views/login.php?$param");
  exit(); 

}

function findUserByUsername($username): array {
  global $conn;

  $statement = $conn->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
  $statement->bind_param("s", $username);
  $statement->execute();
  $result = $statement->get_result();
  return $result->fetch_assoc() ?? [];
}

function findUserById($id): array {
  global $conn;

  $statement = $conn->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
  $statement->bind_param("i", $id);
  $statement->execute();
  $result = $statement->get_result();
  return $result->fetch_assoc() ?? [];
}
