<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Social Media Hub</title>
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
</head>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
        }

        .card-header {
            background-color: #007bff;
            color: #ffffff;
        }

        .list-group-item {
            background-color: #f8f9fa;
        }
    </style>
<body>
    <?php include("frame/header.php"); ?>
    <?php include("frame/navbar.php"); ?>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">User Profile</h2>
            </div>
            <div class="card-body">
                <?php
                // Koneksi ke database (sesuaikan dengan informasi koneksi Anda)
                $conn = new mysqli('localhost', 'root', '', 'sosmed');

                // Periksa koneksi
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query untuk mengambil data pengguna dari tabel
                $userId = 1;  // Ganti dengan userId yang sesuai
                $sql = "SELECT * FROM user WHERE userId = $userId";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    ?>
                    <div class="list-group">
                        <div class="list-group-item">
                            <strong>User ID:</strong>
                            <span class="float-right"><?= $row['userId'] ?></span>
                        </div>
                        <div class="list-group-item">
                            <strong>Username:</strong>
                            <span class="float-right"><?= $row['username'] ?></span>
                        </div>
                        <div class="list-group-item">
                            <strong>Email:</strong>
                            <span class="float-right"><?= $row['email'] ?></span>
                        </div>
                        <div class="list-group-item">
                            <strong>Full Name:</strong>
                            <span class="float-right"><?= $row['nama_lengkap'] ?></span>
                        </div>
                        <!-- Tambahkan elemen list-group-item sesuai kebutuhan, seperti password -->
                    </div>
                    <?php
                } else {
                    echo '<p class="text-danger">User not found.</p>';
                }

                // Tutup koneksi database
                $conn->close();
                ?>
                
                 <a href="settings.php?userId=<?php echo $row["userId"];?>" class="btn btn-warning">edit</a>
                 
            </div>
        </div>
    </div>
    <center>
    <a href="logout.php" class="btn btn-danger">logout</a>
    </center>
    
    
    
</body>
</html>
