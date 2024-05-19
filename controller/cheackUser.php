<?php
session_start();

 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../config.php");

    
    if (isset($_POST['login'])) {
       
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($username === 'admin' && $password === 'admin') {
            $_SESSION['username'] = $username;
            
            header("Location: ../admin/");
            exit();
        }

        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
               
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $row['id'];  
                $_SESSION['email'] = $row['email'];  

                
                header("Location: ../index.php");
                exit();
            } else {
                
                echo "Incorrect password";
            }
        } else {
            
            echo "User not found";
        }
    } elseif (isset($_POST['signup'])) {
        
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

        if ($conn->query($sql) === TRUE) {
         
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $conn->insert_id;  
            $_SESSION['email'] = $username;  
 
            header("Location: ../index.php");
            exit();
        } else {
             
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
