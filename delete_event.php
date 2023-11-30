<?php
include('db_connection.php');

if (isset($_GET['gevent_id'])) {
    $eventId = $_GET['gevent_id'];

    // Perform your logic to delete the event with the given ID
    $deleteQuery = "DELETE FROM gevent WHERE gevent_id = $eventId";

    if ($conn->query($deleteQuery) === TRUE) {
        echo json_encode(['message' => 'Event deleted successfully']);
    } else {
        echo json_encode(['message' => 'Error deleting event: ' . $conn->error]);
    }
} else {
    echo json_encode(['message' => 'Invalid request']);
}

$conn->close();
?>
