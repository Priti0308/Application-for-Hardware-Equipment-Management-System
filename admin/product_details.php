<?php
// Include the database configuration file
include("../config.php");

// Check if the product ID is provided in the URL
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Fetch product details from the database based on the product ID
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the product exists
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit(); // Stop further execution
    }
} else {
    echo "Product ID not provided.";
    exit(); // Stop further execution
}

// Check if the form is submitted for updating product details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $productName = $_POST['product_name'];
    $brandName = $_POST['brand_name'];
    $manufacturer = $_POST['manufacturer'];
    $supplier = $_POST['supplier'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $warranty = $_POST['warranty'];
    $productDesc = $_POST['product_desc'];
    $productImage = $_POST['product_image'];

    // Prepare an SQL statement to update the product details
    $sql = "UPDATE products SET 
    product_name = ?, 
    brand_name = ?, 
    manufacturer = ?, 
    supplier = ?, 
    price = ?, 
    category = ?, 
    quantity = ?, 
    warranty = ?, 
    product_desc = ?
    WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssdssssi",
        $productName,
        $brandName,
        $manufacturer,
        $supplier,
        $price,
        $category,
        $quantity,
        $warranty,
        $productDesc,
        $productId
    );
 

    // Execute the SQL statement
    if ($stmt->execute()) {
        echo "Product details updated successfully.";
    } else {
        echo "Error updating product details: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="../Css/style.css">
    <link rel="stylesheet" href="../Css/home.css">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            margin-top: 0;
        }

        .inputBox {
            margin-bottom: 20px;
        }

        .inputBox span {
            display: inline-block;
            width: 150px;
            font-weight: bold;
        }

        .inputBox input[type="text"],
        .inputBox input[type="number"],
        .inputBox textarea {
            width: calc(100% - 150px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .inputBox textarea {
            height: 100px;
            resize: none;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
 
        #imagePreview {
            
            max-width: 300px;
    margin-top: 10px;
    display: block;
    position: absolute;
    top: 150px;
    right: 50px;
    width: 300px;
    border: 1px solid; 
    margin: 5px;
        }
    </style>
</head>

<body>
    <?php include("adminHeader.php"); ?>
    <div class="container">
        <h2>Product Details</h2>
        <form method="post" action="product_details.php?id=<?php echo $product['id']; ?>">
            <div class="inputBox">
                <span>Product Name:</span>
                <input type="text" name="product_name" value="<?php echo $product['product_name']; ?>" required>
            </div>
            <div class="inputBox">
                <span>Brand Name:</span>
                <input type="text" name="brand_name" value="<?php echo $product['brand_name']; ?>" required>
            </div>
            <div class="inputBox">
                <span>Manufacturer:</span>
                <input type="text" name="manufacturer" value="<?php echo $product['manufacturer']; ?>" required>
            </div>
            <div class="inputBox">
                <span>Supplier:</span>
                <input type="text" name="supplier" value="<?php echo $product['supplier']; ?>" required>
            </div>
            <div class="inputBox">
                <span>Price:</span>
                <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required>
            </div>
            <div class="inputBox">
                <span>Category:</span>
                <input type="text" name="category" value="<?php echo $product['category']; ?>" required>
            </div>
            <div class="inputBox">
                <span>Quantity:</span>
                <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" required>
            </div>
            <div class="inputBox">
                <span>Warranty:</span>
                <input type="text" name="warranty" value="<?php echo $product['warranty']; ?>" required>
            </div>
            <div class="inputBox">
                <span>Product Description:</span>
                <textarea name="product_desc" rows="5" required><?php echo $product['product_desc']; ?></textarea>
            </div>
            <img id="imagePreview" src="../product/<?php echo $product['product_image']; ?>" alt="Product Image Preview">
            <input type="submit" value="Update">
        </form>
    </div> 
    <script>
       
        function updatePreview() {
            var input = document.getElementById('product_image');
            var preview = document.getElementById('imagePreview');
            preview.src = input.value;
        }
  </script>
</body>

</html>
