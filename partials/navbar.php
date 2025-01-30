<nav id="navbar" class="flex items-center justify-between flex-wrap bg-gray-50 border-gray-200 dark:bg-gray-800 dark:border-gray-700 p-6">
    <a href="#" class="flex items-center text-white font-bold">
        <img src="./static/img/logo.png" alt="logo" class="w-5 h-5 mr-2" />
        Contacts app
    </a>
    <div class="block lg:hidden">
        <button id="menu-toggle" class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <title>Menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
            </svg>
        </button>
    </div>
    <div id="menu" class=" w-full md:block md:w-auto hidden">
        <ul class="text-sm lg:flex-grow flex flex-col md:flex-row list-none bg-gray-50 dark:bg-gray-800 dark:text-white dark:border-gray-700 font-medium rounded-lg md:space-x-8 md:mt-0 md:border-0 md:bg-transparent  ">
            <?php if(isset($_SESSION["user"])): ?>
            <li href="#" class="block py-2 px-3 md:px-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                <a href="./index.php">Home</a>
            </li>
            <li class="block py-2 px-3 md:px-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                <a href="./add.php">Add contact</a>
            </li>
            <li class="block py-2 px-3 md:px-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                <a href="./logout.php">Logout</a>
            </li> 
            <?php else: ?>
            <li href="#" class="block py-2 px-3 md:px-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                <a href="./register.php">Register</a>
            </li>
            <li class="block py-2 px-3 md:px-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                <a href="./login.php">Login</a>
            </li>
            <?php endif ?>
        </ul>
    </div>
</nav>