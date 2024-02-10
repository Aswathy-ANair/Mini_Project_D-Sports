<?php
include('db_connection.php');

$conn = new mysqli('localhost', 'root', '', 'dsports');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $studentId = $_GET['id'];

    // activate student in c_student table
    $activateStudentSQL = "UPDATE `c_student` SET `status` = 'active' WHERE `c_student_id` = $studentId";
    if ($conn->query($activateStudentSQL) === TRUE) {
        // Fetch the username associated with the student ID
        $usernameQuery = "SELECT c_username FROM `c_student` WHERE `c_student_id` = $studentId";
        $usernameResult = $conn->query($usernameQuery);

        if ($usernameResult->num_rows > 0) {
            $row = $usernameResult->fetch_assoc();
            $username = $row['c_username'];

            // Deactivate corresponding login entry in c_login table using the correct username
            $activateLoginSQL = "UPDATE `c_login` SET `status` = 'active' WHERE `c_username` = '$username'";
            $conn->query($activateLoginSQL);

            // Display JavaScript confirmation and redirect
            echo '<script>
                    if(confirm("Student activated successfully.")) {
                        window.location.href = "admin_viewuser.php";
                    } else {
                        window.location.href = "admin_viewuser.php";
                    }
                </script>';
        } else {
            echo "Error fetching username: " . $conn->error;
        }
    } else {
        echo "Error activating student: " . $conn->error;
    }
} else {
    echo "Invalid student ID.";
}

$conn->close();
?>
