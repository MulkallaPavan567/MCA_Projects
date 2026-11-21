<?php
// Include your database configuration here
require_once 'config/db1.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['approved_books'])) {
    // Retrieve the selected books data sent from the front-end
    $selectedBooks = json_decode($_POST['approved_books'], true);

    if (is_array($selectedBooks) && !empty($selectedBooks)) {
        $insertedCount = 0;

        // Loop through the selected books and insert them into the 'approved_books' table
        foreach ($selectedBooks as $book) {
            $bookName = mysqli_real_escape_string($con, $book['book_name']);
            $author = mysqli_real_escape_string($con, $book['author']);
            $edition = mysqli_real_escape_string($con, $book['edition']);
            $isbn = mysqli_real_escape_string($con, $book['isbn']);
            $publisher = mysqli_real_escape_string($con, $book['publisher']);
            $year = mysqli_real_escape_string($con, $book['year']);
            $cost = mysqli_real_escape_string($con, $book['cost']);
            $field = mysqli_real_escape_string($con, $book['field']);
            $quantity = isset($book['quantity']) ? intval($book['quantity']) : 0;
           // $num_of_faculty = mysqli_real_escape_string($con, $book['num_of_faculty']);

            // Check if the book already exists in the 'approved_books' table
            $existingQuery = "SELECT * FROM approved_books WHERE isbn = '$isbn'";
            $existingResult = mysqli_query($con, $existingQuery);

            if (mysqli_num_rows($existingResult) > 0) {
                // If the book exists, update the quantity
                $updateQuery = "UPDATE approved_books SET quantity = quantity + $quantity WHERE isbn = '$isbn'";
                $result = mysqli_query($con, $updateQuery);
            } else {
                // If the book doesn't exist, insert a new record
                $insertQuery = "INSERT INTO approved_books (book_name, author, edition, isbn, publisher, year, cost, field, quantity) 
                                VALUES ('$bookName', '$author', '$edition', '$isbn', '$publisher', '$year', '$cost', '$field', '$quantity')";
                $result = mysqli_query($con, $insertQuery);
            }

            if ($result) {
                $insertedCount++;
            } else {
                // Handle insertion errors
                echo "Error updating/inserting book: " . mysqli_error($con);
            }
        }

        // Check if any books were successfully inserted
            if ($insertedCount > 0) {
                echo "Successfully suggested/updated $insertedCount book(s).";
                // header("Location: http://localhost/indent/approve/approved_books_list.php");
                // exit(); // Ensure that no further code is executed after redirection
            } else {
                echo "No books were suggested.";
            }
        } else {
            echo "Invalid request. Please submit the form data.";
        }
    }

// Close the database connection
mysqli_close($con);
?>
