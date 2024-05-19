<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hardware Shop</title>
    <link rel="stylesheet" href="../Css/style.css" />
    <link rel="stylesheet" href="../Css/home.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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

        tr:hover {
            background-color: #f5f5f5;
        }

        .product-image {
            max-width: 100px;
            height: auto;
        }

        .action-buttons {
            display: flex;
            align-items: center;
        }

        .action-buttons button {
            margin-right: 5px;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .view-details {
            background-color: #007bff;
    color: #fff;
    text-decoration: none;
    padding: 5px;
    border-radius: 9px;
        }
        .deleteBtn {
            background-color: red;
    color: #fff;
    text-decoration: none;
    padding: 5px;
    border-radius: 9px;
        }

        .addBtn {
            background-color: #28a745;
            color: #fff;
        }

        .lessBtn {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>

<body>
    <?php include("adminHeader.php"); ?>
    <div class="homepage" style="margin: 5px;">
        <h2>Product List</h2>
        <table>
            <thead>
                <tr>
                <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Brand</th>
                    
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                include("../config.php");

               
                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><img src='../product/{$row['product_image']}' alt='Product Image' class='product-image'></td>";
                       
                        echo "<td>{$row['product_name']}</td>";
                        echo "<td>{$row['category']}</td>";
                        echo "<td>{$row['price']}</td>";
                        echo "<td>{$row['brand_name']}</td>";
                        echo "<td>{$row['quantity']}</td>";
                        echo "<td class='action-buttons'>";
                        
                        echo '<td class="action-buttons">
                        <button class="addBtn" data-id="' . $row['id'] . '">Add Quantity</button>
                        <button class="lessBtn" data-id="' . $row['id'] . '">Less Quantity</button>
                        
                        <form method="post" action="../controller/delete_product.php" style="display: inline;">
                            <input type="hidden" name="product_id" value="' . $row['id'] . '">
                            <button type="submit" class="deleteBtn">Delete</button>
                        </form>
                        <a href="product_details.php?id=' . $row['id'] . '" class="view-details">View Details</a>
                      </td>';
                
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No products found.</td></tr>";
                }
                ?>
            </tbody>
            
        </table>
    </div>

    <script>
        $(document).ready(function() {
             
            $('.addBtn').click(function() {
                var productId = $(this).data('id');
                updateQuantity(productId, 'add');
            });

             
            $('.lessBtn').click(function() {
                var productId = $(this).data('id');
                updateQuantity(productId, 'less');
            });

            
            function updateQuantity(productId, action) {
                $.ajax({
                    url: '../controller/update_quantity.php',
                    method: 'POST',
                    data: {
                        productId: productId,
                        action: action
                    },
                    success: function(response) {
                         
                        location.reload();
                    }
                });
            }
        });
    </script>
</body>

</html>
