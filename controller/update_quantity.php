<?php
 
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    if (isset($_POST['productId']) && isset($_POST['action']) && !empty($_POST['productId']) && !empty($_POST['action'])) {
        
        $productId = mysqli_real_escape_string($conn, $_POST['productId']);
        $action = ($_POST['action'] === 'add') ? 'add' : 'less';
 
        $sql = "SELECT quantity FROM products WHERE id = '$productId'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentQuantity = $row['quantity'];

      
            if ($action === 'add') {
                $newQuantity = $currentQuantity + 1;
            } else {
                
                $newQuantity = max($currentQuantity - 1, 0);
            }

             
            $updateSql = "UPDATE products SET quantity = '$newQuantity' WHERE id = '$productId'";
            if ($conn->query($updateSql) === TRUE) {
                echo "Quantity updated successfully.";
            } else {
                echo "Error updating quantity: " . $conn->error;
            }
        } else {
            echo "Product not found.";
        }
    } else {
        echo "Invalid input.";
    }
} else {
    echo "Invalid request.";
}
?>
