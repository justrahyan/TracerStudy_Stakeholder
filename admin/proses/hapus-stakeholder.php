<?php
session_start();
include '../../koneksi.php';

if (!isset($_SESSION['userweb'])) {
    header("location:../../login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM tb_datastakeholder WHERE id = '$id'";
    if (mysqli_query($koneksi, $query)) {
        header("Location: ../data-stakeholder.php?hapus=success");
        exit();
    } else {
        header("Location: ../data-stakeholder.php?hapus=error");
        exit();
    }
} else {
    echo "Data tidak ditemukan.";
}
?>
