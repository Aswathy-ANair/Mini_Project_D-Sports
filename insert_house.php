<?php

$conn = new mysqli('localhost', 'root', '', 'dsports');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $house_name = $_POST['house_name'];

    
    $sql = "INSERT INTO c_house (c_house_name,status) VALUES ('$house_name','active')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Houses inserted successfully.");</script>';
        echo '<script>window.location.href = "admin_insert_house.php";</script>';
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
    <title>Insert House</title>
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
    <h2 class="center-content">Add House</h2>
    <form action="insert_house.php" method="post" class="center-content">
        <label for="house_name">House Name:</label><br>
        <input type="text" id="house_name" name="house_name" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
