<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hardware Shop - Order Details</title>
    <link rel="stylesheet" href="../Css/style.css" />
    <link rel="stylesheet" href="../Css/home.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0; 
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px; 
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            color: #333;
            margin-top: 0;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .order-details {
            margin-bottom: 20px;
        }

        .order-details p {
            margin: 10px 0;
            color: #666;
            font-size: 16px;
        }

        .order-details p strong {
            font-weight: bold;
        }

        .order-details .label {
            font-weight: bold;
            width: 150px;
            display: inline-block;
        }

        .order-details .value {
            margin-left: 10px;
        }

        .order-details .value,
        .order-details .label {
            vertical-align: top;
        }

        .error-message {
            color: #ff0000;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php include("adminHeader.php"); ?>
    <div class="container">
        <?php
        include("../config.php");
 
        if (isset($_GET['order_id'])) {
            $orderId = $_GET['order_id']; 
            $sql = "SELECT * FROM orders WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $orderId);
            $stmt->execute();
            $result = $stmt->get_result();
 
            if ($result->num_rows > 0) { 
                $order = $result->fetch_assoc();
                ?>
                <h2>Order Details</h2>
                <div class="order-details">
                    <p><span class="label">User Email:</span><span class="value"><?php echo $order['email']; ?></span></p>
                    <p><span class="label">First Name:</span><span class="value"><?php echo $order['first_name']; ?></span></p>
                    <p><span class="label">Last Name:</span><span class="value"><?php echo $order['last_name']; ?></span></p>
                    <p><span class="label">Company Name:</span><span class="value"><?php echo $order['company_name']; ?></span></p>
                    <p><span class="label">Country:</span><span class="value"><?php echo $order['country']; ?></span></p>
                    <p><span class="label">Street Address:</span><span class="value"><?php echo $order['street_address']; ?></span></p>
                    <p><span class="label">Apartment:</span><span class="value"><?php echo $order['apartment']; ?></span></p>
                    <p><span class="label">City:</span><span class="value"><?php echo $order['city']; ?></span></p>
                    <p><span class="label">State/County:</span><span class="value"><?php echo $order['state_county']; ?></span></p>
                    <p><span class="label">Postcode/Zip:</span><span class="value"><?php echo $order['postcode_zip']; ?></span></p>
                    <p><span class="label">Phone:</span><span class="value"><?php echo $order['phone']; ?></span></p>
                    <p><span class="label">Payment Method:</span><span class="value"><?php echo $order['payment_method']; ?></span></p>
                    <p><span class="label">Product Names:</span><span class="value"><?php echo $order['product_names']; ?></span></p>
                    <p><span class="label">Total Price:</span><span class="value"><?php echo $order['total_price']; ?></span></p>
                    <p><span class="label">Created At:</span><span class="value"><?php echo $order['created_at']; ?></span></p>
                </div>
                <?php
            } else {
                echo "<p class='error-message'>Order not found.</p>";
            }
        } else {
            echo "<p class='error-message'>Order ID not provided.</p>";
        }
        ?>
    </div>
</body>

</html>
