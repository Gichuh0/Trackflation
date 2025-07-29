<?php
// filepath: c:\xampp\htdocs\PROJECT\admin\edit_user.php
session_start();
require '../dbconn.php';

// 1. Security Check: Ensure user is logged in and is an admin
if (!isset($_SESSION['user'])) {
    header("Location: ../signin.php");
    exit();
}
$admin_email = $_SESSION['user'];
$stmt = $conn->prepare("SELECT role FROM users WHERE email = ?");
$stmt->bind_param("s", $admin_email);
$stmt->execute();
$stmt->bind_result($role);
$stmt->fetch();
$stmt->close();
if ($role !== 'admin') {
    header("Location: ../Main Dashboard.php");
    exit();
}

// 2. Handle form submission for updating the user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $user_id = $_POST['id'];
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $new_role = $_POST['role'];

    $update_stmt = $conn->prepare("UPDATE users SET fname = ?, lname = ?, email = ?, role = ? WHERE id = ?");
    $update_stmt->bind_param("ssssi", $fname, $lname, $email, $new_role, $user_id);
    $update_stmt->execute();
    $update_stmt->close();

    header("Location: manage_users.php"); // Redirect back to the user list
    exit();
}

// 3. Fetch the user's data to pre-fill the form
if (!isset($_GET['id'])) {
    header("Location: manage_users.php"); // Redirect if no ID is provided
    exit();
}
$user_id = $_GET['id'];
$user_stmt = $conn->prepare("SELECT fname, lname, email, role FROM users WHERE id = ?");
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_stmt->bind_result($fname, $lname, $email, $current_role);
$user_stmt->fetch();
$user_stmt->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User | TrackFlation Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../styles.css">
</head>
<body class="bg-black text-gray-300 font-sans">

    <header class="bg-gray-800 p-4 shadow-lg">
        <div class="container mx-auto flex items-center justify-between">
            <h1 class="text-xl font-bold text-white">TrackFlation Admin Panel</h1>
            <nav>
                <a href="manage_users.php" class="text-gray-300 hover:text-white">← Back to User List</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-10 p-4">
        <div class="max-w-lg mx-auto bg-gray-900/70 backdrop-blur-lg shadow-2xl rounded-lg p-8">
            <h2 class="text-3xl font-bold text-blue-400 mb-6 text-center">Edit User</h2>
            
            <form action="edit_user.php" method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($user_id); ?>">
                
                <div class="mb-4">
                    <label for="fname" class="block text-blue-300 font-semibold mb-1">First Name</label>
                    <input type="text" name="fname" id="fname" value="<?php echo htmlspecialchars($fname); ?>" class="w-full px-4 py-2 rounded-lg bg-gray-800 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 text-white" required>
                </div>

                <div class="mb-4">
                    <label for="lname" class="block text-blue-300 font-semibold mb-1">Last Name</label>
                    <input type="text" name="lname" id="lname" value="<?php echo htmlspecialchars($lname); ?>" class="w-full px-4 py-2 rounded-lg bg-gray-800 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 text-white" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-blue-300 font-semibold mb-1">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" class="w-full px-4 py-2 rounded-lg bg-gray-800 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 text-white" required>
                </div>

                <div class="mb-6">
                    <label for="role" class="block text-blue-300 font-semibold mb-1">Role</label>
                    <select name="role" id="role" class="w-full px-4 py-2 rounded-lg bg-gray-800 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 text-white">
                        <option value="user" <?php if($current_role === 'user') echo 'selected'; ?>>User</option>
                        <option value="admin" <?php if($current_role === 'admin') echo 'selected'; ?>>Admin</option>
                    </select>
                </div>

                <button type="submit" class="w-full py-2 rounded-lg bg-gradient-to-r from-blue-700 to-blue-400 text-white font-bold shadow-lg hover:from-blue-800 hover:to-blue-500 transition">
                    Save Changes
                </button>
            </form>
        </div>
    </main>

</body>
</html>
<?php
$conn->close();