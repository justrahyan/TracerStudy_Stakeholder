<?php
    $koneksi = mysqli_connect("localhost","root","","db_pep");
    // var_dump($koneksi);
    if (!$koneksi){
        die(mysqli_connect_error());
    } else {
        // echo "Koneksi berhasil";
    }
?>