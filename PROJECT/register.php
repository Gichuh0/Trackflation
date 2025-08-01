<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | TrackFlation</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-gradient-to-br from-blue-900 via-blue-600 to-blue-400 min-h-screen flex items-center justify-center">

  <?php
  // Themed feedback message for registration errors or success
  if (isset($_SESSION['register_error'])) {
      echo '<div class="bg-red-900/80 text-red-200 px-4 py-2 rounded shadow mb-4 text-center font-semibold max-w-md mx-auto absolute top-6 left-0 right-0">' . htmlspecialchars($_SESSION['register_error']) . '</div>';
      unset($_SESSION['register_error']);
  }
  if (isset($_SESSION['register_success'])) {
      echo '<div class="bg-green-900/80 text-green-200 px-4 py-2 rounded shadow mb-4 text-center font-semibold max-w-md mx-auto absolute top-6 left-0 right-0">' . htmlspecialchars($_SESSION['register_success']) . '</div>';
      unset($_SESSION['register_success']);
  }
  ?>

  <div class="w-full max-w-md mx-auto bg-white/20 backdrop-blur-lg rounded-2xl shadow-2xl p-8">
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-blue-800 mb-2">Create Account</h1>
      <p class="text-blue-900/80">Join TrackFlation and stay ahead!</p>
    </div>
    <form action="process.php" method="POST">
      <div class="mb-4">
        <label class="block text-blue-900 font-semibold mb-1" for="fname">First Name</label>
        <input class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-400" type="text" id="fname" name="fname" placeholder="First Name" required>
      </div>
      <div class="mb-4">
        <label class="block text-blue-900 font-semibold mb-1" for="lname">Last Name</label>
        <input class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-400" type="text" id="lname" name="lname" placeholder="Last Name" required>
      </div>
      <div class="mb-4">
        <label class="block text-blue-900 font-semibold mb-1" for="email">Email</label>
        <input class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-400" type="email" id="email" name="email" placeholder="you@icloud.com" required>
      </div>
      <div class="mb-4">
        <label class="block text-blue-900 font-semibold mb-1" for="password">Password</label>
        <input class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-400" type="password" id="password" name="password" placeholder="Create a password" required>
      </div>
      <div class="mb-6">
        <label class="block text-blue-900 font-semibold mb-1" for="confirm">Confirm Password</label>
        <input class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-400" type="password" id="confirm" name="confirm" placeholder="Repeat your password" required>
      </div>
      <button type="submit" class="w-full py-2 rounded-lg bg-gradient-to-r from-blue-700 to-blue-400 text-white font-bold shadow-lg hover:from-blue-800 hover:to-blue-500 transition mb-4">
        Register
      </button>
      <div class="text-center text-blue-900/80 text-sm">
        Already have an account?
        <a href="signin.php" class="font-semibold text-blue-700 hover:underline">Sign in</a>
      </div>
    </form>
  </div>
</body>
</html>