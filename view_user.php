
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <style>
        body {
            text-align: center;
            background-color: #E5D599;
        }

        table {
            margin: 0 auto;
        }

        table th, table td {
            padding: 10px;
        }

        table th {
            background-color: #f2f2f2;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
        }

        .action-buttons a {
            margin: 0 5px;
            padding: 5px 10px;
            text-decoration: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-button {
            background-color: #ff6666;
        }

        .edit-button {
            background-color: #4CAF50;
        }

        .deactivate-button {
            background-color: #cccccc;
        }

        .activate-button {
            background-color: #cccccc;
        }
       
    </style>
</head>
<body>

<h2>Student Information</h2>

<table border="1">
    <tr>
        <th>Username</th>
        <th>Password</th>
        <th>Status</th>
        <th>Student ID</th>
        <th>Action</th>
    </tr>

    <?php
    // Replace 'your_database_host', 'your_database_username', 'your_database_password', and 'your_database_name'
    // with your actual database connection details.
    $conn = new mysqli('localhost', 'root', '', 'dsports');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM `c_student`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['c_username']}</td>
                    <td>{$row['c_password']}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['c_student_id']}</td>
                    <td class='action-buttons'>
                        
                        <a class='edit-button' href='edit_student.php?id={$row['c_student_id']}'>Edit</a>
                        <a class='deactivate-button' href='deactivate_student.php?id={$row['c_student_id']}'>Deactivate</a>
                        <a class='activate-button' href='activate_student.php?id={$row['c_student_id']}'>activate</a>
                        
                    </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No records found</td></tr>";
    }

    $conn->close();
    ?>
</table>

</body>
</html>