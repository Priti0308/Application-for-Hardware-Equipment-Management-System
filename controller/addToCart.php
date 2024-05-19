<?php
session_start();
 
if (!isset($_SESSION['user_id'])) { 
    header("Location: ../login.php");
    exit();
}
 
include("../config.php"); 
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];
 
$user_id = $_SESSION['user_id']; 
$sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $user_id, $product_id, $quantity); 
if ($stmt->execute()) { 

    header("Location: ../cart.php"); 
    exit();
} else { 
    echo "Error: " . $sql . "<br>" . $conn->error;
}
 
$stmt->close();
$conn->close();
?>
