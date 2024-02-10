<?php
include('db_connection.php');

$conn = new mysqli('localhost', 'root', '', 'dsports');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $teacherId = $_GET['id'];

    // Deactivate student in c_student table
    $deactivateTeacherSQL = "UPDATE `c_teacher` SET `status` = 'inactive' WHERE `c_teacher_id` = $teacherId";
    if ($conn->query($deactivateTeacherSQL) === TRUE) {
        // Fetch the username associated with the student ID
        $usernameQuery = "SELECT c_username FROM `c_teacher` WHERE `c_teacher_id` = $teacherId";
        $usernameResult = $conn->query($usernameQuery);

        if ($usernameResult->num_rows > 0) {
            $row = $usernameResult->fetch_assoc();
            $username = $row['c_username'];

            // Deactivate corresponding login entry in c_login table using the correct username
            $deactivateLoginSQL = "UPDATE `c_login` SET `status` = 'inactive' WHERE `c_username` = '$username'";
            $conn->query($deactivateLoginSQL);

            // Display JavaScript confirmation and redirect
            echo '<script>
                    if(confirm("Student deactivated successfully.")) {
                        window.location.href = "admin_viewteacher.php";
                    } else {
                        window.location.href = "admin_viewteacher.php";
                    }
                </script>';
        } else {
            echo "Error fetching username: " . $conn->error;
        }
    } else {
        echo "Error deactivating student: " . $conn->error;
    }
} else {
    echo "Invalid student ID.";
}

$conn->close();
?>
