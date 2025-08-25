
  <header class="flex justify-between items-center bg-white shadow p-4 px-10">
    <div>
      <img src="../assets/img/main/logo.png" alt="" style="width: 120px;height:70px;">
    </div>
   <h2 class="text-2xl font-bold text-gray-800 tracking-tight">
          Welcome Back, <?php echo $_SESSION['name'] ?> <span class="name-text"></span>
        </h2>
    <div class="flex items-center space-x-4">
      <img src="../assets/images/avatar.png" alt="Profile" class="w-10 h-10 rounded-full border">
      <div>
        <p class="font-semibold text-gray-700"><span class="main-name"></span></p>
        <p class="text-sm text-gray-500"><span class="role-text"></span></p>
      </div>
      <a href="../resource/logout.php">
        <button id="logout-btn" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg">Logout</button>
      </a>
    </div>
  </header>
