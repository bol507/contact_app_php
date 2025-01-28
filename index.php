<?php
require "database.php";
$contacts = $conn->query("SELECT * FROM contacts");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contacts App</title>
    <!-- tailwindcss -->
    <script defer src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./static/css/style.css" />
    
  </head>
  <body class="bg-slate-100 dark:bg-slate-800">

    <nav class="flex items-center justify-between flex-wrap bg-gray-50 border-gray-200 dark:bg-gray-800 dark:border-gray-700 p-6">
      <a href="#" class="flex items-center text-white font-bold">
        <img src="./static/img/logo.png" alt="logo" class="w-5 h-5 mr-2" />
        Contacts app
      </a>
      <div class="block lg:hidden">
        <button  id="menu-toggle" class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
          <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
        </button>
      </div>
      <div id="menu" class=" w-full md:block md:w-auto hidden">
        <ul class="text-sm lg:flex-grow flex flex-col md:flex-row list-none bg-gray-50 dark:bg-gray-800 dark:text-white dark:border-gray-700 font-medium rounded-lg md:space-x-8 md:mt-0 md:border-0 md:bg-transparent  ">
          <li href="#" class="block py-2 px-3 md:px-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
            <a href="#" >Home</a>
          </li>
          <li class="block py-2 px-3 md:px-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
            <a href="./add.php" >Add contact</a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="flex flex-col items-center mx-4 my-4 py-4 px-3  gap-x-4 md:flex-row">
        <?php if($contacts->rowCount() == 0): ?>
          <div>
            <p>No contacts save yet</p>
            <a href="add.php">Add one! </a>
          </div>
        <?php endif ?>  

        <?php foreach($contacts as $contact): ?>
        <div class="flex flex-col items-center md:w-6/12 lg:w-3/12 border rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 mb-2">
          <h3 class="text-xl font-medium text-gray-900 dark:text-white"><?= $contact["name"] ?></h3>
          <p class="dark:text-white" ><?= $contact["phone_number"] ?></p>
          <div class="flex mt-4 mb-2 gap-x-4 px-3">
            <a href="#" class="bg-gray-200 text-gray-700 px-4 py-2 rounded">Edit contact</a>
            <a href="delete.php?id=<?= $contact['id'] ?>" class="bg-red-500 text-white px-4 py-2 rounded ">Delete contact</a>
          </div>
        </div>
        <?php endforeach ?>
        
       

    </main>
    <script src="./static/js/script.js"></script>
  </body>
</html>
