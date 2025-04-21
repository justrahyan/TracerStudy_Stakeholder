<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<aside id="sidebar">
    <div class="container">
        <div class="logo mb-4 d-flex align-items-center justify-content-between">
            <a href="index.php">
                <img src="../assets/img/Logo-PPSUNM.png" alt="Logo">
            </a>
            <button id="close-btn" class="btn-close-sidebar d-lg-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                    <path fill="#666666" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z"/>
                </svg>
            </button>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-nav">
                <li class="sidebar-item rounded <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
                    <a href="index.php" class="text-<?php echo ($current_page == 'index.php') ? 'dark' : 'secondary'; ?> text-decoration-none fw-medium w-100 py-2 px-3 d-flex align-items-center gap-2">
                        <img src="../assets/img/icon/home-<?php echo ($current_page == 'index.php') ? 'primary' : 'secondary'; ?>.png" alt="Dashboard">
                        Dashboard
                    </a>
                </li>
                <li class="sidebar-item rounded <?php echo ($current_page == 'data-stakeholder.php') ? 'active' : ''; ?>">
                    <a href="data-stakeholder.php" class="text-<?php echo ($current_page == 'data-stakeholder.php') ? 'dark' : 'secondary'; ?> text-decoration-none fw-medium w-100 py-2 px-3 d-flex align-items-center gap-2">
                        <img src="../assets/img/icon/users-<?php echo ($current_page == 'data-stakeholder.php') ? 'primary' : 'secondary'; ?>.png" alt="Data Stakeholder">
                        Data Stakeholder
                    </a>
                </li>
                <li class="sidebar-item rounded <?php echo ($current_page == 'data-penilaian.php') ? 'active' : ''; ?>">
                    <a href="data-penilaian.php" class="text-<?php echo ($current_page == 'data-penilaian.php') ? 'dark' : 'secondary'; ?> text-decoration-none fw-medium w-100 py-2 px-3 d-flex align-items-center gap-2">
                        <img src="../assets/img/icon/file-<?php echo ($current_page == 'data-penilaian.php') ? 'primary' : 'secondary'; ?>.png" alt="Data Penilaian">
                        Data Penilaian
                    </a>
                </li>
            </ul>
            <ul class="sidebar-nav logout-nav">
                <li class="sidebar-item rounded">
                    <a data-bs-toggle="modal" data-bs-target="#logoutModal" class="text-secondary text-decoration-none fw-medium w-100 py-2 px-3 d-flex align-items-center gap-2">
                        <img src="../assets/img/icon/log-out.png" alt="Data Penilaian">
                        Keluar
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>

<!-- Modal Logout -->
<!-- Modal Logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body text-center">

                <!-- Ikon peringatan -->
                <div class="logout-icon mx-auto mb-3">
                    <div class="circle outer"></div>
                    <div class="circle middle"></div>
                    <div class="circle inner d-flex justify-content-center align-items-center">
                        <!-- SVG ikon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                            <path fill="none" stroke="#01639A" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12h-9.5m7.5 3l3-3l-3-3m-5-2V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h5a2 2 0 0 0 2-2v-1"/>
                        </svg>
                    </div>
                </div>

                <!-- Teks konfirmasi -->
                <h4>Keluar dari Akun</h4>
                <p class="text-secondary">Apakah kamu yakin ingin keluar? Semua sesi akan diakhiri <br> dan kamu harus login kembali untuk mengakses akun.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <div class="d-flex flex-row w-100 gap-2">
                    <button type="button" class="btn border w-100" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary w-100" onclick="window.location.href='../logout.php'">Keluar</button>
                </div>
            </div>
        </div>
    </div>
</div>
