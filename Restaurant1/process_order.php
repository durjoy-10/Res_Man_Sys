<?php
// Database connection details
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "restaurant_db"; 

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $instructions = $_POST["instructions"];

    // Insert data into the database
    $sql = "INSERT INTO orders_1 (name, email, phone, address, instructions) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $email, $phone, $address, $instructions);

    if ($stmt->execute()) {
        echo "<p>Order placed successfully!</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>



<!-- CREATE TABLE orders_1 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    instructions TEXT,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); -->