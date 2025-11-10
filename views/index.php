<?php

require_once '../controllers/auth.php';
require_once '../components/components.php';
require_once '../controllers/todo.php';

isAuthenticated();
$user = findUserByUsername($_SESSION['username']);
?>

<html>

<?= head("To Do List", ["priority", "person", "logout", "forms_add_on", "search", "circle", "check_circle", "calendar_today", "edit", "delete", "list_alt"]) ?>

<body class="text-sm w-full min-h-svh bg-gray-200 flex gap-5 p-5 relative">
  <aside class="w-1/4 bg-white h-full rounded-xl shadow-lg p-3 sticky top-0 left-0 flex flex-col">
    <div class="w-full h-fit pb-2 flex gap-3 items-center border-b border-gray-500">
      <?= icon("priority") ?>
      <p class="text-lg font-bold pb-1">Todo App</p>
    </div>
    <div class="h-full w-auto flex flex-col justify-between">
      <div class="w-full flex flex-col gap-2 mt-3">
        <a href="" class="h-fit w-full bg-gray-100 hover:bg-blue-100 rounded-lg flex items-center gap-3 py-2 px-3">
          <?= icon("list_alt", "!text-2xl text-gray-700") ?>
          <span class="w-full flex justify-between">
            <p class="font-medium w-fit">All task</p>
            <p class="">7</p>
          </span>
        </a>
        <a href="" class="h-fit w-full bg-gray-100 hover:bg-green-100 rounded-lg flex items-center gap-3 py-2 px-3">
          <?= icon("check_circle", "!text-2xl text-gray-700") ?>
          <span class="w-full flex justify-between">
            <p class="font-medium w-fit">Done</p>
            <p class="">0</p>
          </span>
        </a>
        <a href="" class="h-fit w-full bg-gray-100 hover:bg-yellow-100 rounded-lg flex items-center gap-3 py-2 px-3">
          <?= icon("calendar_today", "!text-2xl text-gray-700") ?>
          <span class="w-full flex justify-between">
            <p class="font-medium w-fit">Pending</p>
            <p class="">1</p>
          </span>
        </a>
      </div>
      <div class="w-full h-fit flex flex-col gap-2">
        <a href="" class="h-fit w-full bg-gray-100 hover:bg-red-100 rounded-lg flex items-center gap-3 py-2 px-3">
          <?= icon("logout", "!text-2xl text-gray-700") ?>
          <p class="font-medium">Logout</p>
        </a>
        <div class="h-fit w-full bg-gray-100 rounded-lg flex items-center gap-3 py-2 px-3 border-[1.5px] border-transparent hover:border-gray-400">
          <span class="w-9 h-9 border-2 flex items-center justify-center rounded-md">
            <?= icon("person", "!text-2xl text-gray-700") ?>
          </span>
          <div class="h-fit flex flex-col">
            <p class="font-medium line-clamp-1 text-base"><?= $_SESSION['username'] ?></p>
            <p class="text-sm text-gray-500">User</p>
          </div>
        </div>
      </div>
    </div>
  </aside>  
  <div class="w-full flex flex-col gap-5">
    <header class="w-full h-fit p-2.5 bg-white shadow-lg rounded-xl flex items-center justify-between">
      <form action="" method="post" class="w-96 h-fit flex items-center gap-3 relative">
        <input type="text" name="search" placeholder="Search todo" class="w-full py-2 px-3 rounded-lg border-[1.5px] border-gray-500 appearance-none outline-2 outline-transparent focus:outline-blue-500">
        <button type="submit" class="hover:text-blue-500 absolute right-3 cursor-pointer">
          <?= icon("search", "!text-2xl") ?>
        </button>
      </form>
      <a href="tambah.php" class="flex items-center gap-2 w-fit h-fit py-1.5 px-2.5 rounded-lg bg-blue-500 hover:bg-blue-600 text-white">
        <?= icon("forms_add_on", "!text-xl") ?>
        <p class="font-medium">Add task</p>
      </a>
    </header>

    <div class="w-full h-fit flex flex-col gap-2">
      
      <?php
        $userId = findUserByUsername($_SESSION['username']);
        $todos = indexTodo($userId['id_user']);
        foreach ($todos as $todo) {
          $createdAt = new DateTime($todo['created_at']);
      ?>

          <div class="w-full h-fit bg-white shadow px-3 py-2 pr-22 rounded-lg flex items-start gap-3 relative">
            <?php $doneType = $todo['status'] === "Pending" ? "done" : "undone"; ?>
            <a href="../controllers/todo.php?action=done-todo&type=<?= $doneType ?>&todoId=<?= $todo['id_todo'] ?>&userId=<?= $user['id_user'] ?>" class="">
              <?php
                $doneIcon = $todo['status'] === "Pending" ? "circle" : "check_circle";
              ?>
              <?= icon("$doneIcon", "!text-xl") ?>
            </a>
            <div class="flex flex-col gap-1.5">
              <p class="font-medium text-base line-clamp-2"><?= $todo['todo'] ?></p>
              <span class="flex items-center gap-5">
                <span class="<?= $todo['status'] === 'Pending' ? 'bg-yellow-200' : 'bg-green-200' ?> px-2 pb-1 pt-0.5 rounded-md"><?= $todo['status'] ?></span>
                <span class="flex items-center gap-1">
                  <?= icon("calendar_today", "!text-lg") ?>
                  <p class=""><?= $createdAt->format('d F Y') ?></p>
                </span>
              </span>
            </div>
            <div class="absolute right-3 w-fit h-fit flex gap-1">
              <a href="edit.php?todoId=<?= $todo['id_todo'] ?>" class="h-fit w-fit px-2 py-1 hover:text-blue-600 hover:bg-blue-100 rounded-lg">
                <?= icon("edit", "!text-xl") ?>
              </a>
              <a href="../controllers/todo.php?action=remove-todo&todoId=<?= $todo['id_todo'] ?>&userId=<?= $user['id_user'] ?>" class="h-fit w-fit px-2 py-1 hover:text-red-600 hover:bg-red-100 rounded-lg">
                <?= icon("delete", "!text-xl") ?>
              </a>
            </div>
          </div>

      <?php
        }
      ?>
    </div>
  </div>
</body>
</html>