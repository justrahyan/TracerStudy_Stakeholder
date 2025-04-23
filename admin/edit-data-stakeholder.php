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

  if (isset($_GET['nama_pengisi'])) {
        $nama_pengisi = $_GET['nama_pengisi'];
        $query = mysqli_query($koneksi, "SELECT * FROM tb_datastakeholder WHERE nama_pengisi = '$nama_pengisi'");
        $row = mysqli_fetch_assoc($query);

        // Hitung total penilaian
        $queryTotal = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_penilaianstakeholder WHERE nama_stakeholder = '$nama_pengisi'");
        $dataTotal = mysqli_fetch_assoc($queryTotal);
        $total_penilaian = $dataTotal['total'];
    } else {
        header("Location: data-stakeholder.php");
        exit();
    }
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
    <link rel="stylesheet" type="text/css" href="./assets/css/stakeholder-style.css">
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
                    <h6 class="text-white mb-0 dashboard-title ">Data Stakeholder</h6>
                </div>
                <div class="d-flex flex-row align-items-center gap-2">
                    <div class="d-flex flex-column align-items-end text-white user-info">
                        <h6 class="mb-0 fw-medium">Admin</h6>
                        <p class="role mb-0">Admin</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="d-none d-md-block" width="40" height="40" viewBox="0 0 24 24"><path fill="#ffffff" d="M12 3a9 9 0 0 0-9 9a8.96 8.96 0 0 0 1.773 5.365A5 5 0 0 1 9.5 14h5a5 5 0 0 1 4.727 3.365A8.96 8.96 0 0 0 21 12a9 9 0 0 0-9-9m5.5 16.125V19a3 3 0 0 0-3-3h-5a3 3 0 0 0-3 3v.125A8.96 8.96 0 0 0 12 21c2.072 0 3.979-.7 5.5-1.875M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11a10.98 10.98 0 0 1-3.85 8.36A10.96 10.96 0 0 1 12 23a10.96 10.96 0 0 1-7.15-2.64A10.98 10.98 0 0 1 1 12m11-6a2.5 2.5 0 1 0 0 5a2.5 2.5 0 0 0 0-5M7.5 8.5a4.5 4.5 0 1 1 9 0a4.5 4.5 0 0 1-9 0"/></svg>
                </div>
            </header>
            <div class="main-content">
                <div class="heading-page d-flex flex-row align-items-center justify-content-between">
                    <h5 class="fw-bold mb-0">Edit Data Stakeholder</h5>
                    <a href="data-stakeholder.php" class="text-decoration-none text-secondary d-flex justify-content-end align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#6c757d" d="m14 18l-6-6l6-6l1.4 1.4l-4.6 4.6l4.6 4.6z"/></svg>
                        <span>Kembali</span>
                    </a>
                </div>
                <hr>
                <form action="proses/edit-stakeholder.php" method="POST">
                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                    <label for="nama" class="fw-medium mb-1">Nama Stakeholder</label>
                    <input type="text" id="nama" name="nama" class="form-control w-100 mb-2" value="<?= $row['nama_pengisi'];?>" required>

                    <label for="perusahaan" class="fw-medium mb-1">Nama Perusahaan/Institusi</label>
                    <input type="text" id="perusahaan" name="perusahaan" class="form-control w-100 mb-2" value="<?= $row['perusahaan'];?>" required>

                    <label for="jabatan" class="fw-medium mb-1">Jabatan</label>
                    <input type="text" id="jabatan" name="jabatan" class="form-control w-100 mb-2" value="<?= $row['jabatan'];?>" required>

                    <label for="email" class="fw-medium mb-1">Email</label>
                    <input type="text" id="email" name="email" class="form-control w-100 mb-2" value="<?= $row['email'];?>" required>

                    <label for="no_hp" class="fw-medium mb-1">No Handphone</label>
                    <input type="text" id="no_hp" name="no_hp" class="form-control w-100 mb-2" value="<?= $row['no_hp'];?>" required>

                    <label for="total_penilaian" class="fw-medium mb-1">Total Penilaian</label>
                    <input type="text" id="total_penilaian" name="total_penilaian" class="form-control w-100 mb-2" value="<?= $total_penilaian ?>" disabled>

                    <div class="button-group d-flex flex-column flex-md-row gap-2 gap-md-4 mt-4">
                        <button type="reset" class="bg-white text-dark w-100 p-2 rounded btn border">Batal</button>
                        <button type="submit" class="bg-primary text-white w-100 p-2 rounded btn border-0">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Main JS -->
    <script src="./assets/js/script.js"></script>
</body>
</html>