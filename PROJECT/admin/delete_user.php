<?php
// filepath: c:\xampp\htdocs\PROJECT\admin\delete_user.php
session_start();
require '../dbconn.php'; // Go up one directory to find dbconn.php

// 1. Security Check: Ensure user is logged in and is an admin
if (!isset($_SESSION['user'])) {
    header("Location: ../signin.php"); // Redirect to sign-in page if not logged in
    exit();
}

// Fetch the role and ID of the logged-in admin
$admin_email = $_SESSION['user'];
$stmt = $conn->prepare("SELECT id, role FROM users WHERE email = ?");
$stmt->bind_param("s", $admin_email);
$stmt->execute();
$stmt->bind_result($admin_id, $admin_role);
$stmt->fetch();
$stmt->close();

if ($admin_role !== 'admin') {
    // If the user is not an admin, redirect them away.
    header("Location: ../Main Dashboard.php");
    exit();
}

// 2. Check if a user ID was provided in the URL
if (isset($_GET['id'])) {
    $user_id_to_delete = $_GET['id'];

    // 3. Safety Check: Prevent an admin from deleting their own account
    if ($user_id_to_delete == $admin_id) {
        // Optionally, you can set an error message in the session to display on the manage_users page
        $_SESSION['error_message'] = "You cannot delete your own account.";
    } else {
        // 4. Prepare and execute the delete statement
        $delete_stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $delete_stmt->bind_param("i", $user_id_to_delete);
        $delete_stmt->execute();
        $delete_stmt->close();
    }
}

// 5. Redirect back to the user management page
header("Location: manage_users.php");
exit();

?>