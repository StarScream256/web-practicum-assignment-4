<?php

function head($title, $icon = []) {
  ?>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>


    <!-- DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

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
  </head>
  <?php
}