<?php
require 'dbconn.php';
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user'] = $email;
            $_SESSION['just_signed_in'] = true;
            header("Location: Main Dashboard.php");
            exit();
        } else {
            $error = "Password is wrong.";
        }
    } else {
        $error = "No account found with that email.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In | TrackFlation</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-gradient-to-br from-blue-900 via-blue-600 to-blue-400 min-h-screen flex items-center justify-center">
  <div class="w-full max-w-md mx-auto bg-white/20 backdrop-blur-lg rounded-2xl shadow-2xl p-8">
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-blue-800 mb-2">Welcome Back!</h1>
      <p class="text-blue-900/80">Sign in to your TrackFlation account</p>
    </div>
    <form action="signin.php" method="POST">
      <?php if (!empty($error)): ?>
        <div class="mb-4 text-red-700 bg-red-100 rounded-lg px-4 py-2 font-semibold">
          <?php echo $error; ?>
        </div>
      <?php endif; ?>
      <div class="mb-4">
        <label class="block text-blue-900 font-semibold mb-1" for="email">Email</label>
        <input name="email" class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-400" type="email" id="email" placeholder="you@icloud.com" required>
      </div>
      <div class="mb-6">
        <label class="block text-blue-900 font-semibold mb-1" for="password">Password</label>
        <input name="password" class="w-full px-4 py-2 rounded-lg border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-400" type="password" id="password" placeholder="••••••••" required>
      </div>
      <button type="submit" class="w-full py-2 rounded-lg bg-gradient-to-r from-blue-700 to-blue-400 text-white font-bold shadow-lg hover:from-blue-800 hover:to-blue-500 transition mb-4">
        Sign In
      </button>
      <div class="text-center text-blue-900/80 text-sm">
        Don't have an account?
        <a href="register.php" class="font-semibold text-blue-700 hover:underline">Register here</a>
      </div>
    </form>
  </div>
</body>
</html>