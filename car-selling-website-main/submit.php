<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and trim to remove unnecessary spaces
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);


    // Server-side validation
    $errors = [];

    // Check if name is empty
    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate phone number (must be exactly 10 digits)
    if (!preg_match('/^[0-9]{10}$/', $phone)) {
        $errors[] = "Phone number must be a valid 10-digit number.";
    }

    // Validate that pickup date is not after return date
    if (strtotime($pickup_date) > strtotime($return_date)) {
        $errors[] = "Pickup date must be before return date.";
    }

    // If there are errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    } else {
        // Insert data into the database
        $sql = "INSERT INTO bookings (name, email, phone, pickup_date, return_date)
                VALUES ('$name', '$email', '$phone', '$pickup_date', '$return_date')";

        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Booking Successful! You will be redirected to home page in few seconds...</p>";

            // Add JavaScript to redirect after 19 seconds
            echo "<script>
                    setTimeout(function(){
                        window.location.href = 'index.html';
                    }, 10000); // 10 seconds
                  </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
