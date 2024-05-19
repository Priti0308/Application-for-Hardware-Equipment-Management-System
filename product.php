<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hardware Shop</title>
    <link rel="stylesheet" href="Css/style.css" />
    <link rel="stylesheet" href="Css/prod.css" />
</head>

<body> 
    <?php
    include("header.php");
    ?> 
    <div class="container">

        <div class="heading">
            <h1>Our Products</h1>
        </div>
        <div class="product-list">

              
<?php
include("config.php");
$sql = "SELECT id,product_name, price, product_image FROM products";
$result = $conn->query($sql);
if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) {
        $productId = $row["id"]; 
        $productName = $row["product_name"];
        $price = $row["price"]; 
        $product_image = $row["product_image"];  

        echo '<div class="product" data-price="' . $price . '">';
        echo '<div class="image">'; 
        echo '<img class="itm-img" src="product/' . $product_image . '" alt="' . $productName . '" />';
        echo '</div>';
        echo '<div class="info">';
        echo '<h3>' . $productName . '</h3>';
        echo '<p>Rs. ' . $price . '</p>';
        echo '</div>';
         
        echo '<form action="controller/addToCart.php" method="post" onsubmit="addToCart(this); return false;">';
                    echo '<input type="hidden" name="product_id" value="' . $productId . '">'; 
                    echo '<input type="hidden" name="quantity" value="1">';  
                    echo '<button type="submit" id="addToCartButton">Add to Cart</button>';
                    echo '</form>';
                    echo '<a href="singleProduct.php?id=' . $productId . '"><button>View Details</button></a>';
                    echo '</div>';
    }
} else {
    echo "0 results";
}

$conn->close();
?>
        </div>

     
    </div>

  
    <?php
    include("footer.php");
    ?>
  
</body>

</html>