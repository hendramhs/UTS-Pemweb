<?php
include 'koneksi.php';

// Mengambil data dari form
$kode_mk = $_POST['kode_mk'];
$nama_mk = $_POST['nama_mk'];
$sks = $_POST['sks'];

// Query untuk menambah data
$query = "INSERT INTO mata_kuliah (kode_mk, nama_mk, sks) VALUES ('$kode_mk', '$nama_mk', '$sks')";
$result = mysqli_query($koneksi, $query);

if($result){
    // Tambahkan parameter untuk menandakan tabel aktif
    header("location: prakIndex.php?activeTable=mata_kuliah&action=tambah");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>