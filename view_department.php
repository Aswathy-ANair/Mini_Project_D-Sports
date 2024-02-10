<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Departments</title>
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
    <h2 class="center-content">Departments</h2>
    <table border="1" class="center-content">
        <tr >
            <th>Department Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php
        
        $conn = new mysqli('localhost', 'root', '','dsports');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM `c_department`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['c_dept_name']}</td>
                        <td>{$row['status']}</td>
                        <td>
                             |
                            <a href='activate_department.php?id={$row['c_dept_id']}'>Activate</a> |
                            <a href='dactivate_department.php?id={$row['c_dept_id']}'>Deactivate</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No departments found</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
