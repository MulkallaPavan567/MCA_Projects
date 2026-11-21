<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli('127.0.0.1', 'root', '', 'indenting');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get values from the form
    $book_name = $_POST['book_name'];
    $author = $_POST['author'];
    $edition = $_POST['edition'];
    $isbn = $_POST['isbn'];
    $publisher = $_POST['publisher'];
    $year = $_POST['year'];
    $cost = $_POST['cost'];
    $field = $_POST['field'];

    // Check if the book with the same ISBN already exists
    $existingQuery = "SELECT * FROM add_new_books WHERE isbn = '$isbn'";
    $existingResult = $conn->query($existingQuery);

    if ($existingResult->num_rows > 0) {
        // If the book already exists, show an alert and do not insert
        echo "<script>alert('Duplicate entry for ISBN: $isbn')</script>";
    ?>
        <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/manage_books/adding_books.php">
    <?php
    } else {
        // The book does not exist, proceed with insertion
        $stmt = $conn->prepare("INSERT INTO add_new_books (book_name, author, edition, isbn, publisher, year, cost, field) VALUES (?,?,?,?,?,?,?,?)");

        if (!$stmt) {
            die('Connection Failed : ' . $conn->error);
        }

        $stmt->bind_param("sssssiis", $book_name, $author, $edition, $isbn, $publisher, $year, $cost, $field);

        if ($stmt->execute()) {
            echo "<script>alert('Added new books successfully')</script>";
            ?>
            <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/manage_books/update_books.php">
            <?php
        } else {
            echo "Error inserting record: " . $stmt->error;
            echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/manage_books/update_books.php">';
        }

        $stmt->close();   // Closing prepared statement
    }

    $conn->close();   // Closing connection
}
?>
