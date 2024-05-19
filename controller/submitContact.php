<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../config.php"); 
    $stmt = $conn->prepare("INSERT INTO contactForm (full_name, phone_number, email, subject) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $full_name, $phone_number, $email, $subject); 

    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $stmt->execute();
 
    $stmt->close();
    $conn->close(); 
    header("Location: ../contact.php");
    exit();
}
?>
