<?php
session_start();

// If user is already logged in, no need to see this page
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

include 'db_connect.php'; // Your database connection

$message = "";

// 1) If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    if (!empty($email)) {
        // 2) Check if the email exists in the 'users' table
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            // 3) Generate a random temporary password
            $tempPassword = bin2hex(random_bytes(4)); // 8 hex chars, e.g. "a3f0b1c9"
            // or something like: $tempPassword = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 8);

            // 4) Hash the temporary password
            $hashed = password_hash($tempPassword, PASSWORD_DEFAULT);

            // 5) Update the user’s password in DB
            $row = $result->fetch_assoc();
            $userId = $row['id'];

            $updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $updateStmt->bind_param("si", $hashed, $userId);

            if ($updateStmt->execute()) {
                // 6) Email the user their new password
                $subject = "Your Temporary Password";
                $body    = "Hello,\n\nWe have reset your password. Your temporary password is: {$tempPassword}\n\n".
                           "Please log in with this password, then go to your Profile to change it.\n\n".
                           "Regards,\nLife Flow Team";
                $headers = "From: lifeflow@example.com\r\n"; // Adjust as needed

                if (mail($email, $subject, $body, $headers)) {
                    $message = "A temporary password has been sent to your email. Please check your inbox.";
                } else {
                    $message = "Failed to send email. Please contact support.";
                }
            } else {
                $message = "Error updating password in the database.";
            }
        } else {
            // Email not found
            $message = "No account found with that email address.";
        }
    } else {
        $message = "Please enter your email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password - Life Flow</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <nav class="navbar container">
        <div class="logo">
            <a href="index.php"><img src="./images/Frame 4.png" alt="Website Logo"></a>
        </div>
        <div class="nav-item-wrapper">
            <ul class="nav-items">
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php#BLOG">Blogs</a></li>
                <li><a href="contact.php">Need Blood</a></li>
                <li><a href="donate.php">Donate Blood</a></li>
            </ul>
        </div>
        <div class="nav-right">
            <div><a href="login.php"><button class="login-btn primary-btn">Login</button></a></div>
            <div><a href="signup.php"><button class="sign-up-btn secondary-btn">Sign-up</button></a></div>
        </div>
    </nav>

    <div class="form-box form-wrap-1">
        <div class="bttn">
            <span class="tgl-bttn text-white">Reset Password</span>
        </div>
        <form action="forgot_password.php" method="POST">
            <p style="color: #ffaaaa; font-size: 1.2rem;">
                <?php if (!empty($message)) echo $message; ?>
            </p>
            <input class="textbox" type="email" name="email" placeholder="Enter your email" required>
            <input class="stbox" type="submit" value="Reset Password">
            <p class="create-act text-white">Remembered? <a href="login.php">Login</a></p>
        </form>
    </div>

    <section class="footer">
        <div class="foot-wrap container">
            <!-- ... your footer content ... -->
        </div>
        <p class="container cr-text">Life Flow &copy; &nbsp; | &nbsp; ikovlad &nbsp; | &nbsp; All rights reserved</p>
    </section>
</body>
</html>
