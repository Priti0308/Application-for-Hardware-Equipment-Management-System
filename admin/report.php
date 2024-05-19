<?php
include("../config.php");

// Fetch data for users
$sqlUsers = "SELECT * FROM users";
$resultUsers = $conn->query($sqlUsers);

$sqlProducts = "SELECT * FROM products";
$resultProducts = $conn->query($sqlProducts);

$sqlOrder =  "SELECT orders.*, products.product_image 
FROM orders 
JOIN products ON orders.product_names LIKE CONCAT('%', products.product_name, '%')
WHERE orders.status IN ('Rejected', 'Accepted', 'Completed');
";
$resultOrder = $conn->query($sqlOrder);


$sqlContact = "SELECT * FROM contactForm";
$resultcontact = $conn->query($sqlContact);

$sqlfeedback = "SELECT * FROM feedbackform";
$resultfeedback = $conn->query($sqlfeedback);

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
        .hidden {
            display: none;
        }

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

        button {

            background-color: #0a0a23;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 15px;
            min-height: 30px;
            margin: 10px 50px 0px 50px;
        }
    </style>
</head>

<body>
    <?php include("adminHeader.php"); ?>
    <div class="homepage" style="margin: 5px;">
        <button class="btn" onclick="showDiv(1)">User</button>
        <button class="btn" onclick="showDiv(2)">Product</button>
        <button class="btn" onclick="showDiv(3)">Order</button>
        <button class="btn" onclick="showDiv(4)">Contact</button>
        <button class="btn" onclick="showDiv(5)">Feedback</button>
        <br><br>
        <div id="div1">
            <h2>User List</h2>
            <?php
            if ($resultUsers->num_rows > 0) {
                echo "<table>";
                echo "<thead><tr><th>ID</th><th>Username</th><th>Password</th></tr></thead>";
                echo "<tbody>";
                while ($row = $resultUsers->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['password'] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "No users found.";
            }
            ?>


        </div>
        <div id="div2" class="hidden">

            <h2>Product List</h2>
            <?php

            if ($resultProducts->num_rows > 0) {
                echo "<table>";
                echo "<thead><tr><th>ID</th><th>Product Name</th><th>Brand</th><th>Manufacturer</th><th>Supplier</th><th>Price</th><th>Category</th><th>Quantity</th> <th>Warranty</th> <th>Product Image</th></tr></thead>";
                echo "<tbody>";

                while ($row = $resultProducts->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['product_name'] . "</td>";
                    echo "<td>" . $row['brand_name'] . "</td>";
                    echo "<td>" . $row['manufacturer'] . "</td>";
                    echo "<td>" . $row['supplier'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td>" . $row['category'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['warranty'] . "</td>";
                    echo "<td><img src='../product/{$row['product_image']}' alt='Product Image' class='product-image'></td>";

                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            } else {

                echo "No products found.";
            }


            $conn->close();
            ?>

        </div>
        <div id="div3" class="hidden">
            <h2> Orders</h2>
            <?php

            if ($resultOrder->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Product Photo</th><th>Product</th><th>User Email</th><th>Price</th><th>Address</th><th>Action</th></tr>";

                while ($row = $resultOrder->fetch_assoc()) {
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
                    echo "<td><a class='view-details' href='order_details.php?order_id={$row['id']}'>View Details</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No rejected orders found.";
            }
            ?>
        </div>
        <div id="div4" class="hidden">
            <h2>Contact Form Submissions</h2>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Created At</th>
                </tr>
                <?php

                if ($resultcontact->num_rows > 0) {

                    while ($row = $resultcontact->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["full_name"] . "</td>";
                        echo "<td>" . $row["phone_number"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["subject"] . "</td>";
                        echo "<td>" . $row["created_at"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No submissions found.</td></tr>";
                }
                ?>
            </table>
        </div>
        <div id="div5" class="hidden">
            <h2>Feedback Form Submissions</h2>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Opinion</th>
                    <th>Created At</th>
                </tr>
                <?php

                if ($resultfeedback->num_rows > 0) {

                    while ($row = $resultfeedback->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["full_name"] . "</td>";
                        echo "<td>" . $row["phone_number"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["opinion"] . "</td>";
                        echo "<td>" . $row["created_at"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No submissions found.</td></tr>";
                }
                ?>
            </table>
        </div>
        <div id="div6" class="hidden">Div 6 Content</div>
    </div>

    <script>
        function showDiv(divNumber) {
            // Hide all divs
            for (let i = 1; i <= 6; i++) {
                document.getElementById('div' + i).classList.add('hidden');
            }
            // Show the selected div
            document.getElementById('div' + divNumber).classList.remove('hidden');
        }

        // Show the first div by default
        document.getElementById('div1').classList.remove('hidden');
    </script>
</body>

</html>