<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<aside id="sidebar">
        <div class="container">
            <div class="logo mb-4 d-flex align-items-center justify-content-between">
                <a href="index.php">
                    <img src="../assets/img/Logo-PPSUNM.png" alt="Logo">
                </a>
                <button id="close-btn" class="btn-close-sidebar d-md-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                        <path fill="#666666" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z"/>
                    </svg>
                </button>
            </div>
            <div class="sidebar-content">
                <ul class="sidebar-nav">
                    <li class="sidebar-item w-100 p-2 rounded <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
                        <a href="index.php" class="text-<?php echo ($current_page == 'index.php') ? 'dark' : 'secondary'; ?> text-decoration-none fw-medium">
                            <img src="../assets/img/icon/home-<?php echo ($current_page == 'index.php') ? 'primary' : 'secondary'; ?>.png" alt="Dashboard">
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item w-100 p-2 rounded <?php echo ($current_page == 'data-stakeholder.php') ? 'active' : ''; ?>">
                        <a href="data-stakeholder.php" class="text-<?php echo ($current_page == 'data-stakeholder.php') ? 'dark' : 'secondary'; ?> text-decoration-none fw-medium">
                            <img src="../assets/img/icon/users-<?php echo ($current_page == 'data-stakeholder.php') ? 'primary' : 'secondary'; ?>.png" alt="Data Stakeholder">
                            Data Stakeholder
                        </a>
                    </li>
                    <li class="sidebar-item w-100 p-2 rounded <?php echo ($current_page == 'data-penilaian.php') ? 'active' : ''; ?>">
                        <a href="data-penilaian.php" class="text-<?php echo ($current_page == 'data-penilaian.php') ? 'dark' : 'secondary'; ?> text-decoration-none fw-medium">
                            <img src="../assets/img/icon/file-<?php echo ($current_page == 'data-penilaian.php') ? 'primary' : 'secondary'; ?>.png" alt="Data Penilaian">
                            Data Penilaian
                        </a>
                    </li>
                </ul>
                <ul class="sidebar-nav logout-nav">
                    <li class="sidebar-item w-100 p-2 rounded">
                        <a href="../logout.php" class="text-secondary text-decoration-none fw-medium">
                            <img src="../assets/img/icon/log-out.png" alt="Data Penilaian">
                            Keluar
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </aside>