<!DOCTYPE html>
<head>
    <title>Suggested Journals</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../new_user.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../manage_journals/css/bootstrap.min.css">
    <style>
    form
    {
     height:auto;
     width:auto;
    }
    label
        {
         display:inline-block;
         width:100%;
         margin-right:1px;
         text-align:left;
         padding: 10px 5px 5px 20px;
         font-weight:bold;
        }

        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f7f7f7;
}

#header {
    /* Header styles */
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
        /* Navigation styles */
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px;
        background-color: #f7f7f7;
        color: white;
        width: auto;
        position: sticky;
        top: 0;
        z-index: 100;
        /* Lower z-index for navigation */
        }

  #section {
      background-color: #f7f7f7;
      padding: 10px;
      width: auto;
      /* Adjust as needed */
  }

  #section form {
      max-width: 50%;
  }

  /* .container {
          background-color: #fff;
          border-radius: 8px;
          padding: 20px;
          box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
          width: 600px;
          margin: 0 auto;
          } */

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

  .btn-group1 {
      display: flex;
      justify-content: center;
  }

  .btn-group1 button {
      background-color: #003366;
      color: #fff;
      border: none;
      padding: 10px 20px;
      margin: 0 10px;
      cursor: pointer;
      font-size: 16px;
      border-radius: 4px;
  }

  .btn-group1 button:hover {
      background-color: #6a819c;
      color: rgb(20, 20, 20);
  }

  input[type="text"],
  input[type="password"],
  input[type="number"] {
      width: 95%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-bottom: 12px;
  }

  input[type="submit"],
  input[type="reset"] {
      background-color: #003366;
      color: #fff;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      border-radius: 4px;
      font-size: 16px;
      width: 30%;
  }

  input[type="submit"]:hover {
      background-color: #002855;
  }

  .error-message {
      color: #ff0000;
      margin-top: 10px;
  }

  .password-toggle {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
  }

  #create-user-btn.active {
      background-color: #6a819c;
  }

  .horizontal-line {
      border: none;
      height: 4px;
      /* Adjust the height as needed */
      background-color: #003366;
      /* Change the color as needed */
  }
  #user-btn.active {
        background-color: #6a819c;
      }
footer {
            padding: 10px;
            color: #fff;
            font-size: 12px;
            background-color: #003366;
        }

footer a, footer a:hover {
            color: #fff;
            text-decoration: none;
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
    <div id="navigation" align="left" class="btn-group1">
        <!-- <button onclick="window.location.href='suggested_books.php'">Suggested Books</button>
        <button onclick="window.location.href='suggested_journals.php'" id="user-btn">Suggested Journals</button>-->
        <button onclick="window.location.href='select_book.php'">Select Books</button>
        <button onclick="window.location.href='select_journal.php'">Select Journals</button>
        <button onclick="window.location.href='suggest_books.php'">Suggest Books</button>
        <button onclick="window.location.href='suggest_journals.php'">Suggest Journals</button>
        <button onclick="window.location.href='suggested_books.php'">Suggested Books</button>
        <button onclick="window.location.href='suggested_journals.php'" id="user-btn">Suggested Journals</button>
        <button onclick="window.location.href='../faculty/profile/edit_profile.php'">Edit Profile</button>
        <button onclick="window.location.href='../faculty.php'">Logout</button>
    </div>
  <!--<body class="bg-dark">-->
  <div class="container">
    <div class="row mt-7">
      <div class="col">
        <div class="card mt-7">
          <div class="card-header">
            <h2 class="display-6 text-center">Suggested Journals</h2>
          </div>
          <div class="card-body">
            <table class="table table-bordered text-center">
              <tr class="bg-dark text-white">
                <td> Journal Name </td>
                <td> Journal Number </td>
                <td> Publisher </td>
                <td> Year of Publication </td>
                <td> Cost </td>
                <td> Field </td>
          <!--  <td> Quantity </td>
                 <td> Edit </td>
                 line 240 <td>" . $result['quantity'] . "</td> 
              line 241 <td><a href='EditJournalDetails.php?journalName=$result[journalName],publisher=$result[publisher],year=$result[year],cost=$result[cost],field=$result[field]&journalNumber=$result[journalNumber]' class='btn btn-primary'>Edit</a></td>-->
              </tr>
              <tr>
                <?php
                require_once 'config/db1.php';
                $query = "select * from suggested_journals";
                $data = mysqli_query($con, $query);
                $total = mysqli_num_rows($data);

                if ($total != 0) {
                  while ($result = mysqli_fetch_assoc($data)) {
                    echo "
                        <tr>
                        <td>" . $result['journalName'] . "</td>
                        <td>" . $result['journalNumber'] . "</td>
                        <td>" . $result['publisher'] . "</td>
                        <td>" . $result['year'] . "</td>
                        <td>" . $result['cost'] . "</td>
                        <td>" . $result['field'] . "</td>
                        
                        
                        </tr>
                        ";
                  }
                } else {
                  echo "No records found";
                }
                ?>
            <!--137 line code <td><a href='delete2.php?journalNumber=$result[journalNumber]' onclick='return checkdelete()' class='btn btn-danger'>Delete</a></td>-->
            </table>
            <!-- <script>
              function checkdelete() {
                return confirm('Are you sure want to Delete this Record');
              }
            </script> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    // Get the current page URL
    var currentPage = window.location.href;

    // Check if the current page URL matches the "new_user.html" URL
    if (currentPage.includes("suggested_journals.php")) {
        // Add the "active" class to the button
        document.getElementById("user-btn").classList.add("active");
    }
  </script>
</body>
<br> <br>
        <?php include('../footer.php');?>
</html>