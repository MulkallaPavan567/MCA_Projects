<?php
//    $book_name = $_POST['book_name'];
//    $author = $_POST['author'];
//    $edition = $_POST['edition'];
//    $isbn = $_POST['isbn'];
//    $publisher = $_POST['publisher'];
//    $year = $_POST['year'];
//    $cost = $_POST['cost'];
//    $field = $_POST['field'];
//    $quantity = $_POST['quantity'];

//    // Database connection
//    $conn = new mysqli('127.0.0.1:3308', 'root', '', 'indenting');

//    // Check if the book already exists
//    $existingQuery = "SELECT * FROM suggested_books WHERE isbn = ?";
//    $stmtExisting = $conn->prepare($existingQuery);
//    $stmtExisting->bind_param("s", $isbn);
//    $stmtExisting->execute();
//    $resultExisting = $stmtExisting->get_result();
//    $stmtExisting->close();

//    if ($resultExisting->num_rows > 0) {
//        // If the book exists, fetch the current quantity
//        $existingData = $resultExisting->fetch_assoc();
//        $currentQuantity = intval($existingData['quantity']);

//        // Update the quantity to the maximum value of the current and given quantity
//        $newQuantity = max($currentQuantity, $quantity);

//        // Update the existing record
//        $updateQuery = "UPDATE suggested_books SET quantity = ? WHERE isbn = ?";
//        $stmtUpdate = $conn->prepare($updateQuery);
//        $stmtUpdate->bind_param("is", $newQuantity, $isbn);

//        if ($stmtUpdate->execute()) {
//            echo "<script>alert('Updated quantity for existing book')</script>";
//            echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/faculty/suggested_books.php">';
//         } else {
//            echo "Error updating record: " . $stmtUpdate->error;
//        }

//        $stmtUpdate->close();
//    } else {
//        // If the book doesn't exist, insert a new record
//        $insertQuery = "INSERT INTO suggested_books (book_name, author, edition, isbn, publisher, year, cost, field, quantity) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
//        $stmtInsert = $conn->prepare($insertQuery);
//        $stmtInsert->bind_param("sssssiisi", $book_name, $author, $edition, $isbn, $publisher, $year, $cost, $field, $quantity);

//        if ($stmtInsert->execute()) {
//            echo "<script>alert('Suggested new books successfully')</script>";
//            echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/faculty/suggested_books.php">';
//         } else {
//            echo "Error inserting record: " . $stmtInsert->error;
//        }

//        $stmtInsert->close();
//    }

//    $conn->close();
?>

<?php
$book_name = $_POST['book_name'];
$author = $_POST['author'];
$edition = $_POST['edition'];
$isbn = $_POST['isbn'];
$publisher = $_POST['publisher'];
$year = $_POST['year'];
$cost = $_POST['cost'];
$field = $_POST['field'];
$quantity = $_POST['quantity'];

// Database connection
$conn = new mysqli('127.0.0.1', 'root', '', 'indenting');

// Check if the book already exists
$existingQuery = "SELECT * FROM suggested_books WHERE isbn = ?";
$stmtExisting = $conn->prepare($existingQuery);
$stmtExisting->bind_param("s", $isbn);
$stmtExisting->execute();
$resultExisting = $stmtExisting->get_result();
$stmtExisting->close();

if ($resultExisting->num_rows > 0) {
    // If the book exists, fetch the current quantity and num_of_faculty
    $existingData = $resultExisting->fetch_assoc();
    $currentQuantity = intval($existingData['quantity']);
    $currentNumOfFaculty = intval($existingData['num_of_faculty']);

    // Increment num_of_faculty
    $currentNumOfFaculty++;

    // Update the quantity to the maximum value of the current and given quantity
    $newQuantity = max($currentQuantity, $quantity);

    // Update the existing record with the incremented num_of_faculty and new quantity
    $updateQuery = "UPDATE suggested_books SET quantity = ?, num_of_faculty = ? WHERE isbn = ?";
    $stmtUpdate = $conn->prepare($updateQuery);
    $stmtUpdate->bind_param("iis", $newQuantity, $currentNumOfFaculty, $isbn);

    if ($stmtUpdate->execute()) {
        echo "<script>alert('Updated quantity and num_of_faculty for existing book')</script>";
        echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/faculty/suggested_books.php">';
    } else {
        echo "Error updating record: " . $stmtUpdate->error;
    }

    $stmtUpdate->close();
} else {
    // If the book doesn't exist, insert a new record
    $insertQuery = "INSERT INTO suggested_books (book_name, author, edition, isbn, publisher, year, cost, field, quantity, num_of_faculty) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1)";
    $stmtInsert = $conn->prepare($insertQuery);
    $stmtInsert->bind_param("sssssiisi", $book_name, $author, $edition, $isbn, $publisher, $year, $cost, $field, $quantity);

    if ($stmtInsert->execute()) {
        echo "<script>alert('Suggested new books successfully')</script>";
        echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/faculty/suggested_books.php">';
    } else {
        echo "Error inserting record: " . $stmtInsert->error;
    }

    $stmtInsert->close();
}

$conn->close();
?>
