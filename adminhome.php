<?php
session_start();

if (!isset($_SESSION["username"])) {
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
            background-color: #add8e6;
            padding: 20px;
            color: #5d8aa8;
            text-align: center;
        }

        nav {
            float: left;
            width: 20%;
            background-color: #5d8aa8;
            padding: 15px;
            height: 100vh;
        }

        nav a {
            color: #add8e6;
            text-decoration: none;
            display: block;
            padding: 15px;
            margin-bottom: 10px;
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
            color: #add8e6;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s;
        }

        a.logout:hover {
            background-color: #5d8aa8;
        }

        /* Style the navigation bar */
nav {
    background-color: #333;
    overflow: hidden;
}

nav a {
    float: left;
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

nav a:hover {
    background-color: #5d8aa8;
    color: blue;
}

/* Style the dropdown button and content */
/* Style the navigation bar */
nav {
    background-color: #5d8aa8;
    overflow: hidden;
}

nav a {
    float: left;
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

nav a:hover {
    background-color: #ddd;
    color: black;
}

/* Style the dropdown button and content */
.dropdown {
    float: left;
    overflow: hidden;
}

.dropbtn {
    font-size: 16px;
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.dropdown-content a {
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.dropdown:hover .dropdown-content {
    display: block;
}

    </style>
</head>

<body>

    <header>
        <h1>Admin Dashboard</h1>
        <?php echo $_SESSION["username"] ?>
    </header>

    <nav>
        <a href="#">Dashboard</a>
		
        <a href="registration.php">Manage Users</a>
        <a href="event.php">Event Add</a>
        <a href="view-calendar.php">Event Calendar</a>

        <div class="dropdown">
        <button class="dropbtn">Students</button>
        <div class="dropdown-content">
            <a href="girlevent.php">Student-G</a>
            <a href="#">Student-B</a>
        </div>
    </div>
        
    </nav>

    <main>
        <div class="dashboard-card">
            <h2>Statistics</h2>
            <!-- Add your dashboard statistics content here -->
        </div>

        <div class="dashboard-card">
            <h2>Recent Activities</h2>
            <!-- Add your recent activities content here -->
        </div>
    </main>

    <a class="logout" href="logout.php">Logout</a>

</body>

</html>
