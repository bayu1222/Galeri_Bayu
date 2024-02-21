<?php
// Include your database connection here

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["userId"])) {
    $userId = $_GET["userId"];

    $conn = mysqli_connect("localhost", "root", "", "sosmed");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve user data based on userId
    $result = mysqli_query($conn, "SELECT * FROM user WHERE userId = $userId");
    $userData = mysqli_fetch_assoc($result);

    mysqli_close($conn);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $userId = $_POST["userId"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $nama_lengkap = $_POST["nama_lengkap"];

    // Validate and sanitize data (you should perform more thorough validation)
    // ...

    // Include database connection
    $conn = mysqli_connect("your_host", "your_username", "your_password", "your_database");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Update user data in the database
    $sql = "UPDATE user SET username='$username', email='$email', nama_lengkap='$nama_lengkap' WHERE userId=$userId";

    if (mysqli_query($conn, $sql)) {
        echo "User updated successfully";
    } else {
        echo "Error updating user: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2>Edit User</h2>

    <form method="post" action="">
        <input type="hidden" name="userId" value="<?php echo $userData['userId']; ?>">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" value="<?php echo $userData['username']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" value="<?php echo $userData['email']; ?>" required>
        </div>
        <div class="form-group">
            <label for="nama_lengkap">Full Name:</label>
            <input type="text" class="form-control" name="nama_lengkap" value="<?php echo $userData['nama_lengkap']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>

</body>
</html>
