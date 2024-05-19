<?php
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   include("../config.php");
 
    $stmt = $conn->prepare("INSERT INTO feedbackForm (full_name, phone_number, email, opinion) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $full_name, $phone_number, $email, $opinion);
 
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $opinion = $_POST['opinion'];
    $stmt->execute();
    
    $stmt->close();
    $conn->close();

    
    header("Location: ../feedback.php");
    exit();
}
?>
