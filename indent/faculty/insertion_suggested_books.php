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
//                 $book_name = $data[0];
//                 $author = $data[1];
//                 $edition = $data[2];
//                 $isbn = $data[3];
//                 $publisher = $data[4];
//                 $year = $data[5];
//                 $cost = $data[6];
//                 $field = $data[7];
//                 $quantity = $data[8];
                
//                 // Check if the book already exists
//                 $existingQuery = "SELECT * FROM suggested_books WHERE isbn = '$isbn'";
//                 $existingResult = $conn->query($existingQuery);

//                 if ($existingResult->num_rows > 0) {
//                     // If the book exists, fetch the current quantity
//                     $existingData = $existingResult->fetch_assoc();
//                     $currentQuantity = intval($existingData['quantity']);

//                     // Update the quantity to the maximum value of the current and given quantity
//                     $newQuantity = max($currentQuantity, $quantity);

//                     // Update the existing record
//                     $updateQuery = "UPDATE suggested_books SET quantity = $newQuantity WHERE isbn = '$isbn'";
//                     if ($conn->query($updateQuery) !== true) {
//                         $success = false; // Set to false on the first error
//                         echo "Error updating record: " . $conn->error;
//                         break; // Exit the loop on error
//                     }
//                 } else {
//                     // Insert data into the "suggested_books" table
//                     $insertQuery = "INSERT INTO suggested_books (book_name, author, edition, isbn, publisher, year, cost, field, quantity) VALUES ('$book_name', '$author', '$edition', '$isbn', '$publisher', '$year', '$cost', '$field', '$quantity')";
//                     if ($conn->query($insertQuery) !== true) {
//                         $success = false; // Set to false on the first error
//                         echo "Error inserting record: " . $conn->error;
//                         break; // Exit the loop on error
//                     }
//                 }
//             }
//             fclose($handle);
//         }

//         if ($success) {
//             echo "<script>alert('Added/Updated books successfully')</script>";
//             echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/faculty/suggested_books.php">';
//         } else {
//             echo "<script>alert('Error: Unable to add/update all books')</script>";
//         }
//     }
    
//     $conn->close();
// }
?>
<?php
// session_start();

// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     $conn = new mysqli('127.0.0.1:3308', 'root', '', 'indenting');

//     // Check connection
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }

//     $success = true; // Track if all insertions are successful

//     // Assuming you have the faculty_id and username stored in session variables. Adjust accordingly.
//     // $facultyId = $_SESSION['faculty_id'];
//     $username = $_SESSION['username'];

//     // Process the uploaded CSV file
//     if (isset($_FILES["csvfile"]) && $_FILES["csvfile"]["error"] == 0) {
//         $file = $_FILES["csvfile"]["tmp_name"];

//         // Read CSV file
//         if (($handle = fopen($file, "r")) !== false) {
//             while (($data = fgetcsv($handle, 1000, ",")) !== false) {
//                 $book_name = $data[0];
//                 $author = $data[1];
//                 $edition = $data[2];
//                 $isbn = $data[3];
//                 $publisher = $data[4];
//                 $year = $data[5];
//                 $cost = $data[6];
//                 $field = $data[7];
//                 $quantity = $data[8];

//                 // Check if the book already exists
//                 $existingQuery = "SELECT * FROM suggested_books WHERE isbn = '$isbn'";
//                 $existingResult = $conn->query($existingQuery);

//                 if ($existingResult->num_rows > 0) {
//                     // If the book exists, fetch the current data
//                     $existingData = $existingResult->fetch_assoc();
//                     $currentQuantity = intval($existingData['quantity']);
//                     $currentNumOfFaculty = intval($existingData['num_of_faculty']);
//                     // $existingFacultyId = intval($existingData['faculty_id']);

//                     if ($existingusername != $username) {
//                         // Different faculty suggesting the same book, increment num_of_faculty
//                         $currentNumOfFaculty++;

//                         // Update the quantity to the maximum value of the current and given quantity
//                         $newQuantity = max($currentQuantity, $quantity);

//                         // Update the existing record with the incremented num_of_faculty and new quantity
//                         $updateQuery = "UPDATE suggested_books SET num_of_faculty = $currentNumOfFaculty, quantity = $newQuantity WHERE isbn = '$isbn'";
//                         if ($conn->query($updateQuery) !== true) {
//                             $success = false; // Set to false on the first error
//                             echo "Error updating record: " . $conn->error;
//                             break; // Exit the loop on error
//                         }
//                     } else {
//                         // Same faculty suggesting the same book again, no need to update num_of_faculty
//                         // Update the quantity to the maximum value of the current and given quantity
//                         $newQuantity = max($currentQuantity, $quantity);

//                         // Your existing code for updating quantity can go here
//                     }
//                 } else {
//                     // Insert data into the "suggested_books" table
//                     $newQuantity = $quantity; // Define $newQuantity for the insert case

//                     $insertQuery = "INSERT INTO suggested_books (book_name, author, edition, isbn, publisher, year, cost, field, quantity, username, num_of_faculty, faculty_id) VALUES ('$book_name', '$author', '$edition', '$isbn', '$publisher', '$year', '$cost', '$field', '$newQuantity', '$username', 1, '$facultyId')";
//                     if ($conn->query($insertQuery) !== true) {
//                         $success = false; // Set to false on the first error
//                         echo "Error inserting record: " . $conn->error;
//                         break; // Exit the loop on error
//                     }
//                 }
//             }
//             fclose($handle);
//         }

//         if ($success) {
//             echo "<script>alert('Added/Updated books successfully')</script>";
//             echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/faculty/suggested_books.php">';
//         } else {
//             echo "<script>alert('Error: Unable to add/update all books')</script>";
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
                $book_name = $data[0];
                $author = $data[1];
                $edition = $data[2];
                $isbn = $data[3];
                $publisher = $data[4];
                $year = $data[5];
                $cost = $data[6];
                $field = $data[7];
                $quantity = $data[8];
                
                // Check if the book already exists
                $existingQuery = "SELECT * FROM suggested_books WHERE isbn = '$isbn'";
                $existingResult = $conn->query($existingQuery);

                if ($existingResult->num_rows > 0) {
                    // If the book exists, fetch the current quantity and num_of_faculty
                    $existingData = $existingResult->fetch_assoc();
                    $currentQuantity = intval($existingData['quantity']);
                    $currentNumOfFaculty = intval($existingData['num_of_faculty']);

                    // Increment num_of_faculty
                    $currentNumOfFaculty++;

                    // Update the quantity to the maximum value of the current and given quantity
                    $newQuantity = max($currentQuantity, $quantity);

                    // Update the existing record with the incremented num_of_faculty and new quantity
                    $updateQuery = "UPDATE suggested_books SET quantity = $newQuantity, num_of_faculty = $currentNumOfFaculty WHERE isbn = '$isbn'";
                    if ($conn->query($updateQuery) !== true) {
                        $success = false; // Set to false on the first error
                        echo "Error updating record: " . $conn->error;
                        break; // Exit the loop on error
                    }
                } else {
                    // Insert data into the "suggested_books" table
                    $insertQuery = "INSERT INTO suggested_books (book_name, author, edition, isbn, publisher, year, cost, field, quantity, num_of_faculty) VALUES ('$book_name', '$author', '$edition', '$isbn', '$publisher', '$year', '$cost', '$field', '$quantity', 1)";
                    if ($conn->query($insertQuery) !== true) {
                        $success = false; // Set to false on the first error
                        echo "Error inserting record: " . $conn->error;
                        break; // Exit the loop on error
                    }
                }
            }
            fclose($handle);
        }

        if ($success) {
            echo "<script>alert('Added/Updated books successfully')</script>";
            echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/faculty/suggested_books.php">';
        } else {
            echo "<script>alert('Error: Unable to add/update all books')</script>";
        }
    }
    
    $conn->close();
}
?>
