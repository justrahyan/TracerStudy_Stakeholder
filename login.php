<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>Tracer Study Stakeholder - S2 PEP</title>
    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="assets/img/favicon_io/site.webmanifest">
</head>

<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="container">
      <img src="assets/img/Logo-PPSUNM.png" alt="" class="mx-auto d-block w-md-50 mb-3">
      <div class="box bg-white mx-auto border p-4 rounded-3">
        <a href="index.php" class="text-decoration-none text-secondary d-flex justify-content-end align-items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#6c757d" d="m14 18l-6-6l6-6l1.4 1.4l-4.6 4.6l4.6 4.6z"/></svg>
          <span>Kembali</span>
        </a>
        <form action="login.php" method="post" class="d-flex flex-column">
          <label for="username">Username <span class="text-danger">*</span></label>
          <input type="text" name="username" id="username" autofocus class="w-100" required>
          <label for="password">Password <span class="text-danger">*</span></label>
          <input type="password" name="password" class="w-100 mb-4" required>
          <input type="submit" name="masuk" value="Login" class="w-100 btn-login text-white">
        </form>
      </div>
    </div>

    <?php
    if (isset($_POST['masuk'])) {
        session_start();
        include './koneksi.php';

        $username = $_POST['username'];
        $password = $_POST['password'];

        $cekuser = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE username = '$username' AND password = '$password'");
        $level = mysqli_num_rows($cekuser);
        if ($level > 0) {
            $ambildatarole = mysqli_fetch_array($cekuser);
            $role = $ambildatarole['role'];

            if ($role == 'admin') {
                $_SESSION['userweb'] = $username;
                $_SESSION['role'] = 'admin';
                $_SESSION['id_user'] = $user['id'];
                header("location:admin/index.php");
            }
        } else {
            echo "<script>alert('username atau password Anda salah. Silahkan coba lagi!')</script>";
        }
    }
    ?>
</body>
</html>