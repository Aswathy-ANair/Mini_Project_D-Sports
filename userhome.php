<?php
session_start();

if(!isset($_SESSION["username"])) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        header {
            background-color: #333;
            padding: 20px;
            color: #fff;
            text-align: center;
        }

        nav {
            overflow: hidden;
            background-color: #333;
        }

        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #5d8aa8;
        }

        main {
            float: right;
            width: 80%;
            padding: 20px;
        }

        h1 {
            color: #5d8aa8;
        }

        .dashboard-card {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        a.logout {
            display: block;
            margin-top: 20px;
            padding: 15px;
            background-color: #5d8aa8;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s;
        }

        a.logout:hover {
            background-color: #5d8aa8;
        }
    </style>
</head>

<body>

    <header>
        <h1>Admin Dashboard</h1>
    </header>

    <nav>
        
        <a href="studentview.php">Sports Events </a>
        
        <a href="view-calendar.php">Event Calendar</a>
    </nav>

    <main>
        <!-- Content goes here -->
    </main>

    <a href="logout.php" class="logout">Logout</a>

</body>

</html>

