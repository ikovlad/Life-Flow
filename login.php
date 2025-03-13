<?php
session_start();
// If user is already logged in, redirect
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$error = "";
if (isset($_SESSION['login_error'])) {
    $error = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
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
        <div class="logo"> <a href="./index.html"> <img src="./images/Frame 4.png" alt="Website logo"> </a> </div>
        <div class="nav-item-wrapper">
            <ul class="nav-items">
                <li class="nav-item-1"> <a href="./index.php"> Home </a> </li>
                <li class="nav-item-2"> <a href="./index.php#BLOG"> Blogs </a> </li>
                <li class="nav-item-3"> <a href="./contact.php"> Need Blood </a> </li>
                <li class="nav-item-3"> <a href=""> Donate Blood </a> </li>
            </ul>
        </div>
        <div class="nav-right">
            <div> <a href="./login.php"> <button type="submit" class="login-btn primary-btn"> Login </button> </a> </div>
            <div> <a href="./signup.php"> <button type="submit" class="sign-up-btn secondary-btn"> Sign-up </button> </a> </div>
        </div>
    </nav>

    <div class="form-box form-wrap-1">
        <div class="bttn">
            <span class="tgl-bttn text-white"> LOGIN </span>
        </div>
        <form action="./login_action.php" method="POST">
            <input class="textbox" type="text" name="username" id="username" placeholder="Username" required>
            <input class="textbox" type="password" name="password" id="password" placeholder="Password" required>
            <input class="stbox" type="submit" value="Log In"> <br>
            <a href="" class="forgot-pass"> Forget Password? </a>
            <p class="create-act text-white"> New to Shop Bricks? <a href="./signup.php"> Sign up</a> </p>
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
                            <a href="" target="_blank"> 
                                <div class="footer-link-wrapper"> 
                                    <span class="material-symbols-outlined"> chevron_right </span> 
                                    <span class="footer-link-text"> Privacy </span> 
                                </div>
                            </a> 
                        </div>
                        <div> 
                            <a href="" target="_blank"> 
                                <div class="footer-link-wrapper"> 
                                    <span class="material-symbols-outlined"> chevron_right </span> 
                                    <span class="footer-link-text"> Cookies </span> 
                                </div>    
                            </a>
                        </div>
                        <div> 
                            <a href="" target="_blank"> 
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
        <p class="container cr-text"> Life Flow  &copy; &nbsp; | &nbsp ikovlad &nbsp | &nbsp; All rights reserved </p> 
    </section>

    <script>
        function fun1(){
            alert("Your appointment has been booked..! Please visit nearest one blood center to donate your blood");
        }
    </script>
</body>
</html>