<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('img/login.jpg');
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            margin-top: 0;
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>View Details</h2>
        <form action="view_registeredstudents.php" method="GET">
            <label for="cid">Application Number :</label>
            <input type="text" id="cid" name="cid" placeholder="Enter application no" required><br><br>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter Name" required><br><br>
            <button type="submit">View Details</button>
        </form>
    </div>

    <script>
        // Add focus effect to input fields
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.style.border = '1px solid #4caf50';
            });
            input.addEventListener('blur', () => {
                input.style.border = '1px solid #ccc';
            });
        });
    </script>
</body>
</html>
