<?php
require "database.php";
$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["email"])   || empty($_POST["password"])){
    $error = "Please fill all fields.";
  } elseif (!str_contains($_POST["email"],"@")){
    $error = "Email format is incorrect.";
  } else {
    $stmt = $conn->prepare("SELECT * FROM users where email = :email LIMIT 1");
    $stmt->bindParam(":email",$_POST["email"]);
    $stmt->execute();
    if($stmt->rowCount() == 0 ){
      $error = "Invalid credentials.";
    }else {
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      if(!password_verify($_POST["password"], $user["password"])){
        $error = "Invalid credentials.";
      } else {
        session_start();
        unset($user["password"]);
        $_SESSION["user"] = $user;
        header("Location: home.php");
      }
      
    }

  }
}
?>
<?php require "partials/header.php" ?>
  <div class="flex justify-center ">
     <div class="w-8/12 border border-gray-200 dark:border-gray-700  dark:bg-gray-800 dark:hover:bg-gray-700">
      <div class="py-2 px-4  bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white">
        <h3>Login</h3>
      </div>
      <div>
        <?php if ($error): ?>
          <p class="text-sm text-red-500">
            <?= $error ?>
          </p>
        <?php endif ?>  
        <form method="POST" action="login.php"  class="my-6 max-w-full">
          

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
