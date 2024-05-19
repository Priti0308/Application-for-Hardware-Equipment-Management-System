<?php
include("../config.php");

if (isset($_GET['order_id'], $_GET['product_names'])) {
    $orderId = $_GET['order_id'];
    $productNames = $_GET['product_names'];

    try {
        $conn->begin_transaction();
 
        $sqlUpdateOrder = "UPDATE orders SET status = 'Accepted' WHERE id = ?";
        $stmtUpdateOrder = $conn->prepare($sqlUpdateOrder);
        $stmtUpdateOrder->bind_param("i", $orderId);
        $stmtUpdateOrder->execute();
        $stmtUpdateOrder->close(); 
        
        $sqlReduceQuantity = "UPDATE products SET quantity = quantity - 1 WHERE product_name = ?";
        $stmtReduceQuantity = $conn->prepare($sqlReduceQuantity);

        foreach ($productNames as $productName) {
            $stmtReduceQuantity->bind_param("s", $productName);
            if (!$stmtReduceQuantity->execute()) {
                echo "Error updating quantity: " . $stmtReduceQuantity->error;
                exit();
            }
        }

        $conn->commit();

        header("Location: ../admin/index.php?success=1");
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
        exit();
    }
} else {
    echo "Order ID or product names not provided";
    exit();
}

$conn->close();
