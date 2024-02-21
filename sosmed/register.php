<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Social Media Hub</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            line-height: 1.6;
            color: #333;
        }

        header {
            background-color: #405d9b;
            color: #fff;
            padding: 20px;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        header h1 {
            margin: 0;
        }

        header p {
            margin: 10px 0 0;
        }

        .register-container {
            max-width: 400px;
            margin: 80px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .register-container h2 {
            text-align: center;
            color: #333;
        }

        .register-form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            border-color: #e8491d;
        }

        .form-group button {
            background-color: #e8491d;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .form-group button:hover {
            background-color: #d63614;
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
        }

        .form-footer a {
            color: #e8491d;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <?php include"frame/header.php"; ?>
    <div class="container">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include("database/db.php");

        // Proses formulir pendaftaran
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $nama_lengkap = $_POST["nama_lengkap"];

        // Validasi input
        if (!empty($username) && !empty($password) && !empty($email) && !empty($nama_lengkap)) {
            // Jalankan query INSERT
            $sql = "INSERT INTO user (username, password, email, nama_lengkap) VALUES ('$username', '$password', '$email', '$nama_lengkap')";

            // Jalankan query
            $result = mysqli_query($db, $sql);

            if ($result) {
                echo '<div class="alert alert-success" role="alert">Registrasi berhasil! Selamat datang, ' . $nama_lengkap . '.</div>';
                // Redirect ke halaman login
                header("location: login.php");
            } else {
                echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . mysqli_error($db) . '</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Mohon isi semua kolom.</div>';
        }

        mysqli_close($db);
    }
    ?>
    <form action="" method="POST">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap:</label>
            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary" name="submit">Daftar</button>
        </div>
    </form>
</div>
`
    
</body>
</html>
