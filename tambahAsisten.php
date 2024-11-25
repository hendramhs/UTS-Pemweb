<?php
include 'koneksi.php';

// Mengambil data dari form
$id_asisten = $_POST['id_asisten'];
$nama_asisten = $_POST['nama_asisten'];
$no_tlp = $_POST['no_tlp'];

// Query untuk menambah data
$query = "INSERT INTO asisten (id_asisten, nama_asisten, no_tlp) VALUES ('$id_asisten', '$nama_asisten', '$no_tlp')";
$result = mysqli_query($koneksi, $query);

if($result){
    // Tambahkan parameter untuk menandakan tabel aktif
    header("location: prakIndex.php?activeTable=asisten&action=tambah");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>