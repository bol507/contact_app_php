<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contacts App</title>
    <!-- tailwindcss -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./static/css/index.css" />
    <?php $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) ?>
    <?php if ($uri == '/contact_app_php' || $uri == '/contact_app_php/index.php'): ?>
        <script defer src="./static/js/welcome.js"></script>
    <?php endif ?>
</head>

<body class="bg-slate-100 dark:bg-slate-800">

    <?php require "navbar.php" ?>

    <main>