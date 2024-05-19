<?php
 
include("../config.php");
 
$sql = "SELECT * FROM products ORDER BY supplier";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product List</title>
    <link rel="stylesheet" href="../Css/style.css" />
    <link rel="stylesheet" href="../Css/home.css" />

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

        img {
            max-width: 100px;
            height: auto;
        }

        .supplier-heading {
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php include("adminHeader.php"); ?>
    <div class="homepage" style="margin: 5px;">
        <h2>Supplier List</h2>
        <?php
       
        if ($result->num_rows > 0) {
            $prevSupplier = "";  
            while ($row = $result->fetch_assoc()) { 
                if ($prevSupplier != $row['supplier']) {
                    if ($prevSupplier !== "") {
                        echo "</table>";  
                    }
                    echo "<div class='supplier-heading'>Supplier: {$row['supplier']}</div>";
                    echo "<table border='1'>";
                    echo "<tr><th>ID</th><th>Product Name</th><th>Brand</th><th>Manufacturer</th><th>Price</th><th>Category</th><th>Product Image</th><th>Created At</th></tr>";
                    $prevSupplier = $row['supplier'];
                }
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['product_name']}</td>";
                echo "<td>{$row['brand_name']}</td>";
                echo "<td>{$row['manufacturer']}</td>";
                echo "<td>{$row['price']}</td>";
                echo "<td>{$row['category']}</td>";
                echo "<td><img src='../product/{$row['product_image']}' alt='Product Image'></td>";
                echo "<td>{$row['created_at']}</td>";
                echo "</tr>";
            }
            echo "</table>";  
        } else {
            echo "No products found.";
        }
        ?>
    </div>
</body>

</html>
