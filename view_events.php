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
            background-color: #333;
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

        .action-buttons button.delete {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .action-buttons button.disable {
            background-color: #6c757d;
            color: white;
            border: none;
        }

        .action-buttons button.update {
            background-color: #17a2b8;
            color: white;
            border: none;
        }
    </style>
</head>

<body>

    <header>
        <h1>Events List</h1>
    </header>
    <section>
            <h2>View Events</h2>
            <!-- Redirect to a separate page for viewing events -->
            <a href="girlevent.php">View Events</a>
        </section>

    <main>
        <?php
        // Include database connection
        include('db_connection.php');

        // Query to get all events
        $eventsQuery = "SELECT * FROM gevent";
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
                    echo '<button class="delete" onclick="deleteEvent(' . $row['gevent_id'] . ')">Delete</button>';
                    echo '<button class="disable" onclick="disableEvent(' . $row['gevent_id'] . ')">Disable</button>';
                    echo '<button class="update" onclick="updateEvent(' . $row['gevent_id'] . ')">Update</button>';
                    echo '</td>'; // Close the action-buttons column
                    echo '</tr>';
                }
                echo '</table>'; // Close the table
            } else {
                echo '<div>No events found.</div>';
            }
        }

        // Close the database connection
        $conn->close();
        ?>
    </main>

    <script>
    function deleteEvent(eventId) {
        console.log('Deleting event with ID ' + eventId);

        // Replace with the actual URL and method for delete
        fetch('delete_event.php?gevent_id=' + eventId, {
            method: 'DELETE',
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

    function disableEvent(eventId) {
    console.log('Disabling event with ID ' + eventId);

    // Replace with the actual URL and method for disable
    fetch('disable_event.php?gevent_id=' + eventId, {
        method: 'PUT',
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Response:', data); // Log the entire response for detailed information
            if (data.success) {
                console.log('Effect:', data.effect); // Log the effect
                // Implement UI changes based on the effect (e.g., dimming)
                if (data.effect === 'dim') {
                    // Add your dimming logic here
                    // For example, you can change the background color of the row
                    const row = document.querySelector(`[data-id="${eventId}"]`);
                    if (row) {
                        row.style.backgroundColor = '#f2f2f2';
                    }
                }
            } else {
                console.error('Error:', data.message);
                // Handle the error, if needed
            }
        })
        .catch(error => console.error('Error:', error));
}


    function updateEvent(eventId) {
        console.log('Updating event with ID ' + eventId);

        // Replace with the actual URL and method for update
        fetch('update_event.php?gevent_id=' + eventId, {
            method: 'PUT',
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