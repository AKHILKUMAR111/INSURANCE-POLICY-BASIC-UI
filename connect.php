<?php
if (isset($_POST['fullName'])) {
    // Database connection parameters
    $server = "localhost";
    $username = "root";
    $password = ""; // Replace with your actual database password
    $database = "insurance"; // Replace with your actual database name

    // Establishing a connection to the database
    $con = mysqli_connect($server, $username, $password, $database);

    // Check for successful connection
    if (!$con) {
        die("Connection to this database failed due to " . mysqli_connect_error());
    }

    // Escaping and retrieving form data
    $fullName = mysqli_real_escape_string($con, $_POST['fullName']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $coverageAmount = mysqli_real_escape_string($con, $_POST['coverageAmount']);
    $termLength = mysqli_real_escape_string($con, $_POST['termLength']);
    $contactNumber = mysqli_real_escape_string($con, $_POST['contactNumber']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $address = mysqli_real_escape_string($con, $_POST['address']);

    // SQL query to insert data into the 'policy' table
    $sql = "INSERT INTO `policy`(`fullname`, `age`, `gender`, `amount`, `termlength`, `contact`, `email`, `address`, `dt`) 
            VALUES ('$fullName', '$age', '$gender', '$coverageAmount', '$termLength', '$contactNumber', '$email', '$address', current_timestamp());";

    // Executing the SQL query
    if ($con->query($sql) == true) {
        $insert = true;
    } else {
        echo "ERROR: $sql <br> $con->error";
    }

    // Closing the database connection
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>

<img src="image/thanks.jpg" alt="" class="thanks">
<div>

    <a href="index.html">
        <button class="btn tk">Go to Home Page</button>
    </a>
</div>

</body>
</html>

