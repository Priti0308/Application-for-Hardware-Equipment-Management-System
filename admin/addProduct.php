 
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hardware Shop</title>
    <link rel="stylesheet" href="../Css/style.css">
    <link rel="stylesheet" href="../Css/bill.css">

</head>


<body> 
<?php
        include("adminHeader.php");
        ?>
    <div class="billing">

    <form action="../controller/addProduct.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col">
            <h3 class="title">Product details</h3>
            <div class="inputBox">
                <span>Product name:</span>
                <input type="text" name="product_name" placeholder="Ex: Wires & tapes">
            </div>
            <div class="inputBox">
                <span>Brand Name:</span>
                <input type="text" name="brand_name" placeholder="EX: ACME">
            </div>
            <div class="inputBox">
                <span>Manufacturer :</span>
                <input type="text" name="manufacturer" placeholder="EX: All-Star abc xyz">
            </div>
            <div class="inputBox">
                <span>Supplier :</span>
                <input type="text" name="supplier" placeholder="EX: All-Star abc xyz">
            </div>
            <div class="inputBox">
                <span>Price :</span>
                <input type="text" name="price" placeholder="Rs.450">
            </div>
            <div class="flex">
            <div class="inputBox">
    <label for="category">Category:</label>
    <select id="category" name="category">
        <option value="Power Tools">Power Tools</option>
        <option value="Hand Tools">Hand Tools</option>
        <option value="Building Materials">Building Materials</option>
        <option value="Hardware Accessories">Hardware Accessories</option>
    </select>
</div>

                <div class="inputBox">
                    <span>Quantity:</span>
                    <input type="number" name="quantity" placeholder="4">
                </div>
            </div>
        </div>
        <div class="col">
            <h3 class="title">Information</h3>
            
            <div class="inputBox">
                <span>Warranty :</span>
                <input type="text" name="warranty" placeholder="1 year">
            </div>
            <div class="inputBoxv" style="display: grid;">
                <span>Product Description :</span>
                
                <textarea style="border: 1px solid black;" name="product_desc" id="product_desc" cols="30" rows="10"></textarea>
            </div>
            <div class="inputBox">
                <span>Product Image:</span>
                <input style="height: 80px;" type="file" name="product_image" accept="image/png, image/jpg">
            </div>
        </div>
    </div>
    <input type="submit" value="Add Product" class="submit-btn">
</form>


    </div>
 
</body>

</html>