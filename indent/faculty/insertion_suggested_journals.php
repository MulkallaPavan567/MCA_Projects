<?php
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $conn = new mysqli('127.0.0.1:3308', 'root', '', 'indenting');

//     // Check connection
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }

//     $success = true; // Track if all insertions are successful

//     // Process the uploaded CSV file
//     if (isset($_FILES["csvfile"]) && $_FILES["csvfile"]["error"] == 0) {
//         $file = $_FILES["csvfile"]["tmp_name"];

//         // Read CSV file
//         if (($handle = fopen($file, "r")) !== false) {
//             while (($data = fgetcsv($handle, 1000, ",")) !== false) {
//                 $journalName = $data[0];
//                 $journalNumber = $data[1];
//                 $publisher = $data[2];
//                 $year = $data[3];
//                 $cost = $data[4];
//                 $field = $data[5];
//                 $quantity = $data[6];

//                 // Check if the journal already exists
//                 $existingQuery = "SELECT * FROM suggested_journals WHERE journalNumber = '$journalNumber'";
//                 $existingResult = $conn->query($existingQuery);

//                 if ($existingResult->num_rows > 0) {
//                     // If the journal exists, fetch the current quantity
//                     $existingData = $existingResult->fetch_assoc();
//                     $currentQuantity = intval($existingData['quantity']);

//                     // Update the quantity to the maximum value of the current and given quantity
//                     $newQuantity = max($currentQuantity, $quantity);

//                     // Update the existing record
//                     $updateQuery = "UPDATE suggested_journals SET quantity = $newQuantity WHERE journalNumber = '$journalNumber'";
//                     if (!$conn->query($updateQuery)) {
//                         $success = false; // Set to false on the first error
//                         echo "Error updating record: " . $conn->error;
//                         break; // Exit the loop on error
//                     }
//                 } else {
//                     // Insert data into the "suggested_journals" table
//                     $insertQuery = "INSERT INTO suggested_journals (journalName, journalNumber, publisher, year, cost, field, quantity) VALUES ('$journalName', '$journalNumber', '$publisher', '$year', '$cost', '$field', '$quantity')";
//                     if (!$conn->query($insertQuery)) {
//                         $success = false; // Set to false on the first error
//                         echo "Error inserting record: " . $conn->error;
//                         break; // Exit the loop on error
//                     }
//                 }
//             }
//             fclose($handle);
//         }

//         if ($success) {
//             echo "<script>alert('Added/Updated journals successfully')</script>";
//             ?>
//             <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/faculty/suggested_journals.php">
//             <?php
//         } else {
//             echo "<script>alert('Error: Unable to add/update all journals')</script>";
//         }
//     }

//     $conn->close();
// }
?>

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
                $quantity = $data[6];

                // Check if the journal already exists
                $existingQuery = "SELECT * FROM suggested_journals WHERE journalNumber = ?";
                $stmtExisting = $conn->prepare($existingQuery);
                $stmtExisting->bind_param('s', $journalNumber);
                $stmtExisting->execute();
                $resultExisting = $stmtExisting->get_result();
                $stmtExisting->close();

                if ($resultExisting->num_rows > 0) {
                    // If the journal exists, fetch the current quantity and num_of_faculty
                    $existingData = $resultExisting->fetch_assoc();
                    $currentQuantity = intval($existingData['quantity']);
                    $currentNumOfFaculty = intval($existingData['num_of_faculty']);

                    // Increment num_of_faculty
                    $currentNumOfFaculty++;

                    // Update the quantity to the maximum value of the current and given quantity
                    $newQuantity = max($currentQuantity, $quantity);

                    // Update the existing record with the incremented num_of_faculty and new quantity
                    $updateQuery = "UPDATE suggested_journals SET quantity = ?, num_of_faculty = ? WHERE journalNumber = ?";
                    $stmtUpdate = $conn->prepare($updateQuery);
                    $stmtUpdate->bind_param('iis', $newQuantity, $currentNumOfFaculty, $journalNumber);

                    if (!$stmtUpdate->execute()) {
                        $success = false; // Set to false on the first error
                        echo "Error updating record: " . $stmtUpdate->error;
                        break; // Exit the loop on error
                    }

                    $stmtUpdate->close();
                } else {
                    // Insert data into the "suggested_journals" table
                    $insertQuery = "INSERT INTO suggested_journals (journalName, journalNumber, publisher, year, cost, field, quantity, num_of_faculty) VALUES (?, ?, ?, ?, ?, ?, ?, 1)";
                    $stmtInsert = $conn->prepare($insertQuery);
                    $stmtInsert->bind_param('sssiisi', $journalName, $journalNumber, $publisher, $year, $cost, $field, $quantity);

                    if (!$stmtInsert->execute()) {
                        $success = false; // Set to false on the first error
                        echo "Error inserting record: " . $stmtInsert->error;
                        break; // Exit the loop on error
                    }

                    $stmtInsert->close();
                }
            }
            fclose($handle);
        }

        if ($success) {
            echo "<script>alert('Added/Updated journals successfully')</script>";
            echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/faculty/suggested_journals.php">';
        } else {
            echo "<script>alert('Error: Unable to add/update all journals')</script>";
        }
    }

    $conn->close();
}
?>
