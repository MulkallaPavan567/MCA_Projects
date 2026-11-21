<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.0/html2pdf.bundle.js"></script> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <title>Approved Books</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f7f7f7;
    }

    h1,
    h2 {
      text-align: center;
    }

    #header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 20px;
      background-color: #003366;
      color: white;
      width: auto;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    #navigation {
      display: flex;
      align-items: center;
      /* justify-content: space-between; */
      justify-content: space-around;
      padding: 20px;
      background-color: #f7f7f7;
      /* background-color: #f7f7f7; */
      color: white;
      width: auto;
      position: sticky;
      top: 0;
      z-index: 100;
    }

    #img_left,
    #img_right {
      flex: 0 0 auto;
    }

    #img_left img,
    #img_right img {
      max-width: 100%;
      height: auto;
    }

    #title {
      flex: 1 1 auto;
      text-align: center;
      margin: 0;
    }

    #section {
      text-align: center;
      padding: 20px 0;
    }

    .btn-group1 {
      display: flex;
      justify-content: center;
      border-radius: 4px;
    }

    .btn-group1 button {
      background-color: #003366;
      color: #fff;
      border: none;
      /* padding: 10px 20px; */
      padding: 10px 30px;
      margin: 0 10px;
      cursor: pointer;
      font-size: 16px;
      border-radius: 4px;
    }
    #navigation button:last-child {
      margin-right: 0; /* Remove extra margin from the last button (Logout) */
    }

    .btn-group1 button:hover {
      background-color: #6a819c;
    }

    #user-btn.active {
      background-color: #6a819c;
    }

    /* Center the image and table within their container */
    .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .container img {
            /* Remove any fixed width or height, as they might prevent centering */
            max-width: 100%;
            height: auto;
        }

        /* Center the table content within its cells */
        #approved-books-table td,
        #approved-books-table th {
            text-align: center;
            padding: 2px;
        }

  </style>
</head>

<body>
  <header>
    <div id="header">
      <div id="img_left">
        <img src="../img/uoh_logo_white.png" alt="University of Hyderabad">
      </div>
      <div id="title">
        <h1><b>School of Computer and Information Sciences</b></h1>
        <h2><b>Library Books / Journals Indenting System</b></h2>
      </div>
      <div id="img_right">
        <img src="../img/uoh_ioe_white.png" alt="University of Hyderabad">
      </div>
    </div>
  </header>

  <div id="navigation" class="btn-group1">
    <button onclick="window.location.href='../home/index.php'">Home</button>
    <button onclick="window.location.href='approved_book.php'">Approve Books</button>
    <button onclick="window.location.href='approved_journal.php'">Approve Journals</button>
    <button onclick="window.location.href='approved_books_list.php'" id="user-btn">Approved Books</button>
    <button onclick="window.location.href='approved_journals_list.php'">Approved Journals</button>
    <button onclick="window.location.href='../admin1.php'">Logout</button>
  </div>

  <div class="container" id="invoice">
    <img src="letter.jpg" alt="letter"> 
    <div class="row mt-5">
      <div class="col">
        <div class="card mt-5">
          <div class="card-header">
            <h2 class="display-6 text-center">Approved Books Details</h2>
          </div>
          <div class="card-body">
            <table id="approved-books-table" class="table table-bordered text-center">
              <tr class="bg-dark text-white">
                <td> Book Name </td>
                <td> Author </td>
                <td> Edition </td>
                <td> ISBN Number </td>
                <td> Publisher </td>
                <td> Year of Publication </td>
                <td> Cost </td>
                <td> Field </td>
                <td> Quantity </td>
              </tr>
              <?php
              require_once 'config/db1.php';
              $query = "select * from approved_books";
              $data = mysqli_query($con, $query);
              $total = mysqli_num_rows($data);

              if ($total != 0) {
                while ($result = mysqli_fetch_assoc($data)) {
                  echo "
                      <tr>
                      <td>" . $result['book_name'] . "</td>
                      <td>" . $result['author'] . "</td>
                      <td>" . $result['edition'] . "</td>
                      <td>" . $result['isbn'] . "</td>
                      <td>" . $result['publisher'] . "</td>
                      <td>" . $result['year'] . "</td>
                      <td>" . $result['cost'] . "</td>
                      <td>" . $result['field'] . "</td>
                      <td>" . $result['quantity'] . "</td>
                      </tr>
                      ";
                }
              } else {
                echo "No records found";
              }
              ?>
            </table>
            <!-- <center><button class="btn btn-success" id="downloadPdf">Generate Indent</button></center>

            <script>
              document.addEventListener('DOMContentLoaded', function () {
                document.getElementById('downloadPdf').addEventListener('click', function () {
                  const invoiceElement = document.getElementById('invoice');
                  const options = {
                    margin: 0,
                    filename: 'books.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
                  };

                  // Add a delay to ensure the table is fully rendered
                  setTimeout(function () {
                    html2pdf().from(invoiceElement).set(options).save();
                  }, 500); // You may need to adjust the delay based on your content.
                });
              });
            </script> -->


  <script>
    // Get the current page URL
    var currentPage = window.location.href;

    // Check if the current page URL matches the "approved_books_list.php" URL
    if (currentPage.includes("approved_books_list.php")) {
      // Add the "active" class to the button
      document.getElementById("user-btn").classList.add("active");
    }
  </script>
</body>

</html>
