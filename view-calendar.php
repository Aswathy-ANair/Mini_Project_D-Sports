<?php
include('db_connection.php');
$fetch_event = mysqli_query($conn, "SELECT * FROM event");
?>

<html>
<head>
    <title>Event Calendar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script> 
</head>
<body>
<header>
    <a href="adminhome.php" id="home-link">Admin Home</a>
        
    </header>
    <h2><center>Javascript Fullcalendar</center></h2>
    <div class="container">
        <div id="calendar"></div>
    </div>
    <br>

    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                events: [
                    <?php
                    while ($result = mysqli_fetch_array($fetch_event)) {
                        echo '{';
                        echo 'title: "' . $result['title'] . ' - ' . $result['student'] . '",';
                        echo 'start: "' . $result['start_date'] . '",';
                        echo 'end: "' . $result['end_date'] . '",';

                        // Specify colors based on the student
                        if ($result['student'] == 'boy') {
                            echo 'color: "blue",';
                        } elseif ($result['student'] == 'girl') {
                            echo 'color: "pink",';
                        }

                        echo 'textColor: "black"';
                        echo '},';
                    }
                    ?>
                ]
            });
        });
    </script>
</body>
</html>
