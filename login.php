<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hardware Shop</title>
    <link rel="stylesheet" href="Css/style.css" />
    <link rel="stylesheet" href="Css/loginpage.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&family=Varela+Round&display=swap" rel="stylesheet">
    
</head>

<body>
   
<?php
include("header.php");
?>

    <div class="img"></div>

    <div class="wrapper">
        <div class="title-text">
            <div class="title login">Login Form</div>
            <div class="title signup">Signup Form</div>
        </div>
        <div class="form-container">
            <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Login</label>
                <label for="signup" class="slide signup">Signup</label>
                <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
                <form action="controller/cheackUser.php" method="post" class="login">
                    <div class="field">
                        <input type="text" name="username" placeholder="Email Address" required>
                    </div>
                    <div class="field">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" name="login" value="Login">
                    </div>
                    <div class="signup-link">Don't have an account<a href="">Signup now</a></div>
                </form>
                <form action="controller/cheackUser.php" method="post" class="signup">
                    <div class="field">
                        <input type="text" name="username" placeholder="Email Address" required>
                    </div>
                    <div class="field">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="field">
                        <input type="password" name="confirm_password" placeholder="Confirm password" required>
                    </div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" name="signup" value="Signup">
                    </div>
                </form>
            </div>
        </div>
    </div>
   <footer>
        <div class="content">
            <div class="top">
                <div class="logo-details">

                    <span class="logo_name">Shree Ganesha Hardware Shop</span>
                </div>

            </div>
        </div>
        <div class="bottom-details">
            <div class="bottom_text">
                <span class="copyright_text">Copyright &#169; 2024 <a href="#">Shree Ganesha Hardware Shop</a>All rights reserved</span>
                <span class="policy_terms">
              <a href="#">Privacy policy</a>
              <a href="#">Terms & condition</a>
            </span>
            </div>
        </div>
    </footer> 
    <script src="JS/main.js"></script>
</body>

</html>