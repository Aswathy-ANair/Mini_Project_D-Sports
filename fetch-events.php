<?php
include('db_connection.php');

$fetch_event = mysqli_query($conn, "select * from event");

$events = array();

while ($result = mysqli_fetch_array($fetch_event)) {
    $events[] = array(
        'title' => $result['title'],
        'start_date' => $result['start_date'],
        'end_date' => $result['end_date']
    );
}

echo json_encode($events);
?>
