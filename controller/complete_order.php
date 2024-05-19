<?php  
include("../config.php");
 
if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];
    
    $sql = "SELECT * FROM orders WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
 
    if ($result->num_rows > 0) { 
        $order = $result->fetch_assoc(); 
        $status = "Completed";
        $sqlUpdate = "UPDATE orders SET status = ? WHERE id = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("si", $status, $orderId);
        $stmtUpdate->execute();
 
        header("Location: ../admin/accptedOrder.php");
        exit();
    } else {
     
        echo "Order not found";
        exit();
    }
} else {
     
    echo "Order ID not provided";
    exit();
} 
$stmt->close();
$conn->close();
?>
