<?php
include 'koneksi.php';

// Mengambil data dari form
$id_ruang = $_POST['id_ruang'];
$nama_ruang = $_POST['nama_ruang'];
$kapasitas = $_POST['kapasitas'];

// Query untuk menambah data
$query = "INSERT INTO ruang (id_ruang, nama_ruang, kapasitas) VALUES ('$id_ruang', '$nama_ruang', '$kapasitas')";
$result = mysqli_query($koneksi, $query);

if($result){
    header("location: prakIndex.php?activeTable=ruang&action=tambah");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>