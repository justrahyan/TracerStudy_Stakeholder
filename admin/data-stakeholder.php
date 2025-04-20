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
                    <div class="w-25 w-lg-auto">
                        <div class="position-relative">
                            <div class="position-absolute top-50 start-0 translate-middle-y ps-3 d-flex align-items-center">
                                <svg style="width: 1.2rem; height: 1.2rem;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                </path>
                                </svg>
                            </div>
                            <form action="" method="GET" id="searchForm">
                                <input type="search" name="search" placeholder="Cari nama tugas" 
                                class="form-control ps-5 py-2 border rounded w-100 w-lg-50" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                            </form>
                        </div>
                    </div>
                </div>
                <hr>
                <table>
                    <tr class="head">
                        <th scope="col">No</th>
                        <th scope="col" style="max-width: 200px;">Nama Stakeholder</th>
                        <th scope="col">Nama Perusahaan/Institusi</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Email</th>
                        <th scope="col">No Handphone</th>
                        <th scope="col">Total Penilaian</th>
                    </tr>
                    <?php
                        $no = 1;
                        // Filtering
                        $search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';

                        // Mulai query dasar
                        $query = "SELECT * FROM tb_datastakeholder";

                        $sql = mysqli_query($koneksi, $query);
                        if(mysqli_num_rows($sql) > 0){
                            while ($row = mysqli_fetch_assoc($sql)) {
                            if($row['status'] == 1){
                            $status = "Belum Dikerja";
                            }elseif($row['status'] == 2){
                                $status = "Sedang Dikerja";
                            } elseif($row['status'] == 3){
                                $status = "Selesai";
                            } else {
                            $status = null;
                            }
                    ?>
                    <tr class="data rounded">
                        <td class="d-none user_id"><?php echo $row['user_id'];?></td>
                        <td class="d-none id_task"><?php echo $row['id'];?></td>
                        <td scope="col"><?php echo $no++ ?></td>
                        <td
                        scope="col"
                        class="text-truncate"
                        style="max-width: 200px"
                        >
                            <?php echo $row['task_name'] ?>
                        </td>
                        <td scope="col" style="max-width: 30px;">
                            
                        </td>
                        <td
                        scope="col"
                        class="text-truncate"
                        style="max-width: 200px"
                        >
                            <?php echo $row['description'] ?>
                        </td>
                        <td
                        scope="col"
                        >
                            <?php echo $status ?>
                        </td>
                        <td
                        scope="col"
                        >
                            <?php echo $row['name'] ?>
                        </td>
                        <td
                        scope="col"
                        >
                            <?php echo $row['deadline'] ?>
                        </td>
                    </tr>
                <?php 
                    }
                } else { 
                ?>
                <tr class="data rounded">
                    <td colspan="8" class="text-center">Tidak ada Data.</td>
                </tr>
                <?php } ?>
                </table>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Main JS -->
    <script src="./assets/js/script.js"></script>
</body>
</html>