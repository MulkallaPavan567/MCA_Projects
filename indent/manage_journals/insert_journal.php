<?php
$journalName = $_POST['journalName'];
$journalNumber = $_POST['journalNumber'];
$publisher = $_POST['publisher'];
$year = $_POST['year'];
$field = $_POST['field'];
$cost = $_POST['cost'];

// Database connection
$conn = new mysqli('127.0.0.1', 'root', '', 'indenting');

// Check connection
if ($conn->connect_error) {
    die('Connection Failed : ' . $conn->error);
}

// Check if the journal with the same journalNumber already exists
$existingQuery = "SELECT * FROM journals WHERE journalNumber = ?";
$stmt = $conn->prepare($existingQuery);
$stmt->bind_param("s", $journalNumber);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // If the journal already exists, show an alert for the duplicate entry
    echo "<script>alert('Duplicate entry for Journal Number: $journalNumber')</script>";
?>
    <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/manage_journals/adding_journals.html">
<?php
} else {
    // If not a duplicate, insert data into the "journals" table
    $insertQuery = "INSERT INTO journals (journalName, journalNumber, publisher, year, cost, field) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sssiis", $journalName, $journalNumber, $publisher, $year, $cost, $field);

    if ($stmt->execute()) {
        echo "<script>alert('Added new journals successful')</script>";
    ?>
        <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/manage_journals/update_journals.php">
    <?php
    } else {
        echo "Error inserting record: " . $stmt->error;
    }
}

// Closing connections
$stmt->close();
$conn->close();
?>
