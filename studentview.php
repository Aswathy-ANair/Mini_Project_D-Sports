<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        /* Add your styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #5d8aa8;
            color: white;
            padding: 10px;
            text-align: center;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        div {
            margin-bottom: 20px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons button {
            padding: 8px;
            cursor: pointer;
        }

        .action-buttons button.apply {
            background-color: #28a745;
            color: white;
            border: none;
        }
    </style>
</head>

<body>

<header>
        
        <h1>Girl Students' Sports Events</h1>
    </header>

    <main>
        <?php
        // Include database connection
        include('db_connection.php');

        // Query to get all events
        $eventsQuery = "SELECT * FROM gevent WHERE disabled = 0"; // Show only enabled events
        $eventsResult = $conn->query($eventsQuery);

        // Check for query execution errors
        if (!$eventsResult) {
            echo '<div style="color: red;">Error executing query: ' . $conn->error . '</div>';
        } else {
            // Check if there are any events
            if ($eventsResult->num_rows > 0) {
                // Display events in a table
                echo '<table>';
                echo '<tr>';
                echo '<th>Event Name</th>';
                echo '<th>Date</th>';
                echo '<th>Actions</th>';
                echo '</tr>';

                // Fetch and display events
                while ($row = $eventsResult->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['gevent_name'] . '</td>';
                    echo '<td>' . $row['gdate'] . '</td>';
                    echo '<td class="action-buttons">';
                    echo '<button class="apply" onclick="applyToEvent(' . $row['gevent_id'] . ')">Apply</button>';
                    echo '</td>'; // Close the action-buttons column
                    echo '</tr>';
                }
                echo '</table>'; // Close the table
            } else {
                echo '<div>No events available.</div>';
            }
        }

        // Close the database connection
        $conn->close();
        ?>
    </main>

    <script>
        function applyToEvent(eventId) {
            console.log('Applying to event with ID ' + eventId);

            // Replace with the actual URL and method for applying
            fetch('apply_to_event.php?gevent_id=' + eventId, {
                method: 'POST',
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data.message); // Log the server response
                    // Optionally, update the UI if needed
                })
                .catch(error => console.error('Error:', error));
        }
    </script>

</body>

</html>
