<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../config.php");
    
    $stmt = $conn->prepare("INSERT INTO products (product_name, brand_name, manufacturer, supplier, price, category, quantity, warranty, product_desc, product_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssisss", $product_name, $brand_name, $manufacturer, $supplier, $price, $category, $quantity,  $warranty, $product_desc, $product_image);
    
    $product_name = $_POST['product_name'];
    $brand_name = $_POST['brand_name'];
    $manufacturer = $_POST['manufacturer'];
    $supplier = $_POST['supplier'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
      $warranty = $_POST['warranty'];
    $product_desc = $_POST['product_desc'];
    $product_image = basename($_FILES["product_image"]["name"]);
 
    $target_dir = "../product/";
    $target_file = $target_dir . $product_image;
    move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);

    $stmt->execute(); 
    $stmt->close();
    $conn->close();
 
    header("Location: ../admin/addProduct.php");
    exit();
}
?>
