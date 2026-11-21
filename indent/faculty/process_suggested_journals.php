<?php

// require_once 'config/db1.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['suggested_journals'])) {
//     $suggestedJournals = json_decode($_POST['suggested_journals'], true);

//     if (is_array($suggestedJournals) && !empty($suggestedJournals)) {
//         $insertedCount = 0;

//         foreach ($suggestedJournals as $journalData) {
//             $journalName = mysqli_real_escape_string($con, $journalData['journalName']);
//             $journalNumber = mysqli_real_escape_string($con, $journalData['journalNumber']);
//             $publisher = mysqli_real_escape_string($con, $journalData['publisher']);
//             $year = mysqli_real_escape_string($con, $journalData['year']);
//             $cost = mysqli_real_escape_string($con, $journalData['cost']);
//             $field = mysqli_real_escape_string($con, $journalData['field']);
//             $quantity = isset($journalData['quantity']) ? intval($journalData['quantity']) : 0;

//             // Get faculty_id from the session or any other source
//             // For now, using a placeholder
//             $facultyId = 1; // Replace with the actual faculty_id

//             // Check if the book already exists in the 'suggested_books' table
//             $existingQuery = "SELECT * FROM suggested_journals WHERE journalNumber = '$journalNumber'";
//             $existingResult = mysqli_query($con, $existingQuery);

//             if (mysqli_num_rows($existingResult) > 0) {
//                 // If the book exists, update the quantity
//                 $existingData = mysqli_fetch_assoc($existingResult);

//                 // Check if the 'faculty_id' key exists in the associative array
//                 if (isset($existingData['faculty_id'])) {
//                     $currentFacultyId = intval($existingData['faculty_id']);
//                 } else {
//                     // If 'faculty_id' key is not present, handle the error or set a default value
//                     // For example, setting a default value of 0
//                     $currentFacultyId = 1;
//                 }

//                 $currentQuantity = intval($existingData['quantity']);
//                 $currentNumOfFaculty = intval($existingData['num_of_faculty']);
        
//                 if ($currentFacultyId !== $facultyId) {
//                     // Different faculty suggesting the same book, increment num_of_faculty
//                     $currentNumOfFaculty++;

//                 // Update the quantity to the maximum value of the current and given quantity
//                 $newQuantity = max($currentQuantity, $quantity);
        
//                 $updateQuery = "UPDATE suggested_journals SET quantity = $newQuantity WHERE journalNumber = '$journalNumber'";
//                 $result = mysqli_query($con, $updateQuery);
//                 } else {
//                     // Same faculty suggesting the same book again, no need to update num_of_faculty
//                     // Update the quantity to the maximum value of the current and given quantity
//                     $newQuantity = max($currentQuantity, $quantity);

//                     // Update the existing record with the new quantity
//                     $updateQuery = "UPDATE suggested_journals SET quantity = $newQuantity WHERE journalNumber = '$journalNumber'";
//                     $result = mysqli_query($con, $updateQuery);
//                 }
//             }else {
//                     // If the book doesn't exist, insert a new record
//                     $insertQuery = "INSERT INTO suggested_journals (journalName, journalNumber, publisher, year, cost, field, quantity, num_of_faculty) 
//                                     VALUES ('$journalName', '$journalNumber', '$publisher', '$year', '$cost', '$field', '$quantity', 1)";
//                     $result = mysqli_query($con, $insertQuery);
//                 }

//             if ($result) {
//                 $insertedCount++;
//             } else {
//                 // Handle insertion/update errors
//                 echo "Error updating/inserting book: " . mysqli_error($con);
//             }
//         }

//         if ($insertedCount > 0) {
//             echo "Successfully suggested/updated $insertedCount journal(s).";
//             // Redirect to select_journal.php after a brief delay (0 seconds)
//             //echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/faculty/select_journal.php">';
//         } else {
//             echo "No books were suggested/updated.";
//         }
//     } else {
//         echo "No valid journals selected for suggestion.";
//     }
// } else {
//     echo "Invalid request. Please submit the form data.";
// }

// mysqli_close($con);
?>

<?php

require_once 'config/db1.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['suggested_journals'])) {
    $suggestedJournals = json_decode($_POST['suggested_journals'], true);

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

            // Get faculty_id from the session or any other source
            // For now, using a placeholder
            $facultyId = 1; // Replace with the actual faculty_id

            // Check if the journal already exists in the 'suggested_journals' table
            $existingQuery = "SELECT * FROM suggested_journals WHERE journalNumber = '$journalNumber'";
            $existingResult = mysqli_query($con, $existingQuery);

            if (mysqli_num_rows($existingResult) > 0) {
                // If the journal exists, fetch the current quantity and num_of_faculty
                $existingData = mysqli_fetch_assoc($existingResult);

                // Check if the 'num_of_faculty' key exists in the associative array
                if (isset($existingData['num_of_faculty'])) {
                    $currentNumOfFaculty = intval($existingData['num_of_faculty']);
                } else {
                    // If 'num_of_faculty' key is not present, handle the error or set a default value
                    // For example, setting a default value of 0
                    $currentNumOfFaculty = 1;
                }

                // Increment num_of_faculty
                $currentNumOfFaculty++;

                // Update the quantity to the maximum value of the current and given quantity
                $newQuantity = max($existingData['quantity'], $quantity);

                // Update the existing record with the incremented num_of_faculty and new quantity
                $updateQuery = "UPDATE suggested_journals SET quantity = $newQuantity, num_of_faculty = $currentNumOfFaculty WHERE journalNumber = '$journalNumber'";
                $result = mysqli_query($con, $updateQuery);
            } else {
                // If the journal doesn't exist, insert a new record
                $insertQuery = "INSERT INTO suggested_journals (journalName, journalNumber, publisher, year, cost, field, quantity, num_of_faculty) 
                                VALUES ('$journalName', '$journalNumber', '$publisher', '$year', '$cost', '$field', '$quantity', 1)";
                $result = mysqli_query($con, $insertQuery);
            }

            if ($result) {
                $insertedCount++;
            } else {
                // Handle insertion/update errors
                echo "Error updating/inserting journal: " . mysqli_error($con);
            }
        }

        if ($insertedCount > 0) {
            echo "Successfully suggested/updated $insertedCount journal(s).";
            // Redirect to select_journal.php after a brief delay (0 seconds)
            //echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/faculty/select_journal.php">';
        } else {
            echo "No journals were suggested/updated.";
        }
    } else {
        echo "No valid journals selected for suggestion.";
    }
} else {
    echo "Invalid request. Please submit the form data.";
}

mysqli_close($con);
?>
