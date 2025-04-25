<?php
  session_start();
  ob_start();
  if (isset($_SESSION['userweb'])) {
      include '../koneksi.php';

      // Ambil id_user dari session
      $id_user = $_SESSION['id_user'];
  } else {
      header("location:../login.php");
      exit();
  }

    // Hitung jumlah data di tb_datastakeholder
    $queryStakeholder = mysqli_query($koneksi, "SELECT COUNT(DISTINCT nama_pengisi) as total FROM tb_datastakeholder");
    $dataStakeholder = mysqli_fetch_assoc($queryStakeholder);
    $countStakeholder = $dataStakeholder['total'];

    // Hitung jumlah data di tb_penilaianstakeholder
    $queryPenilaian = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_penilaianstakeholder");
    $dataPenilaian = mysqli_fetch_assoc($queryPenilaian);
    $countPenilaian = $dataPenilaian['total'];

?>
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
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/sidebar.css">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="../assets/img/favicon_io/site.webmanifest">
</head>

<body>
    <?php
        include('partials/sidebar.php');
    ?>

    <!-- Hamburger Button -->

    <main>
        <div class="main-container">
            <header class="d-flex align-items-center justify-content-between px-4">
                <div class="d-flex align-items-center flex-row gap-3">
                    <div class="hamburger" id="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <h6 class="text-white mb-0 dashboard-title ">Dashboard</h6>
                </div>
                <div class="d-flex flex-row align-items-center gap-2">
                    <div class="d-flex flex-column align-items-end text-white user-info">
                        <h6 class="mb-0 fw-medium text-capitalize"><?= isset($_SESSION['userweb']) ? $_SESSION['userweb'] : 'Admin'; ?></h6>
                        <p class="role mb-0"><?= isset($_SESSION['role']) ? $_SESSION['role'] : 'Admin'; ?></p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="d-none d-md-block" width="40" height="40" viewBox="0 0 24 24"><path fill="#ffffff" d="M12 3a9 9 0 0 0-9 9a8.96 8.96 0 0 0 1.773 5.365A5 5 0 0 1 9.5 14h5a5 5 0 0 1 4.727 3.365A8.96 8.96 0 0 0 21 12a9 9 0 0 0-9-9m5.5 16.125V19a3 3 0 0 0-3-3h-5a3 3 0 0 0-3 3v.125A8.96 8.96 0 0 0 12 21c2.072 0 3.979-.7 5.5-1.875M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11a10.98 10.98 0 0 1-3.85 8.36A10.96 10.96 0 0 1 12 23a10.96 10.96 0 0 1-7.15-2.64A10.98 10.98 0 0 1 1 12m11-6a2.5 2.5 0 1 0 0 5a2.5 2.5 0 0 0 0-5M7.5 8.5a4.5 4.5 0 1 1 9 0a4.5 4.5 0 0 1-9 0"/></svg>
                </div>
            </header>
            <div class="main-content d-flex">
                <a href="data-stakeholder.php" class="card d-flex flex-row justify-content-between align-items-center p-4">
                    <div class="info">
                        <div class="title">
                            <p>STAKEHOLDER</p>
                        </div>
                        <div class="count">
                            <h1 class="fw-bold"><?= $countStakeholder ?></h1>
                        </div>
                    </div>
                    <div class="icon">
                        <img src="../assets/img/icon/users-primary.png" alt="">
                    </div>
                </a>
                <a href="data-penilaian.php" class="card d-flex flex-row justify-content-between align-items-center p-4">
                    <div class="info">
                        <div class="title">
                            <p>PENILAIAN</p>
                        </div>
                        <div class="count">
                            <h1 class="fw-bold"><?= $countPenilaian ?></h1>
                        </div>
                    </div>
                    <div class="icon">
                        <img src="../assets/img/icon/file-primary.png" alt="">
                    </div>
                </a>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Main JS -->
    <script src="./assets/js/script.js"></script>
</body>
</html>