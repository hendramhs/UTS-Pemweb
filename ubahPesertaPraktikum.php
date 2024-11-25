<?php
include 'koneksi.php';

// Mengambil data dari form
$id_peserta_praktikum = $_POST['id_peserta_praktikum'];
$nim = $_POST['nim'];
$id_praktikum = $_POST['id_praktikum'];
$tgl_daftar = $_POST['tgl_daftar'];

// Query untuk mengupdate data
$query = "UPDATE peserta_praktikum 
          SET nim = '$nim', 
              id_praktikum = '$id_praktikum', 
              tgl_daftar = '$tgl_daftar' 
          WHERE id_peserta_praktikum = '$id_peserta_praktikum'";

$result = mysqli_query($koneksi, $query);

if($result){
    header("location: prakIndex.php?activeTable=peserta_praktikum&action=ubah");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>