<?php
if (isset($_POST['fullName']) && isset($_POST['phoneNumber'])) {
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

    // Sanitize input data
    $fullName = mysqli_real_escape_string($con, $_POST['fullName']);
    $phoneNumber = mysqli_real_escape_string($con, $_POST['phoneNumber']);

    // Perform a SELECT query based on user input
    $result = $con->query("SELECT * FROM `policy` WHERE `fullname` = '$fullName' AND `contact` = '$phoneNumber'");

    // Display the results
    if ($result) {
        $row = $result->fetch_assoc();
        if ($row) {
            echo "Full Name: " . $row['fullname'] . "<br>";
            echo "AGE: " . $row['age'] . "<br>";
            echo "Gender: " . $row['gender'] . "<br>";
            echo "Coverage Amount: " . $row['amount'] . "<br>";
            echo "Term Length: " . $row['termLength'] . "<br>";
            echo "Contact Number: " . $row['contact'] . "<br>";
            echo "Email: " . $row['email'] . "<br>";
            echo "Address: " . $row['address'] . "<br>";
            echo "Timestamp: " . $row['dt'] . "<br>";

            // Perform an operation on user data (e.g., calculate total coverage)
            $totalCoverage = $row['amount'] * $row['termLength'];
            echo "Total Coverage: " . $totalCoverage . "<br>";

            // Add a Confirm button that redirects to a new form
            echo '<form action="index.html" method="post">';
            echo '<input type="hidden" name="fullName" value="' . htmlspecialchars($row['fullname']) . '">';
            echo '<input type="hidden" name="phoneNumber" value="' . htmlspecialchars($row['contact']) . '">';
            echo '<button type="submit">Confirm</button>';
            echo '</form>';
        } else {
            echo "No records found for the user with Name: $fullName and Phone Number: $phoneNumber";
        }
    } else {
        echo "Error: " . $con->error;
    }

    // Closing the database connection
    $con->close();
}
?>


