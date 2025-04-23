<?php
require_once '../../koneksi.php';
file_put_contents('log.txt', 'generate-laporan.php terpanggil' . PHP_EOL, FILE_APPEND);



// Pastikan tidak ada output sebelum session_start()
if (ob_get_level()) ob_end_clean();
session_start();

// Debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ambil parameter
$startDate = $_POST['startDateGenerate'] ?? '';
$endDate = $_POST['endDateGenerate'] ?? '';
$singleDate = $_POST['tglPenilaian'] ?? '';
$format = strtoupper($_POST['format'] ?? '');

// Validasi
if (!empty($singleDate)) {
    // Jika memilih tanggal tertentu, pastikan tidak memilih rentang tanggal
    if (!empty($startDate) || !empty($endDate)) {
        header("Location: ../data-penilaian.php?status=error&message=Pilih%20rentang%20tanggal%20ATAU%20tanggal%20tertentu,%20bukan%20keduanya");
        exit();
    }
} else {
    // Jika memilih rentang tanggal, pastikan keduanya terisi
    if (empty($startDate) || empty($endDate)) {
        header("Location: ../data-penilaian.php?status=error&message=Untuk%20rentang%20tanggal,%20harus%20mengisi%20tanggal%20awal%20dan%20akhir");
        exit();
    }
    
    // Validasi rentang tanggal
    if (strtotime($startDate) > strtotime($endDate)) {
        header("Location: ../data-penilaian.php?status=error&message=Tanggal%20awal%20tidak%20boleh%20lebih%20besar%20dari%20tanggal%20akhir");
        exit();
    }
}

// Pastikan setidaknya salah satu terisi
if (empty($singleDate) && (empty($startDate) || empty($endDate))) {
    header("Location: ../data-penilaian.php?status=error&message=Pilih%20rentang%20tanggal%20atau%20tanggal%20tertentu");
    exit();
}

// Buat judul laporan
$title = !empty($singleDate) 
    ? "Laporan Tanggal ".date('d/m/Y', strtotime($singleDate))
    : "Laporan Periode ".date('d/m/Y', strtotime($startDate))." - ".date('d/m/Y', strtotime($endDate));

// Query data
$query = "SELECT * FROM tb_penilaianstakeholder WHERE 1";
if (!empty($startDate) && !empty($endDate)) {
    $query .= " AND tanggal BETWEEN ? AND ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ss", $startDate, $endDate);
} else {
    $query .= " AND tanggal = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("s", $singleDate);
}

$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);

if (empty($data)) {
    header("Location: ../data-penilaian.php?status=error&message=Data%20tidak%20ditemukan");
    exit();
}

// Langsung include file generate
if ($format === 'PDF') {
    file_put_contents('log.txt', 'Format PDF diproses' . PHP_EOL, FILE_APPEND);
    $_GET['title'] = $title; // Pass title via GET
    require 'generate-pdf.php';
    header("Location: ../data-penilaian.php?status=success&message=PDF%20berhasil%20dihasilkan");
    exit();
} elseif ($format === 'EXCEL') {
    file_put_contents('log.txt', 'Format Excel diproses' . PHP_EOL, FILE_APPEND);
    $_GET['title'] = $title; // Pass title via GET
    require 'generate-excel.php';
    header("Location: ../data-penilaian.php?status=success&message=Excel%20berhasil%20dihasilkan");
    exit();
} else {
    header("Location: ../data-penilaian.php?status=error&message=Format%20laporan%20tidak%20valid");
    exit();
}

exit();

?>