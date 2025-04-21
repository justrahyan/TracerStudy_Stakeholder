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
                    <h6 class="text-white mb-0 dashboard-title ">Data Penilaian</h6>
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
                <div class="heading-page d-flex flex-column gap-3 flex-lg-row align-items-start justify-content-between">
                    <div class="searchbar">
                        <div class="position-relative">
                            <div class="position-absolute top-50 start-0 translate-middle-y ps-3 d-flex align-items-center">
                                <svg style="width: 1.2rem; height: 1.2rem;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                </path>
                                </svg>
                            </div>
                            <form action="" method="GET" id="searchForm">
                                <input type="search" name="search" placeholder="Cari" 
                                class="form-control ps-5 py-2 border rounded w-100 w-lg-50 border-dark-subtle" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                            </form>
                        </div>
                    </div>
                    <div class="d-flex flex-row gap-3 align-items-center">
                        <div class="d-flex flex-row align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="-2 -2 24 24"><path fill="#6c757d" d="m2.08 2l6.482 8.101A2 2 0 0 1 9 11.351V18l2-1.5v-5.15a2 2 0 0 1 .438-1.249L17.92 2zm0-2h15.84a2 2 0 0 1 1.561 3.25L13 11.35v5.15a2 2 0 0 1-.8 1.6l-2 1.5A2 2 0 0 1 7 18v-6.65L.519 3.25A2 2 0 0 1 2.08 0"/></svg>
                            <button class="btn border border-secondary d-flex gap-4 align-items-center" data-bs-toggle="modal" data-bs-target="#filterModal">
                                <span>Filter Data</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#6c757d" d="M7.41 8.58L12 13.17l4.59-4.59L18 10l-6 6l-6-6z"/></svg>
                            </button>
                        </div>
                        <button class="btn btn-generate d-flex gap-2 align-items-center" data-bs-toggle="modal" data-bs-target="#generateModal">
                            <span class="text-white">Generate</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="#ffffff" d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/></svg>
                        </button>
                    </div>
                </div>
                <hr>
                <div style="overflow-x: auto;">
                    <table>
                        <tr class="head">
                            <th scope="col">Tanggal</th>
                            <th scope="col" style="max-width: 200px;">Nama Stakeholder</th>
                            <th scope="col">Alumni (Nama + Tahun Lulusan)</th>
                            <th scope="col">Rata-Rata Nilai</th>
                            <th scope="col">Detail Nilai</th>
                            <th scope="col">Harapan</th>
                            <th scope="col">Saran dan Masukan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        <tr class="data rounded">
                            <!-- <td class="d-none user_id"><?php echo $row['user_id'];?></td>
                            <td class="d-none id_task"><?php echo $row['id'];?></td> -->
                            <td scope="col">23/03/2024</td>
                            <td
                            scope="col"
                            class="text-truncate"
                            style="max-width: 200px"
                            >
                                Muhammad Akhsan Awaluddin
                            </td>
                            <td scope="col" class="text-truncate" style="max-width: 200px;">
                                Ival Permana (2026)
                            </td>
                            <td
                            scope="col"
                            class="text-truncate"
                            style="max-width: 200px"
                            >
                                1.2
                            </td>
                            <td
                            scope="col"
                            >
                                <div class="d-flex flex-row align-items-center">
                                    <a 
                                        class="btn btn-detail view-detail p-0" 
                                        data-bs-toggle="modal" data-bs-target="#detailModal"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><g fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M15 12a3 3 0 1 1-6 0a3 3 0 0 1 6 0"/><path d="M2 12c1.6-4.097 5.336-7 10-7s8.4 2.903 10 7c-1.6 4.097-5.336 7-10 7s-8.4-2.903-10-7"/></g></svg>
                                    </a>
                                </div>
                            </td>
                            <td
                            scope="col"
                            >
                                Semoga Lebih Terampil dan Sukses
                            </td>
                            <td
                            scope="col"
                            >
                                Tingkatkan Soft Skill
                            </td>
                            <td
                            scope="col"
                            >
                                <div class="d-flex flex-row gap-2 align-items-center">
                                    <a 
                                        href="#" 
                                        class="btn btn-delete p-0" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal" 
                                        data-task-id="<?php echo $row['id']; ?>"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16m-10 4v6m4-6v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3"/></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Detail Nilai -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Nilai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column gap-2">
                        <label for="pertanyaan1">Pertanyaan 1</label>
                        <input type="text" name="pertanyaan1" value="Kurang Baik" class="form-control" disabled>
                        <label for="pertanyaan2">Pertanyaan 2</label>
                        <input type="text" name="pertanyaan2" value="Kurang Baik" class="form-control" disabled>
                        <label for="pertanyaan3">Pertanyaan 3</label>
                        <input type="text" name="pertanyaan3" value="Kurang Baik" class="form-control" disabled>
                        <label for="pertanyaan4">Pertanyaan 4</label>
                        <input type="text" name="pertanyaan4" value="Kurang Baik" class="form-control" disabled>
                        <label for="pertanyaan5">Pertanyaan 5</label>
                        <input type="text" name="pertanyaan5" value="Cukup" class="form-control" disabled>
                        <label for="pertanyaan6">Pertanyaan 6</label>
                        <input type="text" name="pertanyaan6" value="Kurang Baik" class="form-control" disabled>
                        <label for="pertanyaan7">Pertanyaan 7</label>
                        <input type="text" name="pertanyaan7" value="Baik" class="form-control" disabled>
                        <label for="rata2nilai">Rata-Rata Nilai</label>
                        <input type="text" name="rata2nilai" value="1.2" class="form-control" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Data -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body text-center">

                    <!-- Ikon peringatan -->
                    <div class="warning-icon mx-auto mb-3">
                        <div class="circle outer"></div>
                        <div class="circle middle"></div>
                        <div class="circle inner d-flex justify-content-center align-items-center">
                            <!-- SVG ikon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                            <g fill="none">
                                <circle cx="12" cy="12" r="10" stroke="#FF0137" stroke-width="1.5"/>
                                <path stroke="#FF0137" stroke-linecap="round" stroke-width="1.5" d="M12 7v6"/>
                                <circle cx="12" cy="16" r="1" fill="#FF0137"/>
                            </g>
                            </svg>
                        </div>
                    </div>

                    <!-- Teks konfirmasi -->
                    <h4>Hapus Data</h4>
                    <p class="text-secondary">Apakah anda yakin ingin menghapus data ini?<br>Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <div class="d-flex flex-row w-100 gap-2">
                        <button type="button" class="btn border w-100" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger w-100">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Filter -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="filterModalLabel">Filter Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="filterForm" method="GET" action="">
              <!-- Rentang Tanggal -->
              <div class="mb-3">
                <label for="startDate" class="form-label">Rentang Tanggal</label>
                <div class="d-flex align-items-center gap-2">
                  <input type="date" class="form-control" id="startDate" name="startDate" value="<?php echo htmlspecialchars($startDate); ?>">
                  <span>-</span>
                  <input type="date" class="form-control" id="endDate" name="endDate" value="<?php echo htmlspecialchars($endDate); ?>">
                </div>
              </div>

              <!-- Tahun Lulus -->
              <div class="mb-3">
                <label for="tahun_lulus" class="form-label">Tahun Lulusan</label>
                <input type="text" name="tahun_lulus" class="form-control">
              </div>

              <!-- Tombol filter -->
              <div class="d-flex gap-2">
                  <button type="button" class="btn border w-100" id="resetFilter">Reset Filter</button>
                <button type="submit" class="btn btn-primary w-100">Terapkan Filter</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Generate Laporan -->
    <div class="modal fade" id="generateModal" tabindex="-1" aria-labelledby="generateModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="generateModalLabel">Filter Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="text-secondary mb-2" style="font-size: 12px;">Pilih salah satu!</p>
            <form id="filterForm" method="GET" action="">
              <!-- Rentang Tanggal -->
              <div class="mb-3">
                <label for="startDate" class="form-label">Rentang Tanggal</label>
                <div class="d-flex align-items-center gap-2">
                  <input type="date" class="form-control" id="startDate" name="startDate" value="<?php echo htmlspecialchars($startDate); ?>">
                  <span>-</span>
                  <input type="date" class="form-control" id="endDate" name="endDate" value="<?php echo htmlspecialchars($endDate); ?>">
                </div>
              </div>

              <!-- Pilih Tanggal -->
              <div class="mb-3">
                <label for="tglPenilaian" class="form-label">Pilih Tanggal</label>
                <input type="date" name="tglPenilaian" class="form-control">
              </div>

              <!-- Tombol filter -->
              <div class="d-flex gap-2">
                  <button type="button" class="btn border w-100" id="resetFilter">Reset Filter</button>
                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#formatModal">Lanjut</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Format Laporan -->
    <div class="modal fade" id="formatModal" tabindex="-1" aria-labelledby="formatModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formatModalLabel">Format Generate Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">

                    <!-- Ikon peringatan -->
                    <form id="generate-format">
                        <div class="d-flex justify-content-center gap-3">
                            <label for="format-pdf" class="d-flex align-items-center gap-4">
                                <input type="radio" id="format-pdf" name="format" value="PDF" class="form-check-input mr-0" required>
                                <div class="d-flex align-items-center">
                                    <img src="../assets/img/icon/PDF.png" alt="PDF" class="me-2" style="width: 40px;">
                                    <span>PDF</span>
                                </div>
                            </label>
                            <label for="format-excel" class="d-flex align-items-center gap-4">
                                <input type="radio" id="format-excel" name="format" value="Excel" class="form-check-input mr-0" required>
                                <div class="d-flex align-items-center">
                                    <img src="../assets/img/icon/CSV.png" alt="Excel" class="me-2" style="width: 40px;">
                                    <span>Excel</span>
                                </div>
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary w-100">Generate</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Main JS -->
    <script src="./assets/js/script.js"></script>
</body>
</html>