<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Album</title>
  <!-- Bootstrap CSS link -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <h2>Add Album</h2>
  
  <?php
    // Connect to your MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sosmed";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Process the form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $namaAlbum = $_POST["namaAlbum"];
        $deskripsi = $_POST["deskripsi"];
        $tgl = $_POST["tgl"];
        $userId = $_POST["userId"];

        // Perform SQL insertion
        $sql = "INSERT INTO album (namaAlbum, deskripsi, tgl, userId) VALUES ('$namaAlbum', '$deskripsi', '$tgl', $userId)";

        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success" role="alert">Album added successfully</div>';
            header("location:album.php");
        } else {
            echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . $conn->error . '</div>';
        }
    }

    // Close the database connection
    $conn->close();
  ?>
    <a class="font-weight-bold text-primary " href="album.php">Back</a>
  <form action="" method="post">
    <div class="form-group">
      <label for="namaAlbum">Album Name:</label>
      <input type="text" class="form-control" id="namaAlbum" name="namaAlbum" required>
    </div>
    <div class="form-group">
      <label for="deskripsi">Description:</label>
      <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
    </div>
    <div class="form-group">
      <label for="tgl">Date:</label>
      <input type="date" class="form-control" id="tgl" name="tgl" required>
    </div>
    <div class="form-group">
      <label for="userId">User ID:</label>
      <input type="number" class="form-control" id="userId" name="userId" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Album</button>
  </form>
</div>

<!-- Bootstrap JS and Popper.js scripts (required for Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
