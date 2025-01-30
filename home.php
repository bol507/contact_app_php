<?php
require "database.php";
session_start();
if(!isset($_SESSION["user"])){
  header("Location: index.php");
  return;
}
$contacts = $conn->query("SELECT * FROM contacts");
?>

<?php require "partials/header.php" ?>

  <?php if($contacts->rowCount() == 0): ?>
  <div>
    <p>No contacts save yet</p>
    <a href="add.php">Add one! </a>
  </div>
  <?php endif ?>  

  <?php foreach($contacts as $contact): ?>
    <div class="mx-2 flex flex-col items-center md:w-6/12 lg:w-3/12 border rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 mb-2">
      <h3 class="text-xl font-medium text-gray-900 dark:text-white"><?= $contact["name"] ?></h3>
      <p class="dark:text-white" ><?= $contact["phone_number"] ?></p>
      <div class="flex mt-4 mb-2 gap-x-4 px-3">
        <a href="edit.php?id=<?= $contact['id'] ?>" class="bg-gray-200 text-gray-700 px-4 py-2 rounded">Edit contact</a>
        <a href="delete.php?id=<?= $contact['id'] ?>" class="bg-red-500 text-white px-4 py-2 rounded ">Delete contact</a>
      </div>
    </div>
  <?php endforeach ?>
        
<?php require "partials/footer.php" ?>
