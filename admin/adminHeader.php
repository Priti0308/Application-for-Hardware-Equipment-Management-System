<?php
session_start();

if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin') {
    $username = $_SESSION['username'];
} else {
   
    header("Location: ../login.php");
    exit();
}
?>


<nav class="navbar">
    <div class="navbar-container container">
        <input type="checkbox" name="" id="" />
        <div class="hamburger-lines">
            <span class="line line1"></span>
            <span class="line line2"></span>
            <span class="line line3"></span>
        </div>
        <ul class="menu-items">
            <li><a href="newOrder.php">Home</a></li>
            <div class="dropdown">
                <a class="dropbtn">Product</a>
                <div class="dropdown-content">
                <a href="addProduct.php">Add Product</a>
                <a href="viewProduct.php">View Product</a>
                     
                </div>
            </div> 
            <div class="dropdown">
                <a class="dropbtn">Order</a>
                <div class="dropdown-content">
                    <a href="accptedOrder.php">Accepted</a>
                    <a href="rejectedOrder.php">Rejected</a>
                    <a href="pendingOrder.php">Pending</a>
                    <a href="completedOrder.php">Completed</a>
                </div>
            </div>
            <li><a href="supplier.php">Supplier</a></li>
            <li><a href="usersDetails.php">User</a></li>
            <li><a href="viewContact.php">Contact</a></li>
            <li><a href="viewFeedback.php">Feedback</a></li>
            <li><a href="index.php">Reports</a></li>
           </ul>
        <div class="user-info">
                <a href="../logout.php" class="logout">Logout</a>

        </div>
        <h1 class="logo"> <a class="logo" href="/">Admin</a> </h1>
         
    </div>

</nav>