<?php
require "database.php";
$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"]) || empty($_POST["email"])   || empty($_POST["password"])){
    $error = "Please fill all fields.";
  } elseif (!str_contains($_POST["email"],"@")){
    $error = "Email format is incorrect.";
  } else {
    $stmt = $conn->prepare("SELECT * FROM users where email = :email");
    $stmt->bindParam(":email",$_POST["email"]);
    $stmt->execute();
    if($stmt->rowCount() > 0 ){
      $error = "This email is taken.";
    }else {
      $conn->prepare("INSERT INTO users (name,email,password) VALUES (:name,:email,:password)")
      ->execute([
        ":name"=> $_POST["name"],
        ":email"=> $_POST["email"],
        ":password"=> password_hash($_POST["password"], PASSWORD_BCRYPT)
      ]);
      header("Location: home.php");
    }

  }
}
?>
<?php require "partials/header.php" ?>
  <div class="flex justify-center ">
     <div class="w-8/12 border border-gray-200 dark:border-gray-700  dark:bg-gray-800 dark:hover:bg-gray-700">
      <div class="py-2 px-4  bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white">
        <h3>Register</h3>
      </div>
      <div>
        <?php if ($error): ?>
          <p class="text-sm text-red-500">
            <?= $error ?>
          </p>
        <?php endif ?>  
        <form method="POST" action="register.php"  class="my-6 max-w-full">
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
              <label for="email" class="block text-right text-white font-bold pr-4">
                Email  
              </label>
            </div>
            <div class="w-3/6">
              <input type="email" name="email" required autocomplete="email" class="w-full appearance-none rounded py-2 px-4 text-gray-700 focus:bg-white focus:border-gray-200 focus:outline-none">
            </div>
          </div>

          <div class="flex items-center mb-6">
            <div class="w-2/6">
              <label for="password" class="block text-right text-white font-bold pr-4">
                Password  
              </label>
            </div>
            <div class="w-3/6">
              <input type="password" name="password" required class="w-full appearance-none rounded py-2 px-4 text-gray-700 focus:bg-white focus:border-gray-200 focus:outline-none">
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
