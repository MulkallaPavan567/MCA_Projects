<?php
$con = mysqli_connect("localhost", "root", "", "indenting");

if (!$con) {
    die("Connection Error: " . mysqli_connect_error());
}

$username = isset($_GET['username']) ? $_GET['username'] : ''; // Get the ISBN number from the URL if it's set

if (!empty($username)) {
    // Retrieve book details based on ISBN number
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Error: " . mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        die("Name with username '$username' not found.");
    }

    $name = $row['name'];
    $password = $row['password'];
    
} else {
    // Handle the case where ISBN is not provided in the URL
    echo "Username is missing in the URL.";
    // You can decide what action to take or display a message as needed.
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update profile</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <div id="header">
      <div id="img_left">
        <img src="../img/uoh_logo_white.png" alt="University of Hyderabad">
      </div>
      <div id="title">
        <h1>School of Computer and Information Sciences</h1>
        <h2>Library Books / Journals Indenting System</h2>
      </div>
      <div id="img_right">
        <img src="../img/uoh_ioe_white.png" alt="University of Hyderabad">
      </div>
    </div>
  </header>

  <div id="section" class="btn-group1">
             
    <button onclick="window.location.href='../manage_users/new_user.html'">Create New User</button>
    <button onclick="window.location.href='../manage_users/index3.php'">Manage Users</button>
    <button onclick="window.location.href='../manage_books/adding_books.html'">Manage Books</button>
    <button onclick="window.location.href='../manage_journals/adding_journals.html'">Manage Journals</button>
    <button onclick="window.location.href='../profile/update.php'" id="user-btn">Edit Profile</button>
    <button onclick="window.location.href='../approve/approved_book.php'">Approve</button>
    <button onclick="window.location.href='../admin1.php'">Logout</button>
  </div>
    <div id="form-left">
        <div id="navigation">
            <center>
                <form action="" method="POST">
                    <label for="name">ADMIN NAME :</label>
                    <input type="text" id="name" name="name" size="50" placeholder="enter the admin name" value="<?php echo $name; ?>" required><br>
                    <label for="username">USERNAME :</label>
                    <input type="text" id="username" name="username" size="100" placeholder="username" value="<?php echo $username; ?>" required><br>
                    <label for="password">PASSWORD :</label>
                    <input type="text" id="password" name="password" size="100" placeholder="password for admin" value="<?php echo $password; ?>" required><br>
                    <div id="button">
                        <input type="submit" value="Update" name="submit">
                    </div>
                </form>
            </center>
        </div>
    </div>

    </body>

</html>    

<?php
if (isset($_POST['submit'])) {
    $newAdminname = $_POST['name'];
    $newPassword = $_POST['password'];

    // Check if the values are different before attempting an update
    if ($newAdminname !== $name || $newPassword !== $password) {
        $query = "UPDATE users SET name='$newAdminname', password='$newPassword' WHERE username='$username'";
        $data = mysqli_query($con, $query);

        if ($data) {
            echo "<script>alert('Record Updated Successfully')</script>";
            echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/indent/profile/update_profile.php">';
        } else {
            echo "Failed to Update Record: " . mysqli_error($con);
        }
    } else {
        echo "No changes detected in the data. Nothing to update.";
    }
}
?>

