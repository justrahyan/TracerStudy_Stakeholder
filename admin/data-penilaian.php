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
  $startDateGenerate = $_GET['startDateGenerate'] ?? '';
  $endDateGenerate = $_GET['endDateGenerate'] ?? '';
  $tglPenilaian = $_GET['tglPenilaian'] ?? '';
  $formatGenerate = $_GET['format'] ?? '';
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
                        <h6 class="mb-0 fw-medium text-capitalize"><?= isset($_SESSION['userweb']) ? $_SESSION['userweb'] : 'Admin'; ?></h6>
                        <p class="role mb-0"><?= isset($_SESSION['role']) ? $_SESSION['role'] : 'Admin'; ?></p>
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
                            <form action="" method="GET" id="searchForm" autocomplete="off">
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
                <div style="overflow-x: auto;" class="mb-5 mb-lg-3">
                    <table>
                        <tr class="head">
                            <th scope="col">Tanggal</th>
                            <th scope="col">Nama Stakeholder</th>
                            <th scope="col">Alumni (Nama + Tahun Lulusan)</th>
                            <th scope="col">Rata-Rata Nilai</th>
                            <th scope="col">Detail Nilai</th>
                            <th scope="col">Harapan</th>
                            <th scope="col">Saran dan Masukan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        <?php
                            $search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';
                            $startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
                            $endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';
                            $tahun_lulus = isset($_GET['tahun_lulus']) ? $_GET['tahun_lulus'] : '';

                            // Pagination
                            $per_page = 15;
                            $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $offset = ($current_page - 1) * $per_page;

                            
                            $query = "SELECT * FROM tb_penilaianstakeholder WHERE 1 ORDER BY id DESC";
                            
                            if (!empty($startDate) && !empty($endDate)) {
                                $query .= " AND tanggal BETWEEN '$startDate' AND '$endDate'";
                            }
                            
                            if (!empty($tahun_lulus)) {
                                $query .= " AND tahun_lulus = '$tahun_lulus'";
                            }

                            if (!empty($search)) {
                                $query .= " AND (
                                    nama_stakeholder LIKE '%$search%' OR
                                    nama_alumni LIKE '%$search%'
                                )";
                            }

                            $query_string = http_build_query([
                                'startDate' => $startDate,
                                'endDate' => $endDate,
                                'tahun_lulus' => $tahun_lulus
                            ]);

                            $query .= " LIMIT $per_page OFFSET $offset";
                            $result = mysqli_query($koneksi, $query);
                            
                            $count_query = "SELECT COUNT(*) as total FROM tb_penilaianstakeholder";
                            $count_result = mysqli_query($koneksi, $count_query);
                            $count_row = mysqli_fetch_assoc($count_result);
                            $total_data = $count_row['total'];

                            // Menghitung jumlah halaman
                            $total_pages = ceil($total_data / $per_page);

                            $no = 1;
                            if(mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    $total_nilai = $row['pertanyaan_1'] + $row['pertanyaan_2'] + $row['pertanyaan_3'] + $row['pertanyaan_4'] + $row['pertanyaan_5'] + $row['pertanyaan_6'] + $row['pertanyaan_7'];
                                    $rata_rata = round($total_nilai / 7, 2);
                        ?>
                        <tr class="data rounded">
                            <td class="d-none id"><?php echo $row['id'];?></td>
                            <td scope="col"><?php echo $row['tanggal'] ?></td>
                            <td
                            scope="col"
                            class="text-truncate"
                            >
                                <?php echo $row['nama_stakeholder'] ?>
                            </td>
                            <td scope="col" class="text-truncate">
                                <?php echo $row['nama_alumni'] ?> (<?php echo $row['tahun_lulus'] ?>)
                            </td>
                            <td
                            scope="col"
                            class="text-truncate"
                            style="max-width: 200px"
                            >
                                <?php echo $rata_rata ?>
                            </td>
                            <td
                            scope="col"
                            >
                                <div class="d-flex flex-row align-items-center">
                                    <a href="?detail_id=<?= $row['id'] ?>&<?= $query_string ?>"
                                        class="btn btn-detail view-detail p-0"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><g fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M15 12a3 3 0 1 1-6 0a3 3 0 0 1 6 0"/><path d="M2 12c1.6-4.097 5.336-7 10-7s8.4 2.903 10 7c-1.6 4.097-5.336 7-10 7s-8.4-2.903-10-7"/></g></svg>
                                    </a>
                                </div>
                            </td>
                            <td
                            scope="col"
                            >
                                <?php echo $row['harapan'] ?>
                            </td>
                            <td
                            scope="col"
                            >
                                <?php echo $row['saran_masukan'] ?>
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
                                        data-id="<?php echo $row['id']; ?>"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16m-10 4v6m4-6v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3"/></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php } } else {?>
                        <tr class="data rounded">
                            <td colspan="8" class="text-center">Tidak ada Data Penilaian.</td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
                <!-- Pagination -->
                <nav aria-label="Page navigation" class="d-flex justify-content-center">
                    <ul class="pagination">
                        <?php if($current_page > 1): ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $current_page - 1; ?>">Previous</a></li>
                        <?php else: ?>
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <?php endif; ?>

                        <?php for($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?php echo $i == $current_page ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if($current_page < $total_pages): ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $current_page + 1; ?>">Next</a></li>
                        <?php else: ?>
                            <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </main>

    <!-- Ambil Data Detail Nilai -->
    <?php
    if (isset($_GET['detail_id'])) {
        $id = $_GET['detail_id'];
        $sql_detail = mysqli_query($koneksi, "SELECT * FROM tb_penilaianstakeholder WHERE id = '$id'");
        if ($sql_detail && mysqli_num_rows($sql_detail) > 0) {
            $data_detail = mysqli_fetch_assoc($sql_detail);
            $total_nilai = $data_detail['pertanyaan_1'] + $data_detail['pertanyaan_2'] + $data_detail['pertanyaan_3'] + $data_detail['pertanyaan_4'] + $data_detail['pertanyaan_5'] + $data_detail['pertanyaan_6'] + $data_detail['pertanyaan_7'];
            $rata_rata = round($total_nilai / 7, 2);
            $show_modal = true;
        }
    }
    ?>
    <?php if (isset($show_modal)): ?>
    <script>
        window.addEventListener('load', function () {
            const modal = new bootstrap.Modal(document.getElementById('detailModal'));
            modal.show();
        });
    </script>
    <?php endif; ?>


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
                        <input type="text" name="pertanyaan1" value="<?= $data_detail['pertanyaan_1'] ?>" class="form-control" disabled>
                        <label for="pertanyaan2">Pertanyaan 2</label>
                        <input type="text" name="pertanyaan2" value="<?= $data_detail['pertanyaan_2'] ?>" class="form-control" disabled>
                        <label for="pertanyaan3">Pertanyaan 3</label>
                        <input type="text" name="pertanyaan3" value="<?= $data_detail['pertanyaan_3'] ?>" class="form-control" disabled>
                        <label for="pertanyaan4">Pertanyaan 4</label>
                        <input type="text" name="pertanyaan4" value="<?= $data_detail['pertanyaan_4'] ?>" class="form-control" disabled>
                        <label for="pertanyaan5">Pertanyaan 5</label>
                        <input type="text" name="pertanyaan5" value="<?= $data_detail['pertanyaan_5'] ?>" class="form-control" disabled>
                        <label for="pertanyaan6">Pertanyaan 6</label>
                        <input type="text" name="pertanyaan6" value="<?= $data_detail['pertanyaan_6'] ?>" class="form-control" disabled>
                        <label for="pertanyaan7">Pertanyaan 7</label>
                        <input type="text" name="pertanyaan7" value="<?= $data_detail['pertanyaan_7'] ?>" class="form-control" disabled>
                        <label for="rata2nilai">Rata-Rata Nilai</label>
                        <input type="text" name="rata2nilai" value="<?= $rata_rata ?>" class="form-control" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hapus URL Detail Nilai -->
    <script>
        const modalEl = document.getElementById('detailModal');

        if (modalEl) {
            modalEl.addEventListener('hidden.bs.modal', function () {
                // Hapus parameter dari URL
                const url = new URL(window.location.href);
                url.searchParams.delete('detail_id');
                url.searchParams.delete('startDate');
                url.searchParams.delete('endDate');
                url.searchParams.delete('tahun_lulus');
                window.history.replaceState({}, document.title, url.pathname + url.search);
            });
        }
    </script>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Penanganan Hapus Data -->
    <script>
        let deleteId = null;

        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            deleteId = button.getAttribute('data-id');
        });

        // Tangani klik tombol "Hapus"
        document.querySelector('#deleteModal .btn-danger').addEventListener('click', function () {
            if (deleteId) {
                window.location.href = `proses/hapus-penilaian.php?id=${deleteId}`;
            }
        });
    </script>
    
    <!-- Popup Sukses/Gagal Menghapus Data -->
    <?php if (isset($_GET['hapus'])): ?>
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="hapusToast" class="toast align-items-center text-white <?= $_GET['hapus'] == 'success' ? 'bg-success' : 'bg-danger' ?>" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <?= $_GET['hapus'] == 'success' ? 'Data berhasil dihapus.' : 'Gagal menghapus data.' ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>

        <script>
            const hapusToastEl = document.getElementById('hapusToast');
            const hapusToast = new bootstrap.Toast(hapusToastEl);
            hapusToast.show();

            // Hapus parameter 'hapus' dari URL setelah toast ditampilkan
            setTimeout(function () {
                const url = new URL(window.location);
                url.searchParams.delete('hapus');
                window.history.replaceState({}, '', url);
            }, 1500);
        </script>
    <?php endif; ?>

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
                <label for="" class="form-label">Rentang Tanggal</label>
                <div class="d-flex align-items-center gap-2">
                  <input type="date" class="form-control" id="startDate" name="startDate" value="<?php echo htmlspecialchars($startDate); ?>">
                  <span>-</span>
                  <input type="date" class="form-control" id="endDate" name="endDate" value="<?php echo htmlspecialchars($endDate); ?>">
                </div>
              </div>

              <!-- Tahun Lulus -->
              <div class="mb-3">
                <label for="tahun_lulus" class="form-label">Tahun Lulusan</label>
                <input type="text" name="tahun_lulus" class="form-control" value="<?php echo htmlspecialchars($tahun_lulus); ?>">
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
                <label for="" class="form-label">Rentang Tanggal</label>
                <div class="d-flex align-items-center gap-2">
                  <input type="date" class="form-control" id="startDateGenerate" name="startDateGenerate" value="<?php echo htmlspecialchars($startDateGenerate); ?>">
                  <span>-</span>
                  <input type="date" class="form-control" id="endDateGenerate" name="endDateGenerate" value="<?php echo htmlspecialchars($endDateGenerate); ?>">
                </div>
              </div>

              <!-- Pilih Tanggal -->
              <div class="mb-3">
                <label for="tglPenilaian" class="form-label">Pilih Tanggal</label>
                <input type="date" name="tglPenilaian" class="form-control">
              </div>

              <!-- Tombol filter -->
              <div class="d-flex gap-2">
                <button type="button" class="btn border w-100" id="resetFilterGenerate">Reset Filter</button>
                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#formatModal" data-bs-dismiss="modal">Lanjut</button>
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
                <form id="generate-format" method="post" action="proses/generate-laporan.php">
                    <input type="hidden" name="startDateGenerate" id="startDateGenerateHidden">
                    <input type="hidden" name="endDateGenerate" id="endDateGenerateHidden">
                    <input type="hidden" name="tglPenilaian" id="tglPenilaianHidden">
                    <div class="modal-body text-center">
                        <!-- Ikon peringatan -->
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
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-primary w-100">Generate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <!-- Pengecekan Kondisi Inputan Search Kosong -->
    <script>
            document.getElementById('searchForm').addEventListener('submit', function(e) {
                const input = this.querySelector('input[name="search"]');
                if (input.value.trim() === '') {
                    e.preventDefault(); // batalkan submit default
                    window.location.href = window.location.pathname; // arahkan ulang tanpa ?search
                }
            });
    
            // Fungsi untuk mereset filter
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('resetFilter').addEventListener('click', function() {
                    // Bersihkan nilai dari input filter
                    document.getElementById('startDate').value = '';
                    document.getElementById('endDate').value = '';
                    document.querySelector('input[name="tahun_lulus"]').value = '';
                    
                    window.location.href = window.location.pathname.split('?')[0];
                });
                document.getElementById('resetFilterGenerate').addEventListener('click', function() {
                    // Bersihkan nilai dari input filter
                    document.getElementById('startDateGenerate').value = '';
                    document.getElementById('endDateGenerate').value = '';
                    document.querySelector('input[name="tglPenilaian"]').value = '';
                    
                    window.location.href = window.location.pathname.split('?')[0];
                });

                // Refresh halaman setelah modal format ditutup
                const formatModal = document.getElementById('formatModal');
                formatModal.addEventListener('hidden.bs.modal', function () {
                    // Membersihkan parameter URL
                    const url = new URL(window.location);
                    url.searchParams.delete('status');
                    url.searchParams.delete('message');
                    window.history.replaceState({}, '', url);
                    
                    // Refresh halaman
                    window.location.reload();
                });
            });

            document.getElementById('generateModal').addEventListener('hidden.bs.modal', function () {
                // Salin data dari form filter ke input tersembunyi
                document.getElementById('startDateGenerateHidden').value = document.getElementById('startDateGenerate').value;
                document.getElementById('endDateGenerateHidden').value = document.getElementById('endDateGenerate').value;
                document.getElementById('tglPenilaianHidden').value = document.querySelector('input[name="tglPenilaian"]').value;
            });
        </script>
        
        <!-- Toast Berhasil/Gagal Generate Laporan -->
        <?php if (isset($_GET['status'])): ?>
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToast" class="toast align-items-center text-white <?= $_GET['status'] == 'success' ? 'bg-success' : 'bg-danger' ?>" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <?= $_GET['status'] == 'success' ? $_GET['message'] : $_GET['message'] ?>
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            <script>
                // Menampilkan toast setelah halaman dimuat
                var toastEl = document.getElementById('liveToast');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();

                setTimeout(function () {
                        const url = new URL(window.location);
                        url.searchParams.delete('status');
                        url.searchParams.delete('message');
                        window.history.replaceState({}, '', url);
                }, 1500);
            </script>
        <?php endif; ?>


    <!-- Main JS -->
    <script src="./assets/js/script.js"></script>
</body>
</html>