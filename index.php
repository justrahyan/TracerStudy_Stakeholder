<?php
// Koneksi ke database
include "koneksi.php";

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debug: tampilkan semua data POST
    echo "<pre>POST Data: ";
    print_r($_POST);
    echo "</pre>";
    
    // Ambil data
    $nama_pengisi = mysqli_real_escape_string($koneksi, $_POST['nama_pengisi'] ?? '');
    $perusahaan = mysqli_real_escape_string($koneksi, $_POST['perusahaan'] ?? '');
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan'] ?? '');
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp'] ?? '');
    $email = mysqli_real_escape_string($koneksi, $_POST['email'] ?? '');
    $nama_alumni = mysqli_real_escape_string($koneksi, $_POST['nama_lulusan'] ?? '');
    $tahun_lulus = mysqli_real_escape_string($koneksi, $_POST['tahun_lulus'] ?? '');
    
    // Ambil nilai radio button dengan default value jika tidak dipilih
    $pertanyaan_1 = mysqli_real_escape_string($koneksi, $_POST['penilaian1'] ?? 'Tidak diisi');
    $pertanyaan_2 = mysqli_real_escape_string($koneksi, $_POST['penilaian2'] ?? 'Tidak diisi');
    $pertanyaan_3 = mysqli_real_escape_string($koneksi, $_POST['penilaian3'] ?? 'Tidak diisi');
    $pertanyaan_4 = mysqli_real_escape_string($koneksi, $_POST['penilaian4'] ?? 'Tidak diisi');
    $pertanyaan_5 = mysqli_real_escape_string($koneksi, $_POST['penilaian5'] ?? 'Tidak diisi');
    $pertanyaan_6 = mysqli_real_escape_string($koneksi, $_POST['penilaian6'] ?? 'Tidak diisi');
    $pertanyaan_7 = mysqli_real_escape_string($koneksi, $_POST['penilaian7'] ?? 'Tidak diisi');
    
    $harapan = mysqli_real_escape_string($koneksi, $_POST['harapan'] ?? '');
    $saran = mysqli_real_escape_string($koneksi, $_POST['saran_masukan'] ?? '');
    $tanggal = date("Y-m-d");

    // Validasi
    if(empty($email) || empty($nama_pengisi)) {
        die("<script>alert('Email dan Nama Pengisi harus diisi!'); window.history.back();</script>");
    }

    // Query 1
    $query1 = "INSERT INTO tb_datastakeholder 
              (nama_pengisi, perusahaan, jabatan, email, no_hp) 
              VALUES 
              ('$nama_pengisi', '$perusahaan', '$jabatan', '$email', '$no_hp')";
    
    // Query 2
    $query2 = "INSERT INTO tb_penilaianstakeholder 
              (tanggal, nama_stakeholder, nama_alumni, tahun_lulus, 
               pertanyaan_1, pertanyaan_2, pertanyaan_3, pertanyaan_4, 
               pertanyaan_5, pertanyaan_6, pertanyaan_7, 
               harapan, saran_masukan) 
              VALUES 
              ('$tanggal', '$nama_pengisi', '$nama_alumni', '$tahun_lulus', 
               '$pertanyaan_1', '$pertanyaan_2', '$pertanyaan_3', '$pertanyaan_4', 
               '$pertanyaan_5', '$pertanyaan_6', '$pertanyaan_7',
               '$harapan', '$saran')";

    // Eksekusi query
    $result1 = mysqli_query($koneksi, $query1);
    $result2 = mysqli_query($koneksi, $query2);

    if ($result1 && $result2) {
        header("Location: index.php?status=success&message=Data%20berhasil%20disimpan");
        exit();
    } else {
        $errorMsg = urlencode("Gagal menyimpan data. " . mysqli_error($koneksi));
        header("Location: index.php?status=error&message=$errorMsg");
        exit();
    }
}

mysqli_close($koneksi);
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
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
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

<body>
    <header>
        <div class="box-container py-3 py-lg-4">
            <nav class="navbar navbar-expand-md">
                <div class="container-fluid p-0">
                    <!-- Brand -->
                    <div class="navbar-brand d-flex align-items-center gap-3">
                        <img src="assets/img/logo-unm-putih.png" alt="Logo UNM" height="50px">
                        <p class="text-white mb-0 fw-medium">
                            TRACER STUDY STAKEHOLDER<br>PROGRAM STUDI S2 PEP
                        </p>
                    </div>
                    

                    <!-- Hamburger Offcanvas Toggle -->
                    <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Offcanvas Menu -->
                    <div class="offcanvas offcanvas-end offcanvas-half text-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                            <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav ms-auto">
                                <a href="login.php" class="ms-auto text-white text-decoration-none d-none d-md-block">Login</a>
                                <li class="nav-item d-md-none">
                                    <a href="login.php" class="nav-link text-dark">Login</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="text-center text-white pt-2 pt-md-0">
                <h1 class="fw-bold">Tracer Study</h1>
                <p>Stakeholder Program Studi S2 Penelitian dan Evaluasi Pendidikan<br>Universitas Negeri Makassar</p>
            </div>
        </div>
    </header>
    <form action="index.php" method="post">
        <!-- Forum Survey Kepuasan -->
        <div class="box-container forum-survey bg-white p-4 p-lg-5 rounded-3 mb-5">
            <div>
                <h3 class="text-dark text-center fw-bold mb-4">Forum Survey Kepuasan Pengguna Lulusan S2 PEP UNM</h3>
                <hr class="mb-0">
                <div class="d-flex align-items-center justify-content-between px-0 my-2">
                    <label for="nama_pengisi">Nama Pengisi</label>
                    <input type="text" name="nama_pengisi" id="nama_pengisi" class="form-control w-75" required>
                </div>
                <hr class="mb-0">
                <div class="d-flex align-items-center justify-content-between px-0 my-2">
                    <label for="perusahaan">Nama Perusahaan/Lembaga/Institusi</label>
                    <input type="text" name="perusahaan" id="perusahaan" class="form-control w-75" required>
                </div>
                <hr class="mb-0">
                <div class="d-flex align-items-center justify-content-between px-0 my-2">
                    <label for="jabatan">Posisi Jabatan</label>
                    <input type="text" name="jabatan" id="jabatan" class="form-control w-75" required>
                </div>
                <hr class="mb-0">
                <div class="d-flex align-items-center justify-content-between px-0 my-2">
                    <label for="no_hp">No Handphone</label>
                    <input type="text" name="no_hp" id="no_hp" class="form-control w-75" required>
                </div>
                <hr class="mb-0">
                <div class="d-flex align-items-center justify-content-between px-0 my-2">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control w-75" required>
                </div>
                <hr class="mb-0">
                <div class="d-flex align-items-center justify-content-between px-0 my-2">
                    <label for="nama_lulusan">Nama Lulusan yang akan Dinilai</label>
                    <input type="text" name="nama_lulusan" id="nama_lulusan" class="form-control w-75" required>
                </div>
                <hr class="mb-0">
                <div class="d-flex align-items-center justify-content-between px-0 my-2">
                    <label for="tahun_lulus">Tahun Lulus Alumni</label>
                    <input type="text" name="tahun_lulus" id="tahun_lulus" class="form-control w-75" required>
                </div>
                <hr class="mb-0">
            </div>
        </div>
        <!-- Instrumen Penilaian -->
        <div class="box-container forum-survey bg-white p-4 p-lg-5 rounded-3 my-5">
            <!-- Pertanyaan -->
            <div>
                <h3 class="text-dark text-center fw-bold mb-4">Instrumen Penilaian Pengguna Lulusan</h3>
                <hr class="mb-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 5%;">No</th>
                            <th scope="col" style="width: 40%;">Pertanyaan</th>
                            <th scope="col" style="width: 45%;" class="text-center">Jawaban</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row" style="width: 5%;" class="text-secondary">1</td>
                            <td style="width: 40%;" class="text-secondary">Bagaimana Etika berperilaku alumni Pendidikan Teknik Elektro pada saat bekerja pada perusahaan bapak/ibu?</td>
                            <td style="width: 45%;">
                                <div class="d-flex flex-column flex-lg-row justify-content-center gap-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian1" id="sangatBaik1" value="4">
                                        <label class="form-check-label fw-medium" for="sangatBaik1">Sangat Baik</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian1" id="baik1" value="3">
                                        <label class="form-check-label fw-medium" for="baik1">Baik</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian1" id="cukup1" value="2">
                                        <label class="form-check-label fw-medium" for="cukup1">Cukup</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian1" id="kurang1" value="1">
                                        <label class="form-check-label fw-medium" for="kurang1">Kurang</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" style="width: 5%;" class="text-secondary">2</td>
                            <td style="width: 40%;" class="text-secondary">Bagaimana Kinerja alumni Pendidikan Teknik Elektro pada saat bekerja pada perusahaan bapak/ibu, terkai dengan kompetensi yang dimiliki?</td>
                            <td style="width: 45%;">
                                <div class="d-flex flex-column flex-lg-row justify-content-center gap-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian2" id="sangatBaik2" value="4">
                                        <label class="form-check-label fw-medium" for="sangatBaik2">Sangat Baik</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian2" id="baik2" value="3">
                                        <label class="form-check-label fw-medium" for="baik2">Baik</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian2" id="cukup2" value="2">
                                        <label class="form-check-label fw-medium" for="cukup2">Cukup</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian2" id="kurang2" value="1">
                                        <label class="form-check-label fw-medium" for="kurang2">Kurang</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" style="width: 5%;" class="text-secondary">3</td>
                            <td style="width: 40%;" class="text-secondary">Bagaimana Kemampuan bekerja dalam tim alumni Pendidikan Teknik Elektro pada saat bekerja pada perusahaan bapak/ibu?</td>
                            <td style="width: 45%;">
                                <div class="d-flex flex-column flex-lg-row justify-content-center gap-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian3" id="sangatBaik3" value="4">
                                        <label class="form-check-label fw-medium" for="sangatBaik3">Sangat Baik</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian3" id="baik3" value="3">
                                        <label class="form-check-label fw-medium" for="baik3">Baik</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian3" id="cukup3" value="2">
                                        <label class="form-check-label fw-medium" for="cukup3">Cukup</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian3" id="kurang3" value="1">
                                        <label class="form-check-label fw-medium" for="kurang3">Kurang</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" style="width: 5%;" class="text-secondary">4</td>
                            <td style="width: 40%;" class="text-secondary">Bagaimana Kemampuan berkomunikasi alumni Pendidikan Teknik Elektro pada saat bekerja pada perusahaan bapak/ibu?</td>
                            <td style="width: 45%;">
                                <div class="d-flex flex-column flex-lg-row justify-content-center gap-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian4" id="sangatBaik4" value="4">
                                        <label class="form-check-label fw-medium" for="sangatBaik4">Sangat Baik</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian4" id="baik4" value="3">
                                        <label class="form-check-label fw-medium" for="baik4">Baik</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian4" id="cukup4" value="2">
                                        <label class="form-check-label fw-medium" for="cukup4">Cukup</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian4" id="kurang4" value="1">
                                        <label class="form-check-label fw-medium" for="kurang4">Kurang</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" style="width: 5%;" class="text-secondary">5</td>
                            <td style="width: 40%;" class="text-secondary">Bagaimana Kemampuan berbahasa Inggris alumni Pendidikan Teknik Elektro pada saat bekerja pada perusahaan bapak/ibu?</td>
                            <td style="width: 45%;">
                                <div class="d-flex flex-column flex-lg-row justify-content-center gap-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian5" id="sangatBaik5" value="4">
                                        <label class="form-check-label fw-medium" for="sangatBaik5">Sangat Baik</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian5" id="baik5" value="3">
                                        <label class="form-check-label fw-medium" for="baik5">Baik</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian5" id="cukup5" value="2">
                                        <label class="form-check-label fw-medium" for="cukup5">Cukup</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian5" id="kurang5" value="1">
                                        <label class="form-check-label fw-medium" for="kurang5">Kurang</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" style="width: 5%;" class="text-secondary">6</td>
                            <td style="width: 40%;" class="text-secondary">Bagaimana Kemampuan penggunaan teknologi informasi alumni Pendidikan Teknik Elektro pada saat bekerja pada perusahaan bapak/ibu?</td>
                            <td style="width: 45%;">
                                <div class="d-flex flex-column flex-lg-row justify-content-center gap-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian6" id="sangatBaik6" value="4">
                                        <label class="form-check-label fw-medium" for="sangatBaik6">Sangat Baik</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian6" id="baik6" value="3">
                                        <label class="form-check-label fw-medium" for="baik6">Baik</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian6" id="cukup6" value="2">
                                        <label class="form-check-label fw-medium" for="cukup6">Cukup</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian6" id="kurang6" value="1">
                                        <label class="form-check-label fw-medium" for="kurang6">Kurang</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" style="width: 5%;" class="text-secondary">7</td>
                            <td style="width: 40%;" class="text-secondary">Bagaimana Upaya pengembangan diri alumni Pendidikan Teknik Elektro pada saat bekerja pada perusahaan bapak/ibu?</td>
                            <td style="width: 45%;">
                                <div class="d-flex flex-column flex-lg-row justify-content-center gap-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian7" id="sangatBaik7" value="4">
                                        <label class="form-check-label fw-medium" for="sangatBaik7">Sangat Baik</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian7" id="baik7" value="3">
                                        <label class="form-check-label fw-medium" for="baik7">Baik</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian7" id="cukup7" value="2">
                                        <label class="form-check-label fw-medium" for="cukup7">Cukup</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="penilaian7" id="kurang7" value="1">
                                        <label class="form-check-label fw-medium" for="kurang7">Kurang</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Harapan Terhadap Lulusan -->
            <div>
                <h5 class="px-0 text-dark fw-bold mb-3">Apa Harapan Anda Terhadap Lulusan S2 Penelitian dan Evaluasi Pendidikan?</h5>
                <textarea name="harapan" id="harapan" class="w-100 form-control mb-4" rows="10" placeholder="Silahkan Tuliskan Harapan Anda"></textarea>
            </div>
            <!-- Saran dan Masukan Terhadap Prodi -->
            <div>
                <h5 class="px-0 text-dark fw-bold mb-3">Saran dan Masukan Terhadap Program Studi S2 Penelitian dan Evaluasi Pendidikan?</h5>
                <textarea name="saran_masukan" id="saran_masukan" class="w-100 form-control mb-4" rows="10" placeholder="Silahkan Tuliskan Saran dan Masukan Anda"></textarea>
            </div>
            <input type="submit" value="Kirim" class="w-100 btn-submit text-white">
        </div>
    </form>

    <!-- Toast Berhasil/Gagal -->
    <?php if (isset($_GET['status'])): ?>
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast align-items-center text-white <?= $_GET['status'] == 'success' ? 'bg-success' : 'bg-danger' ?>" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <?= htmlspecialchars($_GET['message']) ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var toastEl = document.getElementById('liveToast');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();

                setTimeout(function () {
                    const url = new URL(window.location);
                    url.searchParams.delete('status');
                    url.searchParams.delete('message');
                    window.history.replaceState({}, '', url);
                }, 1500); // 1.5 detik
            });
        </script>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>