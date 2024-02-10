<?php
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $house_id = $_GET['id'];

    // Update department status to 'inactive' in c_department table
    $sql = "UPDATE `c_house` SET `status` = 'Active' WHERE `c_house_id` = $house_id";

    if ($conn->query($sql) === TRUE) {
        // JavaScript alert for successful deactivation
        echo '<script>alert("Department activated successfully.");</script>';
        // Redirect back to the view_departments.php page after deactivation
        echo '<script>window.location.href = "admin_view_house.php";</script>';
        exit();
    } else {
        echo "Error deactivating department: " . $conn->error;
    }
} else {
    // If department ID is not provided in the URL or request method is not GET, show error
    echo "Invalid department ID or request method.";
}
?>
