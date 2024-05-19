<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("Location: login.php");
    exit();
}
 
if (isset($_POST['product_id']) && isset($_POST['product_price'])) { 
    $productId = $_POST['product_id'];
    $productPrice = $_POST['product_price'];
} else {
    header("Location: cart.php");
    exit();
}
include("../config.php"); 
$sql = "INSERT INTO orders (username, product_id, product_price, first_name, last_name, company_name, country, street_address, apartment, city, state_county, postcode_zip, phone, email) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
 
$stmt = $conn->prepare($sql);
$stmt->bind_param("siissssssssss", $username, $productId, $productPrice, $firstName, $lastName, $companyName, $country, $streetAddress, $apartment, $city, $stateCounty, $postcodeZip, $phone, $email);
 
$firstName = $_POST['fname'];
$lastName = $_POST['lname'];
$companyName = $_POST['cn'];
$country = $_POST['selection'];
$streetAddress = $_POST['houseadd'];
$apartment = $_POST['apartment'];
$city = $_POST['city'];
$stateCounty = $_POST['state_county'];
$postcodeZip = $_POST['postcode_zip'];
$phone = $_POST['phone'];
$email = $_POST['email'];

$stmt->execute();

$stmt->close();
$conn->close();
 
header("Location: success.php");
exit();
?>
