<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("Location: login.php");
    exit();
}
$productId = $_GET['id'];
if (isset($_GET['id'])) {

    include("config.php"); 
    $sql = "SELECT * FROM products WHERE id = $productId";
    $result = $conn->query($sql);
 
    if ($result->num_rows > 0) { 
        $row = $result->fetch_assoc();
        $price = $row["price"];
        $product_image = $row["product_image"];
        $id = $row["id"];
        $productName = $row["product_name"];
        $product_names[] = $row['product_name']; 
        $brandName = $row["brand_name"];
        $manufacturer = $row["manufacturer"];
        $supplier = $row["supplier"];
        $category = $row["category"];
        $quantity = $row["quantity"];
        $warranty = $row["warranty"];
        $productDesc = $row["product_desc"];
        $createdAt = $row["created_at"];
 
         $conn->close();
    } else {
        echo "Product not found";
        exit();  
    }
} else {
    echo "Product ID not provided";
    exit();  
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>amazon | Product Page</title>
    <link href="style.css" rel="stylesheet" />
    <link rel="stylesheet" href="Css/style.css">
    <link rel="stylesheet" href="Css/singleProduct.css">

</head>

<body>

    <?php
    include("header.php");
    ?>




    <section id="product-info" style="margin: 5vh;">
        <div class="item-image-parent">
            <div class="item-list-vertical"> 
            </div>
            <div class="item-image-main"> 
                <img style="height: 350px;" src="product/<?php echo $product_image; ?>" alt="<?php echo $productName; ?>" />
            </div>
        </div>
        <div class="item-info-parent"> 
            <div class="main-info">
                <h4><?php echo $productName; ?></h4>
                <p>Price: <span id="price">₹ <?php echo $price; ?></span></p>
            </div> 
            <div class="select-items"> 
                <div class="description">
                    <ul> 
                        <li>Brand Name: <?php echo $brandName; ?></li>
                        <li>manufacturer: <?php echo $manufacturer; ?></li>
                        <li>supplier: <?php echo $supplier; ?></li>
                        <li>category: <?php echo $category; ?></li>
                        <li>quantity: <?php echo $quantity; ?></li>
                        <li>warranty: <?php echo $warranty; ?></li>
                        <li>productDesc: <?php echo $productDesc; ?></li>
                    </ul>
                </div>
                <br>
                <div style="display: flex;"> 
                    <button class="addToCart">Add to Cart</button> 
                    <form action="buyNow.php" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                        <input type="hidden" name="product_names" value="<?php echo htmlspecialchars(serialize($product_names)); ?>">

                        <input type="hidden" name="product_price" value="<?php echo $price; ?>">
                        <button type="submit">Buy Now!</button>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <?php
    include("footer.php");
    ?>
</body>

</html>