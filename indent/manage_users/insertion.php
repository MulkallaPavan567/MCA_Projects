<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = new mysqli('127.0.0.1', 'root', '', 'indenting');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $success = true; // Track if all insertions are successful

    // Process the uploaded CSV file
    if (isset($_FILES["csvfile"]) && $_FILES["csvfile"]["error"] == 0) {
        $file = $_FILES["csvfile"]["tmp_name"];

        // Read CSV file
        if (($handle = fopen($file, "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                $fname = $data[0];
                $username = $data[1];
                $password = $data[2];

                // Check if the user already exists in the database
                $checkSql = "SELECT * FROM create_new_user WHERE username = '$username'";
                $result = $conn->query($checkSql);

                if ($result->num_rows == 0) {
                    // User doesn't exist, insert data into the "create_new_user" table
                    $insertSql = "INSERT INTO create_new_user (fname, username, password) VALUES ('$fname', '$username', '$password')";

                    if ($conn->query($insertSql) != true) {
                        $success = false; // Set to false on the first error
                        //echo "Error: " . $insertSql . "<br>" . $conn->error;
                        break; // Exit the loop on error
                    }
                } else {
                    // User already exists, you can handle this case as needed
                    // For example, you can skip adding this user or perform an update
                    // Here, we skip adding the existing user
                    echo "User '$username' already exists in the database. Skipping.<br>";
                }
            }
            fclose($handle);
        }

        if ($success) {
            echo "<script>alert('Data added to database successfully')</script>" . "<br>";
            echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/manage_users/update.php">';
        } else {
            echo "<script>alert('Error: Unable to add all users')</script>";
            echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/manage_users/update.php">';
        }
    }

    $conn->close();
}
?>
