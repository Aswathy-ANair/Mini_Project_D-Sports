<?php
// Include database connection
include('db_connection.php');

// Initialize variables
$successMessage = '';
$errorMessages = array();

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = mysqli_real_escape_string($conn, $_POST['action']);

    if ($action == 'add') {
        $gevent_name = mysqli_real_escape_string($conn, $_POST['gevent_name']);
        $gdate = mysqli_real_escape_string($conn, $_POST['gdate']);

        // Insert data into the 'girlevents' table
        $sql = "INSERT INTO gevent (gdate, gevent_name) VALUES ('$gdate', '$gevent_name')";

        if ($conn->query($sql) === TRUE) {
            $successMessage = "Event added successfully!";
        } else {
            $errorMessages[] = "Error adding event: " . $conn->error;
        }
    } elseif ($action == 'update') {
        // Add code to update event details
    } elseif ($action == 'disable') {
        // Add code to disable event
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add your styles and scripts here -->
</head>

<body>

    <header>
        <a href="adminhome.php" id="home-link">Admin Home</a>
        <h1>Girl Students' Sports Events</h1>
    </header>

    <main>
        <section>
            <h2>Add Event</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="action" value="add">
                <label for="gevent_name">Event Name:</label>
                <input type="text" id="gevent_name" name="gevent_name" required>

                <label for="gdate">Event Date:</label>
                <input type="datetime-local" id="gdate" name="gdate" required>

                <button type="submit">Add Event</button>
            </form>
        </section>

        <section>
            <h2>Update/Disable Event</h2>
            <!-- Add a form for updating/disabling events -->
            <!-- Include fields such as event selection, new details, etc. -->
        </section>

        <section>
            <h2>View Events</h2>
            <!-- Redirect to a separate page for viewing events -->
            <a href="view_events.php">View Events</a>
        </section>
    </main>

</body>

</html>
