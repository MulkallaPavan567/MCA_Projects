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

        // Start a transaction
        $conn->begin_transaction();

        try {
            // Read CSV file
            if (($handle = fopen($file, "r")) !== false) {
                while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                    $book_name = $data[0];
                    $author = $data[1];
                    $edition = $data[2];
                    $isbn = $data[3];
                    $publisher = $data[4];
                    $year = $data[5];
                    $cost = $data[6];
                    $field = $data[7];

                    // Check if the book with the same ISBN already exists
                    $existingQuery = "SELECT * FROM add_new_books WHERE isbn = '$isbn'";
                    $existingResult = $conn->query($existingQuery);

                    if ($existingResult->num_rows == 0) {
                        // If the book doesn't exist, insert data into the "add_new_books" table
                        $sql = "INSERT INTO add_new_books (book_name, author, edition, isbn, publisher, year, cost, field) VALUES ('$book_name', '$author', '$edition', '$isbn', '$publisher', '$year', '$cost', '$field')";

                        if ($conn->query($sql) !== true) {
                            $success = false; // Set to false on the first error
                            throw new Exception("Error inserting book: " . $conn->error);
                        }
                    } else {
                        // If the book already exists, show a message
                        echo "Book with ISBN: $isbn already exists. Skipping.<br>";
                    }
                }
                fclose($handle);
            }

            // Commit the transaction
            $conn->commit();

            if ($success) {
                echo "<script>alert('Data added to database successfully')</script>" . "<br>";
                echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/manage_books/update_books.php">';
            } else {
                echo "<script>alert('Error: Added all books except duplicate entries')</script>";
                echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/manage_books/update_books.php">';
            }
        } catch (Exception $e) {
            // Rollback the transaction on exception
            $conn->rollback();
            echo "<script>alert('Error: {$e->getMessage()}')</script>";
        }
    }

    $conn->close();
}
?>
