<?php
 
include("../config.php");
 
$sql = "SELECT * FROM feedbackform";
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
    </style>
</head>

<body>
    <?php include("adminHeader.php"); ?>
    <div class="homepage" style="margin: 5px;">
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
             
            if ($result->num_rows > 0) {
                
                while ($row = $result->fetch_assoc()) {
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
</body>

</html>
