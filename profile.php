<?php
session_start();

// If not logged in, redirect
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include('db_connect.php');

// 1) Securely fetch user info
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// 2) Count how many times user requested blood
$stmtNeed = $conn->prepare("SELECT COUNT(*) AS total_need FROM need_blood WHERE user_id = ?");
$stmtNeed->bind_param("i", $user_id);
$stmtNeed->execute();
$resultNeed = $stmtNeed->get_result();
$rowNeed = $resultNeed->fetch_assoc();
$needCount = $rowNeed['total_need'];

// 3) Count how many times user donated blood
$stmtDonate = $conn->prepare("SELECT COUNT(*) AS total_donate FROM donate_blood WHERE user_id = ?");
$stmtDonate->bind_param("i", $user_id);
$stmtDonate->execute();
$resultDonate = $stmtDonate->get_result();
$rowDonate = $resultDonate->fetch_assoc();
$donateCount = $rowDonate['total_donate'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <!-- Link to the same CSS snippet you provided -->
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <!-- Example dynamic navbar (adjust as needed) -->
    <nav class="navbar container">
        <div class="logo">
            <a href="./index.php">
                <img src="./images/Frame 4.png" alt="Website Logo">
            </a>
        </div>
        <div class="nav-item-wrapper">
            <ul class="nav-items">
                <li><a href="./index.php">Home</a></li>
                <li><a href="./index.php#BLOG">Blogs</a></li>
                <li><a href="./contact.php">Need Blood</a></li>
                <li><a href="./donate.php">Donate Blood</a></li>
            </ul>
        </div>
        <div class="nav-right">
            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- Show Profile and Logout if logged in -->
                <div>
                    <a href="profile.php">
                        <button type="submit" class="login-btn primary-btn">Profile</button>
                    </a>
                </div>
                <div>
                    <a href="logout.php">
                        <button type="submit" class="sign-up-btn secondary-btn">Logout</button>
                    </a>
                </div>
            <?php else: ?>
                <!-- Otherwise show Login and Sign-up -->
                <div>
                    <a href="login.php">
                        <button type="submit" class="login-btn primary-btn">Login</button>
                    </a>
                </div>
                <div>
                    <a href="signup.php">
                        <button type="submit" class="sign-up-btn secondary-btn">Sign-up</button>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Main Profile Container -->
    <div class="container" style="max-width: 60rem; margin: 4rem auto; background: #fff; padding: 2rem; border-radius: 0.5rem;">
        <h1>My Profile</h1>
        <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>

        <hr style="margin: 2rem 0;">

        <h2>My Submissions</h2>
        <p>You have made <strong><?= $needCount ?></strong> “Need Blood” requests.</p>
        <p>You have made <strong><?= $donateCount ?></strong> “Donate Blood” submissions.</p>

        <hr style="margin: 2rem 0;">

        <a href="edit_profile.php" class="login-btn primary-btn" style="margin-right: 1rem;">Edit Profile</a>
        <a href="logout.php" class="sign-up-btn secondary-btn">Logout</a>
    </div>
</body>
</html>
