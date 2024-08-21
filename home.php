<?php
// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    include('db_connection.php');

    // Retrieve the email and password from the login form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform any necessary validation (e.g., check for empty fields)

    // Example of simple validation (not recommended for production):
    if (empty($email) || empty($password)) {
        // Handle empty fields
        echo "Please enter email and password";
    } else {
        // Assuming you have a users table in your database
        // Perform a database query to check if the email and password match a record in the database
        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($connection, $query);

        // Check if the query was successful
        if ($result) {
            // Check if a matching user was found
            if (mysqli_num_rows($result) == 1) {
                // Start a session and store the email as a session variable
                $_SESSION['email'] = $email;

                // Redirect the user to the home page or another page
                header("Location: home.php");
                exit;
            } else {
                // Handle incorrect email or password
                echo "Incorrect email or password";
            }
        } else {
            // Handle database query error
            echo "Error: " . mysqli_error($connection);
        }
    }
}
?>
