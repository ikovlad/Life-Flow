<?php
session_start();
include 'db_connect.php';

// (Optional) Show all errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    // Use password_hash for secure password storage
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    // Insert a normal user (is_admin=0)
    $sql  = "INSERT INTO users (username, email, password, is_admin)
             VALUES (?, ?, ?, 0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        // Registration successful → go to login
        header("Location: login.php");
        exit;
    } else {
        // Show any DB errors
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Life Flow </title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="shortcut icon" href="./images/android-chrome-192x192.png" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,600,0,0"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,1,200"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    <nav class="navbar container">
        <div class="logo"> <a href="./index.php"> <img src="./images/Frame 4.png" alt="Website logo"> </a> </div>
        <div class="nav-item-wrapper">
            <ul class="nav-items">
                <li class="nav-item-1"> <a href="./index.php"> Home </a> </li>
                <li class="nav-item-2"> <a href="./index.php#BLOG"> Blogs </a> </li>
                <li class="nav-item-3"> <a href="./contact.php"> Need Blood </a> </li>
                <li class="nav-item-3"> <a href="./donate.php"> Donate Blood </a> </li>
            </ul>
        </div>
        <div class="nav-right">
            <div> <a href="./login.php"> <button type="submit" class="login-btn primary-btn"> Login </button> </a> </div>
            <div> <a href="./signup.php"> <button type="submit" class="sign-up-btn secondary-btn"> Sign-up </button> </a> </div>
        </div>
    </nav>

    <div class="form-box form-wrap-2">
        <div class="bttn">
            <span class="tgl-bttn text-white"> REGISTER </span>
        </div>
        <form action="./signup.php" method="POST"> 
            <input class="textbox" type="email" name="email" id="email" placeholder="Email" required>
            <input class="textbox" type="text" name="username" id="username" placeholder="Username" required>
            <input class="textbox" type="password" name="password" id="password" placeholder="Password" required>
            <input class="stbox" type="submit" value="Register">
            <p class="accept-tandc text-white" > <input type="radio" name="tandc" id="tandc" required> I accept all Terms and Condition</p> 
        </form>
    </div>

    <section class="footer">
        <div class="foot-wrap container">
            <div class="left-items-wrap">
                <div class="foot-links-wrap container">
                    <div class="q-links-wrapper">
                        <h3 class="q-links"> Quick Links </h3>
                        <div> 
                            <a href="https://en.wikipedia.org/wiki/Blood_donation" target="_blank"> 
                                <div class="footer-link-wrapper"> 
                                    <span class="material-symbols-outlined"> chevron_right </span> 
                                    <span class="footer-link-text"> About Blood Donation </span> 
                                </div> 
                            </a> 
                        </div>
                        <div> 
                            <a href="./donate.php" target="_blank"> 
                                <div class="footer-link-wrapper"> 
                                    <span class="material-symbols-outlined"> chevron_right </span> 
                                    <span class="footer-link-text"> Donate </span> 
                                </div>
                            </a>
                        </div>
                        <div> 
                            <a href="./contact.php" target="_blank"> 
                                <div class="footer-link-wrapper"> 
                                    <span class="material-symbols-outlined"> chevron_right </span> 
                                    <span class="footer-link-text"> Contact Us </span> 
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="imp-links-wrapper">
                        <h3 class="imp-links"> Important Links </h3>
                        <div> 
                            <a href="https://privacy.gov.ph/data-privacy-act/" target="_blank"> 
                                <div class="footer-link-wrapper"> 
                                    <span class="material-symbols-outlined"> chevron_right </span> 
                                    <span class="footer-link-text"> Privacy </span> 
                                </div>
                            </a> 
                        </div>
                        <div> 
                            <a href="https://www.cookielawinfo.com/cookie-law/" target="_blank"> 
                                <div class="footer-link-wrapper"> 
                                    <span class="material-symbols-outlined"> chevron_right </span> 
                                    <span class="footer-link-text"> Cookies </span> 
                                </div>    
                            </a>
                        </div>
                        <div> 
                            <a href="./terms_conditions.php" target="_blank"> 
                                <div class="footer-link-wrapper"> 
                                    <span class="material-symbols-outlined"> chevron_right </span> 
                                    <span class="footer-link-text"> Terms and Conditions </span> 
                                </div>
                            </a> 
                        </div>
                        <div>
        
                        </div>
                    </div>
                </div>
                <div class="sm-links container">
                    <a href=""> <img src="./images/facebook.png" alt=""> </a>
                    <a href=""> <img src="./images/instagram.png" alt=""> </a>
                    <a href=""> <img src="./images/twitter.png" alt=""> </a>
                </div>
            </div>
            <hr class="foot-breaker">
            <div class="right-text-wrap container">
                <div class="foot-l-text"> "One drop can save many lives" </div>
                <div> <button type="submit" class="login-btn primary-btn"> Donate </button> </div>
            </div>
        </div>
        <p class="container cr-text">Life Flow &copy; &nbsp; | &nbsp  ikovlad   &nbsp | &nbsp; All rights reserved </p> 
    </section>

    <script>
        function fun1(){
            alert("Your appointment has been booked..! Please visit nearest one blood center to donate your blood");
        }
    </script>
</body>
</html>