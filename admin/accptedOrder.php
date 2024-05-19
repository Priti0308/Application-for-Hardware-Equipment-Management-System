
<?php
include("../config.php");

 

$sql =  "SELECT orders.*, products.product_image 
FROM orders 
JOIN products ON orders.product_names LIKE CONCAT('%', products.product_name, '%')
WHERE orders.status = 'Accepted'"; 
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hardware Shop</title>
    <link rel="stylesheet" href="../Css/style.css" />
    <link rel="stylesheet" href="../Css/home.css" />
    <style>
        
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        img {
            max-width: 50px;
            height: auto;
        }

        .view-details {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
        }

        .view-details:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php include("adminHeader.php"); ?>
    <div class="homepage" style="margin: 5px;">
        <h2>Accept Orders</h2>
        <?php
       
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Product Photo</th><th>Product</th><th>User Email</th><th>Price</th><th>Address</th><th>Action</th></tr>";
           
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                if (isset($row['product_image'])) {
                    echo "<td><img src='../product/{$row['product_image']}' alt='Product Image'></td>";
                } else {
                   
                    echo "<td><img src='default_product_image_path' alt='Default Product Image'></td>";
                }
                echo "<td>{$row['product_names']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['total_price']}</td>";
                echo "<td>{$row['postcode_zip']}, {$row['country']}</td>";
                echo "<td>
                <form action='../controller/complete_order.php' method='get'>
                    <input type='hidden' name='order_id' value='{$row['id']}'>
                    <button type='submit' name='accept'>Complete Order</button>
                </form> <br />
                <a class='view-details' href='order_details.php?order_id={$row['id']}'>View Details</a>
            </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No rejected orders found.";
        }
        ?>
    </div>
</body>

</html>




