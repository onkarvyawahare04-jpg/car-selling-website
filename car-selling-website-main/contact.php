<?php
// Include the database connection
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form inputs
    $name = trim($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = trim($_POST['message']);

    // Validate name
    if (empty($name)) {
        echo "Name is required.<br>";
        exit;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.<br>";
        exit;
    }

    // Validate message (min length)
    if (strlen($message) < 10) {
        echo "Message should be at least 10 characters.<br>";
        exit;
    }

    // Prepare and bind parameters to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>
