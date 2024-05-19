
<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hardware Shop</title>
    <link rel="stylesheet" href="Css/style.css" />
    <link rel="stylesheet" href="Css/feed.css">
</head>

<body>
 
<?php
include("header.php");
?>

    <div class="feedback">
    <form action="controller/submitFeedback.php" method="post">
    <i class="fas fa-paper-plane"></i>
    <div class="input-group">
        <label for="full-name">Full Name</label>
        <input type="text" id="full-name" name="full_name" placeholder="Enter your name">
        <span id="name-error"></span>
    </div>
    <div class="input-group">
        <label for="phone-no">Phone No.</label>
        <input type="tel" id="phone-no" name="phone_number" placeholder="123 456 7890">
        <span id="phone-error"></span>
    </div>
    <div class="input-group">
        <label for="email">Email Id</label>
        <input type="email" id="email" name="email" placeholder="Enter Email">
        <span id="email-error"></span>
    </div>

    <div class="input-group">
        <label for="opinion">Your Opinion</label>
        <textarea id="opinion" name="opinion" rows="5" placeholder="Enter your Feedback"></textarea>
        <span id="opinion-error"></span>
    </div>

    <button type="submit">Submit</button>
    <span id="submit-error"></span>
</form>

    </div>
    <?php
include("footer.php");
?>
    
    <script src="switch-form.js"></script>
</body>

</html>