<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="css/dashboard.css">
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f4fc;
}

/* Style untuk header */
header {
    background-color: #3f51b5;
    color: #fff;
    padding: 20px 0;
    text-align: center;
}

/* Style untuk judul header */
header h1 {
    margin: 0;
    font-size: 24px;
}

/* Style untuk form tambah foto */
form {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: center; /* Rata tengah */
}

/* Style untuk input text dan textarea */
input[type="text"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

/* Style untuk tombol tambah foto */
button[type="submit"] {
    background-color: #3f51b5;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

/* Style untuk card */
.card {
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-bottom: 20px;
    text-align: center; /* Rata tengah */
    max-width: 400px; /* Ukuran maksimum card */
    margin-left: auto;
    margin-right: auto;
}


/* Style untuk judul foto */
h2 {
    margin-top: 0;
}

/* Style untuk gambar */
.card img {
    max-width: 100%; /* Ukuran maksimum gambar */
    border-radius: 5px;
}

/* Style untuk tombol toggle like dan tambah komentar */
.toggle-like,
.add-comment {
    background-color: #3f51b5;
    color: #fff;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}

/* Style untuk tombol edit dan hapus */
.edit-delete-btns {
    margin-top: 10px;
}

.edit-delete-btns button {
    background-color: #f44336;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 5px 10px;
    cursor: pointer;
    margin-right: 5px;
}

.edit-delete-btns button.edit {
    background-color: #4caf50;
}
</style>
</head>
<body>

<?php include("frame/header.php"); ?>
<?php include("frame/navbar.php"); ?>

<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sosmed";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fungsi untuk menambahkan atau menghapus like (toggle)
function toggleLike($fotoId, $userId, $conn) {
    // Periksa apakah pengguna sudah melakukan like sebelumnya
    $sql_check = "SELECT * FROM likefoto WHERE fotoId='$fotoId' AND userId='$userId'";
    $result_check = $conn->query($sql_check);
    if ($result_check->num_rows > 0) {
        // Jika sudah ada like sebelumnya, hapus like
        $sql_delete = "DELETE FROM likefoto WHERE fotoId='$fotoId' AND userId='$userId'";
        if ($conn->query($sql_delete) === TRUE) {
            echo "Unlike berhasil.";
        } else {
            echo "Error: " . $sql_delete . "<br>" . $conn->error;
        }
    } else {
        // Jika belum ada like sebelumnya, tambahkan like
        $sql_add = "INSERT INTO likefoto (fotoId, userId, tgl_like)
                    VALUES ('$fotoId', '$userId', NOW())";
        if ($conn->query($sql_add) === TRUE) {
            echo "Like berhasil ditambahkan.";
        } else {
            echo "Error: " . $sql_add . "<br>" . $conn->error;
        }
    }
}

// Fungsi untuk menambahkan foto
function addFoto($judul, $deskripsi, $tgl_upload, $directory, $albumId, $userId, $filename, $conn) {
    $directory = "uploads/" . $filename; // Menggabungkan direktori dengan nama file
    $sql = "INSERT INTO foto (judulFoto, deskripsiFoto, tgl_upload, directory, albumId, userId)
            VALUES ('$judul', '$deskripsi', '$tgl_upload', '$directory', '$albumId', '$userId')";
    if ($conn->query($sql) === TRUE) {
        echo "Foto berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fungsi untuk mengedit foto
function editFoto($fotoId, $judul, $deskripsi, $conn) {
    $sql = "UPDATE foto SET judulFoto='$judul', deskripsiFoto='$deskripsi' WHERE fotoId='$fotoId'";
    if ($conn->query($sql) === TRUE) {
        echo "Foto berhasil diupdate.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cek jika ada pengiriman formulir edit foto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_photo"])) {
    $fotoId = $_POST["fotoId"];
    $judul = $_POST["judulFoto"];
    $deskripsi = $_POST["deskripsiFoto"];
    editFoto($fotoId, $judul, $deskripsi, $conn);
}

// Fungsi untuk menghapus foto
function deleteFoto($fotoId, $conn) {
    // Hapus foto dari database
    $sql_delete_foto = "DELETE FROM foto WHERE fotoId='$fotoId'";
    if ($conn->query($sql_delete_foto) === TRUE) {
        echo "Foto berhasil dihapus.";
    } else {
        echo "Error: " . $sql_delete_foto . "<br>" . $conn->error;
    }
    // Hapus like yang terkait dengan foto
    $sql_delete_like = "DELETE FROM likefoto WHERE fotoId='$fotoId'";
    if ($conn->query($sql_delete_like) === TRUE) {
        echo "Like berhasil dihapus.";
    } else {
        echo "Error: " . $sql_delete_like . "<br>" . $conn->error;
    }
    // Hapus komentar yang terkait dengan foto
    $sql_delete_comment = "DELETE FROM komentarfoto WHERE fotoId='$fotoId'";
    if ($conn->query($sql_delete_comment) === TRUE) {
        echo "Komentar berhasil dihapus.";
    } else {
        echo "Error: " . $sql_delete_comment . "<br>" . $conn->error;
    }
}

// Fungsi untuk menambahkan komentar
function addKomentar($fotoId, $userId, $isi_komentar, $tgl_komen, $conn) {
    $sql = "INSERT INTO komentarfoto (fotoId, userId, isi_komentar, tgl_komen)
            VALUES ('$fotoId', '$userId', '$isi_komentar', '$tgl_komen')";
    if ($conn->query($sql) === TRUE) {
        echo "Komentar berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fungsi untuk menampilkan komentar
// Fungsi untuk menampilkan komentar
function showKomentar($fotoId, $conn) {
    // Ambil komentar dari database
    
    $sql = "SELECT * FROM komentarfoto WHERE fotoId=$fotoId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {   
        while($row = $result->fetch_assoc()) {
            echo "<p><strong>User " . $row["userId"] . ":</strong> " . $row["isi_komentar"] . "</p>";
        }
    } else {
        echo "Belum ada komentar untuk foto ini.";
    }
}


// Fungsi untuk menghitung jumlah like pada suatu foto
function countLikes($fotoId, $conn) {
    $sql = "SELECT COUNT(*) AS total_likes FROM likefoto WHERE fotoId=$fotoId";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row["total_likes"];
}

// Fungsi untuk menangani aksi edit dan delete photo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["edit_photo"])) {
        $fotoId = $_POST["fotoId"];
        $judul = $_POST["judulFoto"];
        $deskripsi = $_POST["deskripsiFoto"];
        editFoto($fotoId, $judul, $deskripsi, $conn);
    }
    if (isset($_POST["delete_photo"])) {
        $fotoId = $_POST["fotoId"];
        deleteFoto($fotoId, $conn);
    }
}

// Fungsi untuk menambahkan foto atau komentar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add_foto"])) {
        $judul = $_POST["judulFoto"];
        $deskripsi = $_POST["deskripsiFoto"];
        $tgl_upload = date("Y-m-d");
        $albumId = 1; // ID album (misalnya, 1 untuk album pertama)
        $userId = 1; // ID pengguna yang saat ini masuk
        $filename = $_FILES["file"]["name"]; // Nama file yang diunggah
        $target_file = "uploads/" . basename($_FILES["file"]["name"]);

        // Pindahkan file yang diunggah ke direktori target
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            addFoto($judul, $deskripsi, $tgl_upload, $target_file, $albumId, $userId, $filename, $conn);
        } else {
            echo "Gagal mengunggah foto.";
        }
    }
    if (isset($_POST["add_comment"])) {
        $fotoId = $_POST["fotoId"];
        $userId = 1; // Anda dapat menyesuaikan nilai ini sesuai dengan pengguna yang saat ini masuk
        $isi_komentar = $_POST["comment"];
        $tgl_komen = date("Y-m-d");
        addKomentar($fotoId, $userId, $isi_komentar, $tgl_komen, $conn);
        // Redirect kembali ke dashboard setelah menambahkan komentar
        header("Location: dashboard.php");
        exit();
    }
    
    if (isset($_POST["toggle_like"])) {
        $fotoId = $_POST["fotoId"];
        $userId = 1; // Anda dapat menyesuaikan nilai ini sesuai dengan pengguna yang saat ini masuk
        toggleLike($fotoId, $userId, $conn);
    }
    if (isset($_POST["edit_photo"])) {
        // implementasi fungsi edit photo
        // Anda dapat menambahkan fungsi edit photo di sini
        echo "Fungsi edit photo akan ditambahkan di sini.";
    }
    if (isset($_POST["delete_photo"])) {
        // implementasi fungsi delete photo
        // Anda dapat menambahkan fungsi delete photo di sini
        echo "Fungsi delete photo akan ditambahkan di sini.";
    }
}
?>

<h2>Postingan</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
<input type="text" name="judulFoto" placeholder="Judul">
<textarea name="deskripsiFoto" placeholder="Deskripsi"></textarea>
<input type="file" name="file">
<button type="submit" name="add_foto">Tambah Foto</button>
</form>

<?php
// Ambil data foto dari database
$sql = "SELECT * FROM foto";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
?>
        <div class="card">
    <h2><?php echo $row["judulFoto"]; ?></h2>
    <img src="<?php echo $row["directory"]; ?>" alt="<?php echo $row["judulFoto"]; ?>">
    <p><?php echo $row["deskripsiFoto"]; ?></p>
    <p>Like: <span><?php echo countLikes($row["fotoId"], $conn); ?></span>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="fotoId" value="<?php echo $row["fotoId"]; ?>">
            <button type="submit" name="toggle_like" class="btn btn-primary btn-sm mr-2">Like</button>
        </form>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="fotoId" value="<?php echo $row["fotoId"]; ?>">
            <button type="submit" name="delete_photo" class="btn btn-danger btn-sm mr-2">Delete</button>
        </form>
        <button type="button" class="edit-btn btn btn-success btn-sm" data-toggle="modal" data-target="#editModal<?php echo $row["fotoId"]; ?>">Edit</button>
    </p>
    <h3>Komentar:</h3>
    <?php showKomentar($row["fotoId"], $conn); ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="fotoId" value="<?php echo $row["fotoId"]; ?>">
        <input type="text" name="comment" placeholder="Tambahkan komentar">
        <button type="submit" name="add_comment" class="btn btn-primary btn-sm">Tambah Komentar</button>
    </form>
</div>

        <!-- Modal untuk edit foto -->
        <div class="modal fade" id="editModal<?php echo $row["fotoId"]; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?php echo $row["fotoId"]; ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel<?php echo $row["fotoId"]; ?>">Edit Foto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="fotoId" value="<?php echo $row["fotoId"]; ?>">
                            <div class="form-group">
                                <label for="judulFoto">Judul</label>
                                <input type="text" class="form-control" id="judulFoto" name="judulFoto" value="<?php echo $row["judulFoto"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="deskripsiFoto">Deskripsi</label>
                                <textarea class="form-control" id="deskripsiFoto" name="deskripsiFoto"><?php echo $row["deskripsiFoto"]; ?></textarea>
                            </div>
                            <button type="submit" name="edit_photo" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo "Tidak ada foto yang tersedia.";
}

$conn->close();
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
  // Fungsi untuk mengisi modal edit dengan data foto yang dipilih
  function fillEditModal(fotoId, judul, deskripsi) {
    // Mengisi nilai input di modal dengan data foto yang dipilih
    document.getElementById('editFotoId').value = fotoId;
    document.getElementById('editJudulFoto').value = judul;
    document.getElementById('editDeskripsiFoto').value = deskripsi;
  }
</script>


</body>
</html>
