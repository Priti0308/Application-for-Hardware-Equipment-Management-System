<?php
session_start();
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $cn = $_POST['cn'];
    $country = $_POST['selection'];
    $houseadd = $_POST['houseadd'];
    $apartment = $_POST['apartment'];
    $city = $_POST['city'];
    $state_county = $_POST['state_county'];
    $postcode_zip = $_POST['postcode_zip'];
    $phone = $_POST['phone'];
    $payment_method =  "cd";  
    $product_names_json = json_encode($_POST['product_names']);
    $product_names = json_decode($product_names_json, true);
    $productPrice = $_POST['product_price'];   
    include("../config.php");  

    $sql = "INSERT INTO orders (email, first_name, last_name, company_name, country, street_address, apartment, city, state_county, postcode_zip, phone, payment_method, product_names, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssss", $email, $fname, $lname, $cn, $country, $houseadd, $apartment, $city, $state_county, $postcode_zip, $phone, $payment_method, $product_names, $productPrice);
    $stmt->execute();
    $stmt->close();
    $conn->close();
 
    header("Location: thank_you_page.php");
    exit();
} else {
     
    header("Location: buyNow.php");
    exit();
}
?> 