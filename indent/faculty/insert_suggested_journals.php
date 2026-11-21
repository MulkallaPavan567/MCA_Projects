<?php
// $journalName = $_POST['journalName'];
// $journalNumber = $_POST['journalNumber'];
// $publisher = $_POST['publisher'];
// $year = $_POST['year'];
// $cost = $_POST['cost'];
// $field = $_POST['field'];
// $quantity = $_POST['quantity'];

// // Database connection
// $conn = new mysqli('127.0.0.1:3308', 'root', '', 'indenting');

// // Check connection
// if ($conn->connect_error) {
//     die('Connection Failed: ' . $conn->error);
// }

// // Check if the journal already exists
// $existingQuery = "SELECT * FROM suggested_journals WHERE journalNumber = ?";
// $stmtExisting = $conn->prepare($existingQuery);
// $stmtExisting->bind_param('s', $journalNumber);
// $stmtExisting->execute();
// $resultExisting = $stmtExisting->get_result();
// $stmtExisting->close();

// if ($resultExisting->num_rows > 0) {
//     // If the journal exists, fetch the current quantity
//     $existingData = $resultExisting->fetch_assoc();
//     $currentQuantity = intval($existingData['quantity']);

//     // Update the quantity to the maximum value of the current and given quantity
//     $newQuantity = max($currentQuantity, $quantity);

//     // Update the existing record
//     $updateQuery = "UPDATE suggested_journals SET quantity = ? WHERE journalNumber = ?";
//     $stmtUpdate = $conn->prepare($updateQuery);
//     $stmtUpdate->bind_param('is', $newQuantity, $journalNumber);

//     if ($stmtUpdate->execute()) {
//         echo "<script>alert('Updated quantity for existing journal')</script>";
//         echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/faculty/suggested_journals.php">';
//     } else {
//         echo "Error updating record: " . $stmtUpdate->error;
//     }

//     $stmtUpdate->close();
// } else {
//     // Insert data into the "suggested_journals" table
//     $insertQuery = "INSERT INTO suggested_journals (journalName, journalNumber, publisher, year, cost, field, quantity) VALUES (?, ?, ?, ?, ?, ?, ?)";
//     $stmtInsert = $conn->prepare($insertQuery);
//     $stmtInsert->bind_param('sssiisi', $journalName, $journalNumber, $publisher, $year, $cost, $field, $quantity);

//     if ($stmtInsert->execute()) {
//         echo "<script>alert('Added new journal successfully')</script>";
//     ?>
//         <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/faculty/suggested_journals.php">
//     <?php
//     } else {
//         echo "Error inserting record: " . $stmtInsert->error;
//     }

//     $stmtInsert->close();
// }

// $conn->close();
?>

<?php
$journalName = $_POST['journalName'];
$journalNumber = $_POST['journalNumber'];
$publisher = $_POST['publisher'];
$year = $_POST['year'];
$cost = $_POST['cost'];
$field = $_POST['field'];
$quantity = $_POST['quantity'];

// Database connection
$conn = new mysqli('127.0.0.1', 'root', '', 'indenting');

// Check connection
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->error);
}

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

    if ($stmtUpdate->execute()) {
        echo "<script>alert('Updated quantity and num_of_faculty for existing journal')</script>";
        echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/faculty/suggested_journals.php">';
    } else {
        echo "Error updating record: " . $stmtUpdate->error;
    }

    $stmtUpdate->close();
} else {
    // Insert data into the "suggested_journals" table
    $insertQuery = "INSERT INTO suggested_journals (journalName, journalNumber, publisher, year, cost, field, quantity, num_of_faculty) VALUES (?, ?, ?, ?, ?, ?, ?, 1)";
    $stmtInsert = $conn->prepare($insertQuery);
    $stmtInsert->bind_param('sssiisi', $journalName, $journalNumber, $publisher, $year, $cost, $field, $quantity);

    if ($stmtInsert->execute()) {
        echo "<script>alert('Added new journal successfully')</script>";
        echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/faculty/suggested_journals.php">';
    } else {
        echo "Error inserting record: " . $stmtInsert->error;
    }

    $stmtInsert->close();
}

$conn->close();
?>
