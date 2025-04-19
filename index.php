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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="assets/img/favicon_io/site.webmanifest">
</head>

<body>
    <header>
        <div class="box-container py-3 py-lg-4">
            <nav class="d-flex flex-row justify-content-between align-items-center">
                <div class="logo d-flex align-items-center gap-3">
                    <img src="assets/img/logo-unm-putih.png" alt="Logo UNM" height="50px">
                    <p class="text-white mb-0 fw-medium">TRACER STUDY STAKEHOLDER<br>PROGRAM STUDI S2 PEP</p>
                </div>
                <a href="login.php" class="text-white text-decoration-none">Login</a>
            </nav>
            <div class="text-center text-white pt-4 pt-md-0">
                <h1 class="fw-bold">Tracer Study</h1>
                <p>Stakeholder Program Studi S2 Penelitian dan Evaluasi Pendidikan<br>Universitas Negeri Makassar</p>
            </div>
        </div>
    </header>
    <!-- Forum Survey Kepuasan -->
    <div class="box-container forum-survey bg-white p-4 p-lg-5 rounded-3 mb-5">
        <div>
            <h3 class="text-dark text-center fw-bold mb-4">Forum Survey Kepuasan Pengguna Lulusan S2 PEP UNM</h3>
            <hr class="mb-0">
            <div class="d-flex align-items-center justify-content-between px-0 my-2">
                <label for="nama_pengisi">Nama Pengisi</label>
                <input type="text" name="nama_pengisi" id="nama_pengisi" class="form-control w-75">
            </div>
            <hr class="mb-0">
            <div class="d-flex align-items-center justify-content-between px-0 my-2">
                <label for="perusahaan">Nama Perusahaan/Lembaga/Institusi</label>
                <input type="text" name="perusahaan" id="perusahaan" class="form-control w-75">
            </div>
            <hr class="mb-0">
            <div class="d-flex align-items-center justify-content-between px-0 my-2">
                <label for="jabatan">Posisi Jabatan</label>
                <input type="text" name="jabatan" id="jabatan" class="form-control w-75">
            </div>
            <hr class="mb-0">
            <div class="d-flex align-items-center justify-content-between px-0 my-2">
                <label for="no_hp">No Handphone</label>
                <input type="text" name="no_hp" id="no_hp" class="form-control w-75">
            </div>
            <hr class="mb-0">
            <div class="d-flex align-items-center justify-content-between px-0 my-2">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control w-75">
            </div>
            <hr class="mb-0">
            <div class="d-flex align-items-center justify-content-between px-0 my-2">
                <label for="nama_lulusan">Nama Lulusan yang akan Dinilai</label>
                <input type="text" name="nama_lulusan" id="nama_lulusan" class="form-control w-75">
            </div>
            <hr class="mb-0">
            <div class="d-flex align-items-center justify-content-between px-0 my-2">
                <label for="tahun_lulus">Tahun Lulus Alumni</label>
                <input type="text" name="tahun_lulus" id="tahun_lulus" class="form-control w-75">
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
                                    <input class="form-check-input" type="radio" name="penilaian" id="sangatBaik" value="Sangat Baik">
                                    <label class="form-check-label fw-medium" for="sangatBaik">Sangat Baik</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="penilaian" id="baik" value="Baik">
                                    <label class="form-check-label fw-medium" for="baik">Baik</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="penilaian" id="cukup" value="Cukup">
                                    <label class="form-check-label fw-medium" for="cukup">Cukup</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="penilaian" id="kurang" value="Kurang">
                                    <label class="form-check-label fw-medium" for="kurang">Kurang</label>
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
            <h5 class="px-0 text-dark fw-bold mb-3">Saran dan Masukan Terhadap Program Studi S2 Penelitian dan Evaluasi Pendidikan?</h5>
            <textarea name="harapan" id="harapan" class="w-100 form-control mb-4" rows="10" placeholder="Silahkan Tuliskan Saran dan Masukan Anda"></textarea>
        </div>
        <input type="submit" value="Kirim" class="w-100 btn-submit text-white">
    </div>
</body>
</html>