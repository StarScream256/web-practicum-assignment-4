<?php

require_once '../components/components.php';
require_once '../controllers/auth.php';
require_once '../controllers/todo.php';
require_once '../controllers/user.php';

isAuthenticated();
if (!isset($_GET['todoId'])) {
  header("Location: index.php");
}
$user = findUserByUsername($_SESSION['username']);
$todo = findTodoById($_GET['todoId'], $user['id_user']);
?>


<!DOCTYPE html>
<html lang="en">

<?= head("Edit task") ?>

<body class="ubuntu-regular text-sm min-h-svh bg-slate-200 flex items-center justify-center">
  <form action="../controllers/todo.php" method="post" class="w-1/2 flex bg-white shadow p-5 rounded-xl">
    <input type="hidden" name="action" value="edit-todo">
    <input type="hidden" name="todoId" value="<?= $_GET['todoId'] ?>">
    <input type="hidden" name="userId" value="<?= $user['id_user'] ?>">
    <div class="w-full h-auto flex flex-col gap-3">
      <span class="w-full h-fit flex justify-center flex-col gap-2 py-1 pb-3 border-b border-gray-500">
        <span class="text-center">
          <h1 class="text-lg font-bold">Edit task</h1>
          <p class="text-sm text-gray-500">Edit the task name and status</p>
        </span>
        <span id="banner-container">
          <?= banner($_GET['type'] ?? '', $_GET['message'] ?? '') ?>
        </span>
      </span>
      <div class="w-full flex flex-col gap-1 px-2">
        <label for="todo" class="text-sm font-medium">Todo title</label>
        <input
          type="text"
          id="todo"
          name="todo"
          placeholder="Todo title"
          value="<?= $todo['todo'] ?>"
          required
          class="w-full appearance-none px-2 py-1 rounded-md border border-gray-500 outline-2 outline-transparent focus:outline-sky-500">
      </div>
      <div class="w-full flex flex-col gap-1 px-2">
        <label for="status" class="text-sm font-medium">Status</label>
        <select name="status" id="status" class="w-full appearance-none px-2 py-1 rounded-md border border-gray-500 outline-2 outline-transparent focus:outline-sky-500">
          <option value="Pending" <?= ($todo['status'] === 'Pending') ? 'selected' : '' ?>>
            Pending
          </option>
          <option value="Done" <?= ($todo['status'] === 'Done') ? 'selected' : '' ?>>
            Done
          </option>
        </select>
      </div>
      <span class="w-full h-fit flex gap-2 justify-center mt-2">
        <a href="index.php" class="w-fit h-fit px-4 py-2 rounded-md bg-gray-200 hover:bg-gray-300 text-black font-medium cursor-pointer">Cancel</a>
        <button type="submit" class="w-fit h-fit px-4 py-2 rounded-md bg-blue-500 hover:bg-blue-600 text-white font-medium cursor-pointer">Update</button>
      </span>
    </div>
    
  </form>
</body>
</html>