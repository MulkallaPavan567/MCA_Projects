<?php
require_once 'config/db1.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['approved_journals'])) {
    $suggestedJournals = json_decode($_POST['approved_journals'], true);

    if (is_array($suggestedJournals) && !empty($suggestedJournals)) {
        $insertedCount = 0;

        foreach ($suggestedJournals as $journalData) {
            $journalName = mysqli_real_escape_string($con, $journalData['journalName']);
            $journalNumber = mysqli_real_escape_string($con, $journalData['journalNumber']);
            $publisher = mysqli_real_escape_string($con, $journalData['publisher']);
            $year = mysqli_real_escape_string($con, $journalData['year']);
            $cost = mysqli_real_escape_string($con, $journalData['cost']);
            $field = mysqli_real_escape_string($con, $journalData['field']);
            $quantity = isset($journalData['quantity']) ? intval($journalData['quantity']) : 0;
           // $num_of_faculty = mysqli_real_escape_string($con, $journalData['num_of_faculty']);

            // Check if the journal already exists in the 'suggested_journals' table
            $existingQuery = "SELECT * FROM approved_journals WHERE journalNumber = '$journalNumber'";
            $existingResult = mysqli_query($con, $existingQuery);

            if (mysqli_num_rows($existingResult) > 0) {
                // If the journal exists, update the quantity
                $updateQuery = "UPDATE approved_journals SET quantity = quantity + $quantity WHERE journalNumber = '$journalNumber'";
                $result = mysqli_query($con, $updateQuery);
            } else {
                // If the journal doesn't exist, insert a new record
                $insertQuery = "INSERT INTO approved_journals (journalName, journalNumber, publisher, year, cost, field, quantity) 
                                VALUES ('$journalName', '$journalNumber', '$publisher', '$year', '$cost', '$field', '$quantity')";
                $result = mysqli_query($con, $insertQuery);
            }

            if ($result) {
                $insertedCount++;
            } else {
                // Handle insertion errors
                echo "Error inserting journal: " . mysqli_error($con);
            }
        }

        if ($insertedCount > 0) {
            echo "Successfully approved $insertedCount journal(s).";
            
                // header("Location: http://localhost/indent/approve/approved_journals_list.php");
                // exit(); // Ensure that no further code is executed after redirection
            } else {
                echo "No journals were suggested.";
            }
        } else {
            echo "Invalid request. Please submit the form data.";
        }
    }

mysqli_close($con);
?>
