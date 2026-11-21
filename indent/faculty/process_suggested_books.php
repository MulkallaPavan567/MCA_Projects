<?php
// // Include your database configuration here
// require_once 'config/db1.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['suggested_books'])) {
//     // Retrieve the selected books data sent from the front-end
//     $selectedBooks = json_decode($_POST['suggested_books'], true);

//     if (is_array($selectedBooks) && !empty($selectedBooks)) {
//         $insertedCount = 0;

//         // Loop through the selected books and insert/update them in the 'suggested_books' table
//         foreach ($selectedBooks as $book) {
//             $bookName = mysqli_real_escape_string($con, $book['book_name']);
//             $author = mysqli_real_escape_string($con, $book['author']);
//             $edition = mysqli_real_escape_string($con, $book['edition']);
//             $isbn = mysqli_real_escape_string($con, $book['isbn']);
//             $publisher = mysqli_real_escape_string($con, $book['publisher']);
//             $year = mysqli_real_escape_string($con, $book['year']);
//             $cost = mysqli_real_escape_string($con, $book['cost']);
//             $field = mysqli_real_escape_string($con, $book['field']);
//             $quantity = isset($book['quantity']) ? intval($book['quantity']) : 0;

//             // Check if the book already exists in the 'suggested_books' table
//             $existingQuery = "SELECT * FROM suggested_books WHERE isbn = '$isbn'";
//             $existingResult = mysqli_query($con, $existingQuery);
            
//             if (mysqli_num_rows($existingResult) > 0) {
//                 // If the book exists, fetch the current quantity
//                 $existingData = mysqli_fetch_assoc($existingResult);
//                 $currentQuantity = intval($existingData['quantity']);
        
//                 // Update the quantity to the maximum value of the current and given quantity
//                 $newQuantity = max($currentQuantity, $quantity);
        
//                 $updateQuery = "UPDATE suggested_books SET quantity = $newQuantity WHERE isbn = '$isbn'";
//                 $result = mysqli_query($con, $updateQuery);
//             } else {
//                 // If the book doesn't exist, insert a new record
//                 $insertQuery = "INSERT INTO suggested_books (book_name, author, edition, isbn, publisher, year, cost, field, quantity) 
//                                 VALUES ('$bookName', '$author', '$edition', '$isbn', '$publisher', '$year', '$cost', '$field', '$quantity')";
//                 $result = mysqli_query($con, $insertQuery);
//             }
//             // if (mysqli_num_rows($existingResult) > 0) {
//             //     // If the book exists, update the quantity
//             //     $updateQuery = "UPDATE suggested_books SET quantity = quantity + $quantity WHERE isbn = '$isbn'";
//             //     $result = mysqli_query($con, $updateQuery);
//             // } else {
//             //     // If the book doesn't exist, insert a new record
//             //     $insertQuery = "INSERT INTO suggested_books (book_name, author, edition, isbn, publisher, year, cost, field, quantity) 
//             //                     VALUES ('$bookName', '$author', '$edition', '$isbn', '$publisher', '$year', '$cost', '$field', '$quantity')";
//             //     $result = mysqli_query($con, $insertQuery);
//             // }


//             if ($result) {
//                 $insertedCount++;
//             } else {
//                 // Handle insertion/update errors
//                 echo "Error updating/inserting book: " . mysqli_error($con);
//             }
//         }

//         // Check if any books were successfully inserted/updated
//         if ($insertedCount > 0) {
//             echo "Successfully suggested/updated $insertedCount book(s).";
//         } else {
//             echo "No books were suggested/updated.";
//         }
//     } else {
//         echo "No valid books selected for suggestion.";
//     }
// } else {
//     echo "Invalid request. Please submit the form data.";
// }

// // Close the database connection
// mysqli_close($con);
?>
<?php
// Include your database configuration here
require_once 'config/db1.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['suggested_books'])) {
    // Retrieve the selected books data sent from the front-end
    $selectedBooks = json_decode($_POST['suggested_books'], true);

    if (is_array($selectedBooks) && !empty($selectedBooks)) {
        $insertedCount = 0;

        // Loop through the selected books and insert/update them in the 'suggested_books' table
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

            // Check if the book already exists in the 'suggested_books' table
            $existingQuery = "SELECT * FROM suggested_books WHERE isbn = '$isbn'";
            $existingResult = mysqli_query($con, $existingQuery);
            
            if (mysqli_num_rows($existingResult) > 0) {
                // If the book exists, fetch the current quantity and num_of_faculty
                $existingData = mysqli_fetch_assoc($existingResult);
                $currentQuantity = intval($existingData['quantity']);
                $currentNumOfFaculty = intval($existingData['num_of_faculty']);

                // Increment num_of_faculty
                $currentNumOfFaculty++;

                // Update the quantity to the maximum value of the current and given quantity
                $newQuantity = max($currentQuantity, $quantity);

                // Update the existing record with the incremented num_of_faculty and new quantity
                $updateQuery = "UPDATE suggested_books SET quantity = $newQuantity, num_of_faculty = $currentNumOfFaculty WHERE isbn = '$isbn'";
                $result = mysqli_query($con, $updateQuery);
            } else {
                // If the book doesn't exist, insert a new record
                $insertQuery = "INSERT INTO suggested_books (book_name, author, edition, isbn, publisher, year, cost, field, quantity, num_of_faculty) 
                                VALUES ('$bookName', '$author', '$edition', '$isbn', '$publisher', '$year', '$cost', '$field', '$quantity', 1)";
                $result = mysqli_query($con, $insertQuery);
            }

            if ($result) {
                $insertedCount++;
            } else {
                // Handle insertion/update errors
                echo "Error updating/inserting book: " . mysqli_error($con);
            }
        }

        // Check if any books were successfully inserted/updated
        if ($insertedCount > 0) {
            echo "Successfully suggested/updated $insertedCount book(s).";
        } else {
            echo "No books were suggested/updated.";
        }
    } else {
        echo "No valid books selected for suggestion.";
    }
} else {
    echo "Invalid request. Please submit the form data.";
}

// Close the database connection
mysqli_close($con);
?>
