<?php
include 'db_connect.php';
session_start();

if ($_SESSION["role"] != "admin") {
    header("Location: index.php");
    exit();
}

$sql_users = "SELECT id, username, email FROM users";
$result_users = $conn->query($sql_users);

$sql_requests = "SELECT * FROM blood_requests";
$result_requests = $conn->query($sql_requests);

$sql_donations = "SELECT * FROM blood_donations";
$result_donations = $conn->query($sql_donations);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    <h2>Admin Dashboard</h2>

    <h3>Manage Users</h3>
    <table border="1">
        <tr><th>ID</th><th>Username</th><th>Email</th><th>Action</th></tr>
        <?php while ($row = $result_users->fetch_assoc()): ?>
            <tr>
                <td><?= $row["id"] ?></td>
                <td><?= $row["username"] ?></td>
                <td><?= $row["email"] ?></td>
                <td><a href="delete_user.php?id=<?= $row['id'] ?>">Remove</a></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h3>Blood Requests</h3>
    <table border="1">
        <tr><th>ID</th><th>Name</th><th>Blood Type</th><th>Status</th><th>Action</th></tr>
        <?php while ($row = $result_requests->fetch_assoc()): ?>
            <tr>
                <td><?= $row["id"] ?></td>
                <td><?= $row["full_name"] ?></td>
                <td><?= $row["blood_type"] ?></td>
                <td><?= $row["status"] ?></td>
                <td>
                    <a href="approve_request.php?id=<?= $row['id'] ?>">Approve</a> | 
                    <a href="deny_request.php?id=<?= $row['id'] ?>">Deny</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h3>Blood Donations</h3>
    <table border="1">
        <tr><th>ID</th><th>Name</th><th>Blood Type</th><th>Status</th><th>Action</th></tr>
        <?php while ($row = $result_donations->fetch_assoc()): ?>
            <tr>
                <td><?= $row["id"] ?></td>
                <td><?= $row["full_name"] ?></td>
                <td><?= $row["blood_type"] ?></td>
                <td><?= $row["status"] ?></td>
                <td>
                    <a href="approve_donation.php?id=<?= $row['id'] ?>">Approve</a> | 
                    <a href="deny_donation.php?id=<?= $row['id'] ?>">Deny</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
