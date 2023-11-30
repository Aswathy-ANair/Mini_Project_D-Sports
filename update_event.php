<?php
include('db_connection.php');

if (isset($_GET['gevent_id'])) {
    $eventId = $_GET['gevent_id'];

    // Check if the required parameters are set
    if (isset($_POST['new_event_name']) && isset($_POST['new_event_date'])) {
        $newEventName = $_POST['new_event_name'];
        $newEventDate = $_POST['new_event_date'];

        // Perform your logic to update the event with the given ID
        $updateQuery = "UPDATE gevent SET gevent_name = '$newEventName', gdate = '$newEventDate' WHERE gevent_id = $eventId";

        if ($conn->query($updateQuery) === TRUE) {
            echo json_encode(['message' => 'Event updated successfully']);
        } else {
            echo json_encode(['message' => 'Error updating event: ' . $conn->error]);
        }
    } else {
        echo json_encode(['message' => 'Missing parameters for update']);
    }
} else {
    echo json_encode(['message' => 'Invalid request']);
}

$conn->close();
?>
