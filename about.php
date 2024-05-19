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
    <link rel="stylesheet" href="Css/about.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&family=Varela+Round&display=swap" rel="stylesheet">
</head>

<body>
   
<?php
include("header.php");
?> 

    <div class="wrapper">
        <div class="row">
            <div class="image-section">
                <img src="img/logo.png" alt="">
            </div>
            <div class="about">
                <h1>About Us</h1>
                <h2>Our Hardware Shop</h2>
                <p>Welcome to our Hardware City shop!!! <br/> We stores typically sells hand and power tools, building materials, fasteners, locks, keys, hinges, chains, electrical supplies, toolboxes, plumbing supplies, cleaning products, home products,
                    paint & brushes, utensils, wires and nutbolts, metal supplies and much more things.We pride ourselves on providing top-quality tools and materials for all your DIY needs.With over 30 years of experience, our knowladgeale staff is here
                    to assist you in finding the perfect tools and equipment for your projects. From power tools to plumbing supplies, we havegot you covered.We believing in delivering excellent customer service and building lasting relationships with
                    our customers.
                </p>
            </div>
        </div>
    </div>
 
    <?php
include("footer.php");
?>
   
</body>

</html>