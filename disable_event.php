<?php
include('db_connection.php');

if (isset($_GET['gevent_id'])) {
    $eventId = $_GET['gevent_id'];

    // Perform your logic to disable the event with the given ID
    $disableQuery = "UPDATE gevent SET disabled = 1 WHERE gevent_id = $eventId";

    if ($conn->query($disableQuery) === TRUE) {
        $response = [
            'message' => 'Event disabled successfully',
            'success' => true,
            'effect' => 'dim' // Add the effect information here
        ];
    } else {
        $response = [
            'message' => 'Error disabling event: ' . $conn->error,
            'success' => false,
            'effect' => 'none' // Specify no effect in case of an error
        ];
    }
} else {
    $response = [
        'message' => 'Invalid request',
        'success' => false,
        'effect' => 'none' // Specify no effect for an invalid request
    ];
}

echo json_encode($response);

$conn->close();
?>
