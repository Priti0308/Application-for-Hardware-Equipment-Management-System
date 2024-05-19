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
    <link rel="stylesheet" href="Css/home.css" />
</head>

<body>

<?php
include("header.php");
?>
    <div class="homepage">
        <div class="img"></div>
        <div class="welcome">
            <h1 id="wel"><b>welcome </b>

                <p id="lorem"> Welcome to our shop, where you'll find the <br /> perfect blend of quality and value.<br />
                    <br /> We are here to serve you and give you a better &<br /> reliable resources to make your business an <br /> unforgettable brand.<br />
                </p>

        </div>
    </div> 
    <?php
include("footer.php");
?> 
</body>

</html>