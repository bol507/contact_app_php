<?php
require "database.php";

if(!isset($_SESSION["user"])){
  header("Location: index.php");
  return;
}

$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"]) || empty($_POST["phone_number"])) {
        $error = "Please fill all the fields";
    } else {
        $name = $_POST["name"];
        $phoneNumber = $_POST["phone_number"];

        $stmt = $conn->prepare("INSERT INTO contacts (name, phone_number) VALUES (:name, :phone_number)");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":phone_number", $phoneNumber);
        $stmt->execute();

        header("Location: home.php");
        exit; 
    }
}
?>
<?php require "partials/header.php" ?>
  <div class="flex justify-center ">
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
        <form method="POST" action="add.php"  class="my-6 max-w-full">
          <div class="flex items-center  mb-6">
            <div class="w-2/6">
              <label for="name" class="block text-right text-white font-bold pr-4 ">
                Name    
              </label>
            </div>
            
            <div class="w-3/6">
              <input type="text" name="name" required autocomplete="name" class="w-full appearance-none rounded py-2 px-4 text-gray-700 focus:bg-white focus:border-gray-200 focus:outline-none">
            </div>
            
          </div>
          <div class="flex items-center mb-6">
            <div class="w-2/6">
              <label for="phone_number" class="block text-right text-white font-bold pr-4">
                Phone number    
              </label>

            </div>
            
            <div class="w-3/6">
              <input type="text" name="phone_number" required autocomplete="phone_number" class="w-full appearance-none rounded py-2 px-4 text-gray-700 focus:bg-white focus:border-gray-200 focus:outline-none">
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
  </div>        
<?php require "partials/footer.php" ?>
