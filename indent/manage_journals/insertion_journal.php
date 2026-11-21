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
                $journalName = $data[0];
                $journalNumber = $data[1];
                $publisher = $data[2];
                $year = $data[3];
                $cost = $data[4];
                $field = $data[5];
                
                // Check if the journal with the same journalNumber already exists
                $existingQuery = "SELECT * FROM journals WHERE journalNumber = '$journalNumber'";
                $existingResult = $conn->query($existingQuery);

                if ($existingResult->num_rows > 0) {
                    // If the journal already exists, set success to false and show an alert
                    $success = false;
                    echo "<script>alert('Journal with $journalNumber already exists. Skipping')</script>";
                    break; // Exit the loop on duplicate entry
                }

                // Insert data into the "journals" table
                $sql = "INSERT INTO journals (journalName, journalNumber, publisher, year, cost, field) VALUES ('$journalName', '$journalNumber', '$publisher', '$year', '$cost', '$field')";
                
                if ($conn->query($sql) !== true) {
                    $success = false; // Set to false on the first error
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    break; // Exit the loop on error
                }
            }
            fclose($handle);
        }

        if ($success) {
            echo "<script>alert('Added new journals successfully')</script>";
            echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/manage_journals/update_journals.php">';
        } else {
            echo "<script>alert('Added all journals except duplicate entries')</script>";
            echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/manage_journals/update_journals.php">';
        }   
    }
    
    $conn->close();
}
?>
