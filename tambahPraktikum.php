<?php
include 'koneksi.php';

// Mengambil data dari form
$id_praktikum = $_POST['id_praktikum'];
$id_asisten = $_POST['id_asisten'];
$kode_mk = $_POST['kode_mk'];
$nama_praktikum = $_POST['nama_praktikum'];

// Query untuk menambah data
$query = "INSERT INTO praktikum (id_praktikum, id_asisten, kode_mk, nama_praktikum) 
          VALUES ('$id_praktikum', '$id_asisten', '$kode_mk', '$nama_praktikum')";
$result = mysqli_query($koneksi, $query);

if($result){
    header("location: prakIndex.php?activeTable=praktikum&action=tambah");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>