<?php
include('db_connection.php');

$conn = new mysqli('localhost', 'root', '', 'dsports');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $studentId = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Process the form submission
        $newUsername = $_POST['new_username'];

        // Update the username in both c_student and c_login tables
        $updateUsernameSQL = "UPDATE `c_student` s
                              JOIN `c_login` l ON s.c_username = l.c_username
                              SET s.c_username = '$newUsername', l.c_username = '$newUsername'
                              WHERE s.c_student_id = $studentId";

        if ($conn->query($updateUsernameSQL) === TRUE) {
            echo "Username updated successfully.";
        } else {
            echo "Error updating username: " . $conn->error;
        }
    }

    // Fetch the current username
    $currentUsernameQuery = "SELECT c_username FROM `c_student` WHERE `c_student_id` = $studentId";
    $currentUsernameResult = $conn->query($currentUsernameQuery);

    if ($currentUsernameResult->num_rows > 0) {
        $row = $currentUsernameResult->fetch_assoc();
        $currentUsername = $row['c_username'];
    } else {
        echo "Error fetching current username: " . $conn->error;
    }
} else {
    echo "Invalid student ID.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Username</title>
    <style>
        body {
            text-align: center;
            
            background-color: #E5D599;
        }

        form {
            width: 300px;
            margin: 0 auto;
        
        }

        label, input {
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h2>Edit Student Username</h2>

<form method="post">
    <label for="new_username">New Username:</label>
    <input type="text" id="new_username" name="new_username" value="<?php echo $currentUsername; ?>" required>
    <input type="submit" value="Update Username">
</form>

</body>
</html>
