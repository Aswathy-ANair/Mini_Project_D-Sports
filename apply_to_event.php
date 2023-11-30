<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['gevent_id'])) {
    $eventId = $_GET['gevent_id'];

    // Perform your logic to apply the student to the event with the given ID
    // You can insert a new record into the `student_event_applications` table

    echo json_encode(['message' => 'Application submitted successfully']);
} else {
    echo json_encode(['message' => 'Invalid request']);
}

$conn->close();
?>
