<?php
session_start();
ob_start();
include '../../koneksi.php';

if (!isset($_SESSION['userweb'])) {
    header("location:../../login.php");
    exit();
}

// Pastikan semua data tersedia
if (
    isset($_POST['id']) &&
    isset($_POST['nama']) &&
    isset($_POST['perusahaan']) &&
    isset($_POST['jabatan']) &&
    isset($_POST['email']) &&
    isset($_POST['no_hp'])
) {
    $id = $_POST['id'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $perusahaan = mysqli_real_escape_string($koneksi, $_POST['perusahaan']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);

    $query = "UPDATE tb_datastakeholder SET 
                nama_pengisi = '$nama',
                perusahaan = '$perusahaan',
                jabatan = '$jabatan',
                email = '$email',
                no_hp = '$no_hp'
              WHERE id = '$id'";

    if (mysqli_query($koneksi, $query)) {
        header("Location: ../data-stakeholder.php?status=success");
        exit();
    } else {
        header("Location: ../data-stakeholder.php?status=error");
        exit();
    }
} else {
    echo "Data tidak ditemukan.";
}
?>
