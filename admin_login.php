<?php
session_start();
include 'db_connect.php';

// If already logged in as admin, redirect
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: admin.php");
    exit;
}

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // 1) Query for is_admin=1
    $sql  = "SELECT id, password FROM users 
             WHERE username = ? AND is_admin = 1 
             LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // 2) Check if admin user exists
    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        // 3) Verify the password
        if (password_verify($password, $row['password'])) {
            // Success: set admin session variable
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $row['id'];

            header("Location: admin.php");
            exit;
        } else {
            $error = "Invalid admin credentials.";
        }
    } else {
        $error = "Invalid admin credentials.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/admin_login.css"> <!-- Admin styling if you want -->
</head>
<body>
    <form method="POST" action="">
        <h3>Admin Login</h3>
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
        
        <input type="text" name="username" placeholder="Admin Username" required>
        <input type="password" name="password" placeholder="Admin Password" required>
        <input type="submit" value="Login">
    </form>
</body>
</html>
