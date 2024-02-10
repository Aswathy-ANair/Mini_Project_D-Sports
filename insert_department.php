<?php

$conn = new mysqli('localhost', 'root', '', 'dsports');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dept_name = $_POST['dept_name'];

    
    $sql = "INSERT INTO c_department (c_dept_name,status) VALUES ('$dept_name','active')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Department inserted successfully.");</script>';
        echo '<script>window.location.href = "admin_insert_department.php";</script>';
        exit; // To prevent further execution of PHP code
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Department</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add any additional stylesheets -->
     <style>
        /* Additional styles specific to this page */
        .center-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20vh; /* Adjust as needed */
        }
        .center-content form {
            width: 20px;
            /* Add additional styles if necessary */
        }
    </style>
</head>
<body >
    <h2 class="center-content">Add Department</h2>
    <form action="insert_department.php" method="post" class="center-content">
        <label for="dept_name">Department Name:</label><br>
        <input type="text" id="dept_name" name="dept_name" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
