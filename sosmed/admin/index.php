<?php
session_start();
include('../database/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Hindari penggunaan md5, gunakan metode enkripsi yang lebih aman

    $sql = "SELECT FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($db,$sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['password'] = $row['password'];
        header("location:dashboard.php"); // Sesuaikan dengan halaman selamat datang
    } else {
        $error = "Username atau Password salah";
        header("location:../error.html");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="../assets/css/bootstrap.css">
<style>
html,
body,
.intro {
  height: 100%;
}

@media (min-width: 550px) and (max-width: 750px) {
  html,
  body,
  .intro {
    height: 550px;
  }
}

@media (min-width: 800px) and (max-width: 850px) {
  html,
  body,
  .intro {
    height: 550px;
  }
}

a.link {
  font-size: .875rem;
  color: #6582B0;
}
a.link:hover, 
a.link:active {
  color: #426193;
}
</style>
<body>
<form action="" method="POST">
<section class="intro">
  <div class="bg-image h-100">
    <div class="mask d-flex align-items-center h-100" style="background-color: #f3f2f2;">
      <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
          <div class="col-12 col-lg-9 col-xl-8">
            <div class="card" style="border-radius: 1rem;">
              <div class="row g-0">
                <div class="col-md-4 d-none d-md-block">
                  <img
                    src="../assets/img/sass.jpeg"
                    alt="login form"
                    class="img-fluid" style="border-top-left-radius: 1rem; border-bottom-left-radius: 1rem;"
                  />
                </div>
                <div class="col-md-8 d-flex align-items-center">
                  <div class="card-body py-5 px-4 p-md-5">

                    <form action="">
                      <h4 class="fw-bold mb-4" style="color: #92aad0;">Log in to your account</h4>
                      <p class="mb-4" style="color: #45526e;">To log in, please fill in these text fiels with your username and password.</p>

                      <div class="form-outline mb-4">
                        <input type="text" name="username" id="username" class="form-control" />
                        <label class="form-label" for="username">Username</label>
                      </div>

                      <div class="form-outline mb-4">
                        <input type="password" name="password" id="password" class="form-control" />
                        <label class="form-label" for="password">Password</label>
                      </div>

                      <div class="d-flex justify-content-end pt-1 mb-4">
                        <button class="btn btn-primary btn-rounded" type="submit" style="background-color: #92aad0;">Log in</button>
                      </div>
                      <hr>
                      <a class="link float-end" href="#!">Forgot password? Click here.</a>
                    </form>
                    <?php if (isset($error)) { ?>
                    <p class="error"><?php echo $error; ?></p>
                    <?php } ?>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</form>
</body>
</html>