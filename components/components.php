<?php

function head($title, $icon = []) {
  ?>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- Google Fonts Icon -->
    <?php
    $iconList = [
      'nest_farsight_cool'
    ];
    $iconList = array_merge($iconList, $icon);
    $iconList = array_unique($iconList);
    sort($iconList);
    $iconString = implode(',', $iconList);
    ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=<?= $iconString ?>" />

    <link rel="stylesheet" href="../resources/style.css">
  </head>
  <?php
}

function icon($iconName, $style = '') {
  ?>
  <span class="material-symbols-outlined <?= $style ?>">
    <?= $iconName ?>
  </span>
  <?php
}


function banner($type = 'info', $message) {
  $borderColor = "border-gray-600";
  $bgColor = "bg-gray-100";
  $title = "Info";

  if ($type == 'success') {
    $borderColor = "border-green-600";
    $bgColor = "bg-green-200";
    $title = "Success";
  } else if ($type == 'error') {
    $borderColor = "border-red-600";
    $bgColor = "bg-red-200";
    $title = "Error";
  }

  if (!empty($type) && !empty($message)) {
  ?>
  <div class="text-sm w-full h-fit px-2.5 py-2 rounded-md <?= $bgColor ?> border-2 <?= $borderColor ?>">
    <p class="font-semibold"><?= $title ?></p>
    <p><?= $message ?></p>
  </div>
  <?php
  }
}