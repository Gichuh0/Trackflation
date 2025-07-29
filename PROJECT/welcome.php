<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: register.html");
    exit();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to TrackFlation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-gradient-to-br from-blue-900 via-blue-600 to-blue-400 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-lg mx-auto bg-white/20 backdrop-blur-lg rounded-2xl shadow-2xl p-10 text-center animate-fade-in">
        <h1 class="text-4xl font-extrabold text-blue-900 mb-2 drop-shadow">Welcome to TrackFlation!</h1>
        <p class="text-lg text-blue-900/90 mb-6">
            Hello, <span class="font-semibold text-blue-700"><?php echo htmlspecialchars($_SESSION['user']); ?></span> 👋<br>
            Your account has been created successfully.<br>
            Dive in and start exploring real-time inflation data and interactive dashboards!
        </p>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="mb-6 px-4 py-2 rounded-lg bg-green-100 text-green-800 font-semibold shadow">
                <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>
        <a href="Main Dashboard.php" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-full text-lg font-semibold hover:bg-blue-700 transition duration-300 shadow">
            Go to Dashboard
        </a>
    </div>
    <style>
      @keyframes fade-in {
        from { opacity: 0; transform: translateY(30px);}
        to { opacity: 1; transform: translateY(0);}
      }
      .animate-fade-in {
        animation: fade-in 1s ease;
      }
    </style>
</body>
</html>