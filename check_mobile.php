<?php
// Check if mobile number exists
if(isset($_POST['mobile'])) {
    // Establish connection to your database
    $conn = mysqli_connect("localhost", "root", "", "dsports");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Sanitize and validate the mobile number
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    
    // Prepare SQL statement
    $sql = "SELECT * FROM c_registration WHERE c_mobile = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $mobile);
    $stmt->execute();
    
    // Get result
    $result = $stmt->get_result();
    
    // Check if mobile number exists
    if ($result->num_rows > 0) {
        echo "exists";
    } else {
        echo "not_exists";
    }

    // Close statement and connection
    $stmt->close();
    mysqli_close($conn);
} else {
    echo "invalid_request"; // If 'mobile' parameter is not set
}
?>
