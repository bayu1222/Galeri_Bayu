<?php
session_start();
include('database/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Hindari penggunaan md5, gunakan metode enkripsi yang lebih aman

    $sql = "SELECT  username FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($db,$sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['login_user'] = $row['username'];
        $_SESSION['userId'];
        header("location: user/dashboard.php"); // Sesuaikan dengan halaman selamat datang
    } else {
        $error = "Username atau Password salah";
        header("location:error.html");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Social Media Hub</title>
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

        .login-container {
            max-width: 400px;
            margin: 160px auto 80px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            text-align: center;
            color: #333;
        }

        .login-form {
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
    <div class="login-container">
        <h2>Login to Your Account</h2>
        <form class="login-form" action="" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>

        <div class="form-footer">
            <p>Don't have an account? <a href="register.php">Sign up here</a>.</p>
        </div>
    </div>

</body>
</html>
