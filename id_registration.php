<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('img/login.jpg');
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 700px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            background-color: #fff;
            background-color: rgba(255, 240, 230, 0.8);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .form-row {
            margin-bottom: 20px;
        }
        .form-row label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .form-row input[type="text"],
        .form-row input[type="file"] {
            width: calc(50% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        .form-row input[type="file"] {
            padding-top: 7px; /* Adjust for file input */
        }
        button {
            padding: 12px 24px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
        }
        .gender-row {
            display: flex;
            align-items: center;
        }
        .gender-options {
            display: flex;
            flex-direction: row-reverse; /* Reverses the order of the items */
        }
        .gender-options input[type="radio"] {
            margin-right: 10px; /* Adjust spacing between radio buttons */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ID _Registration</h1>
        <form id="additionalForm" action="process_details.php" method="post" enctype="multipart/form-data">

            <!-- PHP code for fetching student details -->
            <?php
            // Check if application number and date are provided
            if(isset($_GET['application_no']) && isset($_GET['date'])) {
                // Get application number and date from the URL parameters
                $applicationNo = $_GET['application_no'];
                $date = $_GET['date'];

                // Connect to your database (replace these with your actual database credentials)
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "dsports";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Prepare SQL statement to fetch student details based on application number and date
                $sql = "SELECT  c_name, c_mobile, c_email, c_selectcourse FROM c_registration WHERE c_id = '$applicationNo' AND c_date = '$date'";
                $result = $conn->query($sql);

                // Check if any row is returned
                if ($result->num_rows > 0) {
                    // Fetch row
                    $row = $result->fetch_assoc();
                    
                    $name = $row['c_name'];
                    $mobile = $row['c_mobile'];
                    $email = $row['c_email'];
                    $department = $row['c_selectcourse'];


                    // Display input fields with pre-filled values


                   
                    echo '<div class="form-row"><label for="name">Name:</label><input type="text" id="name" name="name" value="' . $name . '" readonly></div>';
                    echo '<div class="form-row"><label for="mobile">Mobile:</label><input type="text" id="mobile" name="mobile" value="' . $mobile . '" readonly></div>';
                    echo '<div class="form-row"><label for="email">Email:</label><input type="text" id="email" name="email" value="' . $email . '" readonly></div>';
                    echo '<div class="form-row"><label for="department">Department:</label><input type="text" id="department" name="department" value="' . $department . '" readonly></div>';
                } else {
                    echo "No student found with the provided application number and date.";
                }

                $conn->close();
            } else {
                echo "Application number and date are required.";
            }
            ?>
           <div class="form-row gender-row">
                <label>Gender:</label>
                <div class="gender-options">
                    <input type="radio" id="female" name="gender" value="female">
                    <label for="female">Female</label>
                    <input type="radio" id="male" name="gender" value="male">
                    <label for="male">Male</label>
                </div>
            </div>

            <div class="form-row">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" placeholder="Enter your address">
            </div>
             
            <div class="form-row">
                <label for="pincode">Pincode:</label>
                <input type="text" id="pincode" name="pincode" placeholder="Enter your pincode">
            </div>
            <div class="form-row">
                <label for="tenth_percentage">10th Mark in %:</label>
                <input type="text" id="tenth_percentage" name="tenth_percentage" placeholder="Enter your 10th grade percentage">
            </div>
            <div class="form-row">
                <label for="twelfth_percentage">12th Mark in %:</label>
                <input type="text" id="twelfth_percentage" name="twelfth_percentage" placeholder="Enter your 12th grade percentage">
            </div>
            <div class="form-row">
                <label for="degree_percentage">Degree Mark in %:</label>
                <input type="text" id="degree_percentage" name="degree_percentage" placeholder="Enter your degree percentage">
            </div>
            <div class="form-row">
                <label for="lbs_score">LBS Score:</label>
                <input type="text" id="lbs_score" name="lbs_score" placeholder="Enter your LBS score">
            </div>
            <div class="form-row">
                <label for="certificates_9">Photo:</label>
                <input type="file" id="certificates_9" name="certificates_9[]" accept=".jpg" multiple required>
            </div>
            <div class="form-row">
                <label for="certificates_8">Signature:</label>
                <input type="file" id="certificates_8" name="certificates_8[]" accept=".jpg" multiple required>
            </div>
            <div class="form-row">
                <label for="certificates_10">Upload 10th Certificate (PDF):</label>
                <input type="file" id="certificates_10" name="certificates_10[]" accept=".jpg" multiple required>
            </div>
            <div class="form-row">
                <label for="certificates_12">Upload 12th Certificate (PDF):</label>
                <input type="file" id="certificates_12" name="certificates_12[]" accept=".jpg" multiple required>
            </div>
            <div class="form-row">
                <label for="provisional_certificate">Upload Provisional Certificate (PDF):</label>
                <input type="file" id="provisional_certificate" name="provisional_certificate[]" accept=".jpg" multiple required>
            </div>
            <div class="form-row">
                <label for="certificates_degree">Upload Degree Certificate (PDF):</label>
                <input type="file" id="certificates_degree" name="certificates_degree[]" accept=".jpg" multiple required>
            </div>
            <div class="form-row">
                <label for="application_fee">Application Fee:</label>
                <input type="text" id="application_fee" name="application_fee" value="520" required readonly>
                
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
    <script>
    function validateForm() {
        var gender = document.querySelector('input[name="gender"]:checked');
        var address = document.getElementById('address').value;
        var pincode = document.getElementById('pincode').value;
        var tenth_percentage = document.getElementById('tenth_percentage').value;
        var twelfth_percentage = document.getElementById('twelfth_percentage').value;
        var degree_percentage = document.getElementById('degree_percentage').value;
        var lbs_score = document.getElementById('lbs_score').value;

        if (!gender) {
            alert("Please select your gender");
            return false;
        }
        if (address.trim() === '') {
            alert("Please enter your address");
            return false;
        }
        // You can add more validations for other fields similarly

        // If all validations pass, return true to submit the form
        return true;
    }

    // This function will be called when the page loads to populate the gender radio button
    function setGender() {
        var genderValue = "<?php echo $gender; ?>"; // Assuming $gender contains the gender value from the database
        var genderRadio = document.getElementById(genderValue);
        if (genderRadio) {
            genderRadio.checked = true;
        }
    }

    // Call the setGender function when the page loads
    window.onload = setGender;
</script>

</body>
</html>
