<?php
require "database.php";

$id = $_GET["id"];

$stmt = $conn->prepare("SELECT * FROM contacts WHERE id =:id LIMIT 1");
$stmt->execute([":id" => $id]);

if ($stmt->rowCount()== 0 ){
    http_response_code(404);
    echo(" HTTP 404 NOT FOUND");
    return;
}

$contact = $stmt->fetch(PDO::FETCH_ASSOC);

$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"]) || empty($_POST["phone_number"])) {
        $error = "Please fill all the fields";
    } else {
        $name = $_POST["name"];
        $phoneNumber = $_POST["phone_number"];

        $stmt = $conn->prepare("UPDATE contacts  SET name=:name, phone_number=:phone_number WHERE id=:id");
        $stmt->execute([
          ":id" => $id,
          ":name" => $name,
          ":phone_number" => $phoneNumber
        ]);
        

        header("Location: index.php");
        exit; 
    }
}
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
            <a href="./index.php" >Home</a>
          </li>
          <li class="block py-2 px-3 md:px-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
            <a href="./add.php" >Add contact</a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="flex justify-center mx-4 my-4 py-4 px-3">
     <div class="w-8/12 border border-gray-200 dark:border-gray-700  dark:bg-gray-800 dark:hover:bg-gray-700">
      <div class="py-2 px-4  bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white">
        <h3>Add new contact</h3>
      </div>
      <div>
        <?php if ($error): ?>
          <p class="text-sm text-red-500">
            <?= $error ?>
          </p>
        <?php endif ?>  
        <form method="POST" action="edit.php?id=<?= $contact['id']  ?>"  class="my-6 max-w-full">
          <div class="flex items-center  mb-6">
            
            <div class="w-2/6">
              <label for="name" class="block text-right text-white font-bold pr-4 ">
                Name    
              </label>
            </div>
            
            <div class="w-3/6">
              <input value="<?= $contact['name']  ?>" type="text" name="name" required autocomplete="name" class="w-full appearance-none rounded py-2 px-4 text-gray-700 focus:bg-white focus:border-gray-200 focus:outline-none">
            </div>
            
          </div>
          <div class="flex items-center mb-6">
            <div class="w-2/6">
              <label for="phone_number" class="block text-right text-white font-bold pr-4">
                Phone number    
              </label>

            </div>
            
            <div class="w-3/6">
              <input value="<?= $contact['phone_number']  ?>" type="text" name="phone_number" required autocomplete="phone_number" class="w-full appearance-none rounded py-2 px-4 text-gray-700 focus:bg-white focus:border-gray-200 focus:outline-none">
            </div>
          </div>

          <div class="flex items-center">
            <div class="w-2/6"></div>
            <div class="w-3/6">
              <button type="submit" class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                Submit
              </button>
            </div>
          </div>
          

        </form>
      </div>

     </div>
    </main>
    <script src="./static/js/script.js"></script>
  </body>
</html>
