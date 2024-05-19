<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Css/cart.css">
    <link rel="stylesheet" href="Css/style.css">
    <link rel="stylesheet" href="Css/font-awesome/css/font-awesome.min.css"> 
</head>

<body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <?php
    include("header.php");
    ?> 
    <?php

    if (!isset($_SESSION['username'])) { 
        header("Location: login.php");
        exit();
    }
 
    include("config.php"); 
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT products.id, products.product_name, products.price, products.quantity, products.product_image, cart.quantity FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $productId = $_SESSION['user_id'];

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shopping Cart</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>

    <body>
        <h1 class="text-center mt-5">Shopping Cart</h1> 
                            <?php 
$totalAmount = 0;  
?>

<div class="container-fluid mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="table-responsive">
                <table id="myTable" class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th class="text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><div class='product-img'><div class='img-prdct'><img src='product/{$row['product_image']}' width='100px'></div></div></td>";
                            $product_names[] = $row['product_name'];
                            echo "<td><p>{$row['product_name']}</p></td>";
                            echo "<td>";
                            echo "<div class='button-container'>";
                            echo "<button class='btn btn-sm btn-primary decrease-qty' data-product-id='{$row['id']}'> - </button>";
                            echo "<input type='text' name='qty' min='0' max='{$row['quantity']}' class='qty form-control' value='{$row['quantity']}' />";
                            echo "<button class='btn btn-sm btn-primary increase-qty' data-product-id='{$row['id']}'> +
                            </button>";
                            echo "</div>";
                            echo "</td>";
                            echo "<td><input type='text' value='{$row['price']}' class='price form-control' disabled></td>";
 
                            $productTotal = $row['quantity'] * $row['price'];
                            echo "<td align='right'>Rs. <span class='amount'>$productTotal</span></td>";

                            echo "</tr>"; 
                            $totalAmount += $productTotal;
                        }
                        ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4"></td>
                            <td align="right"><strong>TOTAL = Rs. <span id="total" class="total"><?php echo $totalAmount; ?></span></strong></td>
                            <td>
                                <form action="buyNow.php" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                    <input type="hidden" name="product_names" value="<?php echo htmlspecialchars(serialize($product_names)); ?>">
                                    <input type="hidden" name="product_price" value="<?php echo $totalAmount; ?>">
                                    <button type="submit" class="btn btn-primary">Checkout Now!</button>
                                </form>
                            </td>
                        </tr>

                    </tfoot>


                </table>
            </div>
        </div>
    </div>
</div>
  <script> 
        document.addEventListener('DOMContentLoaded', function() {
            const decreaseButtons = document.querySelectorAll('.decrease-qty');
            const increaseButtons = document.querySelectorAll('.increase-qty');

            decreaseButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    const qtyInput = this.parentElement.querySelector('.qty');
                    if (parseInt(qtyInput.value) > 0) {
                        qtyInput.value = parseInt(qtyInput.value) - 1;
                        updateQuantity(productId, qtyInput.value);  
                    }
                });
            });

            increaseButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    const qtyInput = this.parentElement.querySelector('.qty');
                    qtyInput.value = parseInt(qtyInput.value) + 1;
                    updateQuantity(productId, qtyInput.value);  
                });
            });

            function updateQuantity(productId, quantity) { 
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'controller/updateCart.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200 && xhr.responseText === 'success') {
            console.log('Quantity updated successfully'); 
            location.reload(); 
        } else {
            console.error('Error updating quantity');
             
        }
    };
    xhr.send('product_id=' + productId + '&quantity=' + quantity);
}

        });
        
    </script>
    </body>

    </html>

    <?php 
    $stmt->close();
    $conn->close();
    ?>


    <?php
    include("footer.php");
    ?>
    <script src="JS/cart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>