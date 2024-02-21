<?php
include("../database/db.php");

// Initialize variables
$albumId = $namaAlbum = $deskripsi = $tgl = $userId = "";

if (isset($_GET['albumId'])) {
    $albumId = $_GET['albumId'];

    $sql = "SELECT * FROM album WHERE albumId = $albumId";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $albumData = array(
            'namaAlbum' => $row['namaAlbum'],
            'deskripsi' => $row['deskripsi'],
            'tgl' => $row['tgl'],
            'userId' => $row['userId']
        );
    } else {
        echo "Album not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle the form submission and update the database
    $namaAlbum = $_POST['namaAlbum'];
    $deskripsi = $_POST['deskripsi'];
    $tgl = $_POST['tgl'];
    $userId = $_POST['userId'];

    $sqlUpdate = "UPDATE album SET 
                  namaAlbum = '$namaAlbum',
                  deskripsi = '$deskripsi',
                  tgl = '$tgl',
                  userId = $userId
                  WHERE albumId = $albumId";

    if ($db->query($sqlUpdate) === TRUE) {
        echo "Record updated successfully";
        header('location:album.php');
        // Update the array for displaying the form
        $albumData = array(
            'namaAlbum' => $namaAlbum,
            'deskripsi' => $deskripsi,
            'tgl' => $tgl,
            'userId' => $userId
        );
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Album</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Album</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="namaAlbum">Nama Album:</label>
                <input type="text" class="form-control" name="namaAlbum" value="<?php echo $albumData['namaAlbum']; ?>" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea class="form-control" name="deskripsi" required><?php echo $albumData['deskripsi']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="tgl">Tanggal:</label>
                <input type="date" class="form-control" name="tgl" value="<?php echo $albumData['tgl']; ?>" required>
            </div>

            <div class="form-group">
                <label for="userId">User ID:</label>
                <input type="text" class="form-control" name="userId" value="<?php echo $albumData['userId']; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>