<?php

require_once '../config/connection.php';
require_once 'user.php';

function indexTodo($userId, $status = 'all', $search = ''): array {
  global $conn;

  $sql = "SELECT * FROM todo WHERE id_user = ?";
  $params = [$userId];
  $types = "i";

  if ($status === 'Done' || $status === 'Pending') {
    $sql .= " AND status = ?";
    $params[] = $status;
    $types .= "s";
  }

  if (!empty($search)) {
    $sql .= " AND todo LIKE ?";
    $params[] = "%" . $search . "%";
    $types .= "s";
  }

  $sql .= " ORDER BY created_at DESC";

  $statement = $conn->prepare($sql);
  $statement->bind_param($types, ...$params);
  $statement->execute();
  $result = $statement->get_result();
  $todos = [];

  while ($row = $result->fetch_assoc()) {
    $todos[] = $row;
  }

  return $todos;
}

function createTodo($todo, $status, $username) {
  global $conn;

  $user = findUserByUsername($username);

  $statement = $conn->prepare("INSERT INTO todo (todo, status, id_user) VALUES(?, ?, ?)");
  $statement->bind_param("ssi", $todo, $status, $user['id_user']);
  $statement->execute();

  header("Location: ../views/index.php");
  exit();
}

function updateTodo($todo, $status, $todoId, $userId) {
  global $conn;

  $statement = $conn->prepare("UPDATE todo SET todo = ?, status = ? WHERE id_todo = ? AND id_user = ? ");
  $statement->bind_param("ssii", $todo, $status, $todoId, $userId);
  $statement->execute();

  header("Location: ../views/index.php");
  exit();
}

function doneTodo($type, $todoId, $userId) {
  global $conn;

  $statement = $conn->prepare("UPDATE todo SET status = ? WHERE id_todo = ? AND id_user = ? ");
  $status = $type === "done" ? "Done" : "Pending";
  $statement->bind_param("sii", $status, $todoId, $userId);
  $statement->execute();

  header("Location: ../views/index.php");
  exit();
}

function findTodoById($id): array {
  global $conn;

  $statement = $conn->prepare("SELECT * FROM todo WHERE id_todo = ? LIMIT 1");
  $statement->bind_param("i", $id);
  $statement->execute();
  $result = $statement->get_result();
  return $result->fetch_assoc() ?? [];
}

function removeTodo($todoId, $userId) {
  global $conn;

  $statement = $conn->prepare("DELETE FROM todo WHERE id_todo = ? AND id_user = ?");
  $statement->bind_param("ii", $todoId, $userId);
  $statement->execute();

  header("Location: ../views/index.php");
  exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'] ?? '';

  switch ($action) {
    case 'create-todo':
      createTodo($_POST['todo'], $_POST['status'], $_POST['username']);
      break;
    case 'edit-todo':
      updateTodo($_POST['todo'], $_POST['status'], $_POST['todoId'], $_POST['userId']);
      break;
  }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $action = $_GET['action'] ?? '';

  switch ($action) {
    case 'remove-todo':
      $todoId = isset($_GET['todoId']) ? (int)$_GET['todoId'] : 0;
      $userId = isset($_GET['userId']) ? (int)$_GET['userId'] : 0;
      if ($todoId > 0 && $userId > 0) {
        removeTodo($todoId, $userId);
      } else {
        header("Location: ../views/index.php");
        exit();
      }
      break;
    case 'done-todo':
      $type =  $_GET['type'];
      $userId = isset($_GET['userId']) ? (int)$_GET['userId'] : 0;
      $todoId = isset($_GET['todoId']) ? (int)$_GET['todoId'] : 0;
      doneTodo($type, $todoId, $userId);
      break;
  }
}