<?php
// filepath: c:\xampp\htdocs\PROJECT\admin\manage_users.php
session_start();
require '../dbconn.php';

// ... (PHP security check code remains the same) ...
if (!isset($_SESSION['user'])) {
    header("Location: ../signin.php");
    exit();
}
$stmt = $conn->prepare("SELECT role FROM users WHERE email = ?");
$stmt->bind_param("s", $_SESSION['user']);
$stmt->execute();
$stmt->bind_result($role);
$stmt->fetch();
$stmt->close();
if ($role !== 'admin') {
    header("Location: ../Main Dashboard.php");
    exit();
}
$users_result = $conn->query("SELECT id, fname, lname, email, role FROM users ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users | TrackFlation Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../styles.css">
</head>
<body class="bg-black text-gray-300 font-sans">

    <header class="bg-gray-800 p-4 shadow-lg">
        <div class="container mx-auto flex items-center justify-between">
            <h1 class="text-xl font-bold text-white">TrackFlation Admin Panel</h1>
            <nav>
                <a href="../Main Dashboard.php" class="text-gray-300 hover:text-white">← Back to Dashboard</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-10 p-4">
        <h2 class="text-3xl font-bold text-blue-400 mb-6">Manage Users</h2>

        <div class="bg-gray-900/70 backdrop-blur-lg shadow-2xl rounded-lg overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-gray-700 text-gray-200 uppercase text-sm">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">First Name</th>
                        <th class="py-3 px-6 text-left">Last Name</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Role</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-300">
                    <?php if ($users_result->num_rows > 0): ?>
                        <?php while($user = $users_result->fetch_assoc()): ?>
                            <tr class="border-b border-gray-700 hover:bg-gray-800">
                                <td class="py-3 px-6 text-left"><?php echo htmlspecialchars($user['id']); ?></td>
                                <td class="py-3 px-6 text-left"><?php echo htmlspecialchars($user['fname']); ?></td>
                                <td class="py-3 px-6 text-left"><?php echo htmlspecialchars($user['lname']); ?></td>
                                <td class="py-3 px-6 text-left"><?php echo htmlspecialchars($user['email']); ?></td>
                                <td class="py-3 px-6 text-left">
                                    <span class="px-2 py-1 font-semibold leading-tight rounded-full <?php echo $user['role'] === 'admin' ? 'bg-green-900/50 text-green-300' : 'bg-blue-900/50 text-blue-300'; ?>">
                                        <?php echo htmlspecialchars($user['role']); ?>
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="text-blue-400 hover:text-blue-300 mr-3">Edit</a>
                                    <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="text-red-500 hover:text-red-400" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="py-3 px-6 text-center">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>
<?php
$conn->close();
?>