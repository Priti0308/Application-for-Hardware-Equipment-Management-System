<?php
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    header("Location: ../admin/viewProduct.php");
    exit();
} else {
    echo "Invalid request.";
}
?>
