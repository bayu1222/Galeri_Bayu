<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="css/gallery.css">  
<link rel="stylesheet" href="../assets/css/bootstrap.css">
<body>
    <?php include("frame/header.php"); ?>
    <?php include("frame/navbar.php"); ?>
   
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">Album Detail</h2>
            </div>
            <div class="card-body">
                <?php
                // Koneksi ke database (sesuaikan dengan informasi koneksi Anda)
                $conn = new mysqli('localhost', 'root', '', 'sosmed');

                // Periksa koneksi
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query untuk mengambil data album dari tabel
                $sql = "SELECT * FROM album";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    ?>
                    <div class="list-group">
                        <div class="list-group-item">
                            <strong>Album ID:</strong>
                            <span class="float-right"><?= $row['albumId'] ?></span>
                        </div>
                        <div class="list-group-item">
                            <strong>Nama Album:</strong>
                            <span class="float-right"><?= $row['namaAlbum'] ?></span>
                        </div>
                        <div class="list-group-item">
                            <strong>Deskripsi:</strong>
                            <span class="float-right"><?= $row['deskripsi'] ?></span>
                        </div>
                        <div class="list-group-item">
                            <strong>Tanggal:</strong>
                            <span class="float-right"><?= $row['tgl'] ?></span>
                        </div>
                        <div class="list-group-item">
                            <strong>User ID:</strong>
                            <span class="float-right"><?= $row['userId'] ?></span>
                        </div>
                    </div>
                  
                 <a href="add_album.php" class="btn btn-primary">add</a>
                 <a href="edit_album.php?albumId=<?php echo $row["albumId"];?>" class="btn btn-warning">edit</a>
                 <a href="delete_album.php?albumId=<?php echo $row["albumId"];?>" class="btn btn-danger">delete</a>
                
            </div>
           
        </div>
       
    </div>
    <?php
                } else {
                    echo '<p class="text-danger">Album not found.</p>';
                }

                // Tutup koneksi database
                $conn->close();
                ?>
    <center>
    <a href="logout.php" class="btn btn-danger">logout</a>
    </center>
    
    
</body>
</html>