<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_sell";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["submit"])) {
    $fullName = trim($_POST["fullname"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $passwordRepeat = $_POST["repeat_password"];
    
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $errors = array();
    
    // Check for empty fields
    if (empty($fullName) || empty($email) || empty($password) || empty($passwordRepeat)) {
        array_push($errors, "All fields are required.");
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid.");
    }

    // Validate password length
    if (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long.");
    }

    // Check if passwords match
    if ($password !== $passwordRepeat) {
        array_push($errors, "Passwords do not match.");
    }

    // Check password strength (at least 1 letter and 1 number)
    if (!preg_match("/^(?=.*[a-zA-Z])(?=.*[0-9])/", $password)) {
        array_push($errors, "Password must contain at least one letter and one number.");
    }

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("SQL error.");
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        array_push($errors, "Email already exists.");
    }

    // If there are errors, display them
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        // If no errors, insert the user into the database
        $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
            mysqli_stmt_execute($stmt);
            echo "<div class='alert alert-success'>You are registered successfully.</div>";
        } else {
            die("Something went wrong");
        }
    }

    mysqli_stmt_close($stmt);
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        body {
            background-color: #f4f4f4;
        }
        .container {
            max-width: 500px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-btn {
            text-align: center;
        }
        .alert {
            margin-bottom: 20px;
        }
    </style>
    <script>
        function validateForm() {
            const password = document.querySelector('input[name="password"]').value;
            const repeatPassword = document.querySelector('input[name="repeat_password"]').value;

            // Check password length
            if (password.length < 8) {
                alert("Password must be at least 8 characters long.");
                return false;
            }

            // Check if passwords match
            if (password !== repeatPassword) {
                alert("Passwords do not match.");
                return false;
            }

            // Check for password strength (at least 1 letter, 1 number)
            const passwordPattern = /^(?=.*[a-zA-Z])(?=.*[0-9])/;
            if (!passwordPattern.test(password)) {
                alert("Password must contain at least one letter and one number.");
                return false;
            }

            return true; // If all checks pass, submit the form
        }
    </script>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Registration Form</h2>
        <form action="" method="post" onsubmit="return validateForm();">
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required minlength="8">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password" required>
            </div>
            <div class="form-btn">
                <button type="submit" class="btn btn-primary" name="submit">Register</button>
            </div>
        </form>
        <div>
            <p class="text-center">Already Registered? <a href="login.php">Login Here</a></p>
        </div>
    </div>
</body>
</html>

