<?php
session_start();

if (!isset($_SESSION['username'])) {
     
    header("Location: login.php");
    exit();
}

include("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $userId = $_SESSION['user_id'];

    if ($quantity <= 0) {
      
        $sql = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $userId, $productId);
        $stmt->execute();
        $stmt->close();
    } else {
     
        $sql = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $quantity, $userId, $productId);
        $stmt->execute();
        $stmt->close();
    }

     
    $conn->close();

  
    echo "success";
} else {
    
    echo "error";
}
?>
