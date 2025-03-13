<?php
session_start();
include 'db_connect.php';

// 1) Make sure only an admin can access this page
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 2) Get the form inputs
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    // Use password_hash for secure storage
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    // 3) Insert new user with is_admin=1
    $sql  = "INSERT INTO users (username, email, password, is_admin)
             VALUES (?, ?, ?, 1)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    // 4) Execute and check for success
    if ($stmt->execute()) {
        // Registration successful, redirect or show success
        header("Location: admin.php");
        exit;
    } else {
        $error = "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Life Flow Admin Register</title>
    <link rel="stylesheet" href="./css/admin_login.css">
</head>
<body>
    <h2>Create a New Admin Account</h2>

    <?php if (!empty($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="text"     name="username" placeholder="Username" required><br><br>
        <input type="email"    name="email"    placeholder="Email"    required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Create Admin</button>
    </form>
</body>
</html>
