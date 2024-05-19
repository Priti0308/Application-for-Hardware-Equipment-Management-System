<?php


function getCartItemCount() {
    if (isset($_SESSION['user_id'])) {
        include("config.php");
        $userId = $_SESSION['user_id'];
        $sql = "SELECT COUNT(*) AS count FROM cart WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'];
    } else {
        
        return 0;
    }
}
 
$cartItemCount = getCartItemCount();

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
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="product.php">Products</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="feedback.php">Feedback</a></li>
        </ul>
        <div class="user-info">
            <?php if (isset($username)) : ?>
                <span class="username" style="overflow: hidden; width: 150px;"><?php echo $username; ?></span>
                <a href="logout.php" class="logout">Logout</a>
            <?php else : ?>
                <a href="login.php" class="login">Login</a>
            <?php endif; ?>
            <div class="cart-logo">
                <a style="background-color: transparent;" class="cart" href="cart.php">
                 
                    <p class="cart" style="position: absolute;
    top: 9px;
    background: white;
    border-radius: 13px;
    color: red;
    width: 20px;
    text-align: center;
    right: 140px;
}"><?php echo ($cartItemCount > 0) ? "<span>$cartItemCount</span>" :""; ?></p>
                </a>
            </div>
        </div>
        <h1 class="logo">Hardware</h1>
    </div>
</nav>