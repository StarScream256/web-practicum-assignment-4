<?php

require_once '../components/components.php';
?>


<!DOCTYPE html>
<html lang="en">

<?= head("Registration") ?>

<body class="ubuntu-regular text-sm min-h-svh bg-slate-200 flex items-center justify-center">
  <form action="../controllers/user.php" method="post" class="w-1/2 flex bg-white shadow p-5 rounded-xl">
    <input type="hidden" name="action" value="create">
    <div class="w-full h-auto flex flex-col gap-3">
      <span class="w-full h-fit flex justify-center flex-col gap-2 py-1 pb-3 border-b border-gray-500">
        <span class="text-center">
          <h1 class="text-lg font-bold">Registration</h1>
          <p class="text-sm text-gray-500">Enter your details to register</p>
        </span>
        <span id="banner-container">
          <?= banner($_GET['type'] ?? '', $_GET['message'] ?? '') ?>
        </span>
      </span>
      <div class="w-full flex flex-col gap-1 px-2">
        <label for="username" class="text-sm font-medium">Username</label>
        <input
          type="text"
          id="username"
          name="username"
          placeholder="Username"
          required
          class="w-full appearance-none px-2 py-1 rounded-md border border-gray-500 outline-2 outline-transparent focus:outline-sky-500">
      </div>
      <div class="w-full flex flex-col gap-1 px-2">
        <label for="password" class="text-sm font-medium">Password</label>
        <input
          type="password"
          id="password"
          name="password"
          placeholder="Password"
          required
          class="w-full appearance-none px-2 py-1 rounded-md border border-gray-500 outline-2 outline-transparent focus:outline-sky-500">
      </div>
      <div class="w-full flex flex-col gap-1 px-2">
        <label for="confirm_password" class="text-sm font-medium">Confirm password</label>
        <input
          type="password"
          id="confirm_password"
          name="confirm_password"
          placeholder="Confirm password"
          required
          class="w-full appearance-none px-2 py-1 rounded-md border border-gray-500 outline-2 outline-transparent focus:outline-sky-500">
      </div>
      <span class="w-full h-fit flex gap-2 justify-center mt-2">
        <button type="reset" class="w-fit h-fit px-4 py-2 rounded-md bg-gray-200 hover:bg-gray-300 text-black font-medium cursor-pointer">Clear</button>
        <button type="submit" class="w-fit h-fit px-4 py-2 rounded-md bg-blue-500 hover:bg-blue-600 text-white font-medium cursor-pointer">Register</button>
      </span>
      <span class="w-full flex gap-1 justify-center">
        <p class="w-fit text-gray-500">Already have an account?</p>
        <a href="login.php" class="w-fit text-black hover:text-blue-500 hover:underline">Login</a>
      </span>
    </div>
    <div class="w-full h-auto flex items-center">
      <img src="../resources/images/todo.svg" alt="todo" class="">
    </div>
    
  </form>
</body>
<script>
  document.querySelector('form').addEventListener('submit', function(event) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    const bannerContainer = document.getElementById('banner-container');
    bannerContainer.innerHTML = '';

    if (password !== confirmPassword) {
      event.preventDefault();
      const bannerHTML = `
        <div class="text-sm w-full h-fit px-2.5 py-2 rounded-md bg-red-200 border-2 border-red-600">
          <p class="font-semibold">Error: </p>
          <p>Password and confirm password do not match</p>
        </div>
      `;
  
      bannerContainer.innerHTML = bannerHTML;
    }
  });
</script>
</html>