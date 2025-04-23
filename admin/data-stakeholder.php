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
                    <h6 class="text-white mb-0 dashboard-title">Data Stakeholder</h6>
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
                </div>
                <hr>
                <div style="overflow-x: auto;" class="mb-5 mb-lg-3">
                    <table>
                        <tr class="head">
                            <th scope="col">No</th>
                            <th scope="col" style="max-width: 200px;">Nama Stakeholder</th>
                            <th scope="col">Nama Perusahaan/Institusi</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Email</th>
                            <th scope="col">No Handphone</th>
                            <th scope="col">Total Penilaian</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        
                        <?php
                            $search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';

                            // Pagination
                            $per_page = 15;
                            $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $offset = ($current_page - 1) * $per_page;

                            $query = "SELECT 
                                        ds.id,
                                        ds.nama_pengisi,
                                        ds.perusahaan,
                                        ds.jabatan,
                                        ds.email,
                                        ds.no_hp,
                                        (
                                            SELECT COUNT(*) 
                                            FROM tb_penilaianstakeholder p 
                                            WHERE p.nama_stakeholder = ds.nama_pengisi
                                        ) AS total_penilaian 
                                    FROM 
                                        tb_datastakeholder ds 
                                    WHERE 1";
                            
                            if (!empty($search)) {
                                $query .= " AND (
                                    ds.nama_pengisi LIKE '%$search%' OR
                                    ds.perusahaan LIKE '%$search%' OR
                                    ds.jabatan LIKE '%$search%' OR
                                    ds.email LIKE '%$search%'
                                )";
                            }
                            
                            $query .= " GROUP BY ds.email ORDER BY ds.id DESC LIMIT $per_page OFFSET $offset";
                            $result = mysqli_query($koneksi, $query);                            
                            
                            $count_query = "SELECT COUNT(*) as total FROM tb_datastakeholder";
                            $count_result = mysqli_query($koneksi, $count_query);
                            $count_row = mysqli_fetch_assoc($count_result);
                            $total_data = $count_row['total'];

                            // Menghitung jumlah halaman
                            $total_pages = ceil($total_data / $per_page);

                            $no = 1;
                            if(mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr class="data rounded">
                            <td class="d-none id_task"><?php echo $row['id'];?></td>
                            <td scope="col"><?php echo $no++ ?></td>
                            <td
                            scope="col"
                            class="text-truncate"
                            style="max-width: 200px"
                            >
                                <?php echo $row['nama_pengisi'] ?>
                            </td>
                            <td scope="col" class="text-truncate" style="max-width: 200px;">
                                <?php echo $row['perusahaan'] ?>
                            </td>
                            <td
                            scope="col"
                            class="text-truncate"
                            style="max-width: 200px"
                            >
                                <?php echo $row['jabatan'] ?>
                            </td>
                            <td
                            scope="col"
                            >
                                <?php echo $row['email'] ?>
                            </td>
                            <td
                            scope="col"
                            >
                                <?php echo $row['no_hp'] ?>
                            </td>
                            <td
                            scope="col"
                            >
                                <?php echo $row['total_penilaian'] ?>
                            </td>
                            <td
                            scope="col"
                            >
                                <div class="d-flex flex-row gap-2 align-items-center">
                                    <a 
                                        class="btn btn-detail view-detail p-0" 
                                        aria-label="View Details" href="edit-data-stakeholder.php?nama_pengisi=<?php echo $row['nama_pengisi']; ?>"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><g fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1"/><path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3zM16 5l3 3"/></g></svg>
                                    </a>
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
                            <td colspan="8" class="text-center">Tidak ada Data Stakeholder.</td>
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

    <!-- Popup Sukses/Gagal Mengubah Data -->
    <?php if (isset($_GET['status'])): ?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast align-items-center text-white <?= $_GET['status'] == 'success' ? 'bg-success' : 'bg-danger' ?>" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?= $_GET['status'] == 'success' ? 'Data berhasil diubah.' : 'Gagal mengubah data.' ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    
    <script>
        const toastLive = document.getElementById('liveToast');
        const toast = new bootstrap.Toast(toastLive);
        toast.show();

        // Hapus parameter 'toast' dari URL setelah toast ditampilkan
        setTimeout(function () {
                const url = new URL(window.location);
                url.searchParams.delete('toast');
                window.history.replaceState({}, '', url);
        }, 1500);
    </script>
    <?php endif; ?>

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
                window.location.href = `proses/hapus-stakeholder.php?id=${deleteId}`;
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

    <!-- Pengecekan Kondisi Inputan Search Kosong -->
    <script>
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            const input = this.querySelector('input[name="search"]');
            if (input.value.trim() === '') {
                e.preventDefault(); // batalkan submit default
                window.location.href = window.location.pathname; // arahkan ulang tanpa ?search
            }
        });
    </script>

    <!-- Main JS -->
    <script src="./assets/js/script.js"></script>
</body>
</html>