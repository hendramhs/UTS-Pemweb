<?php
include 'koneksi.php';

// Mengambil data dari form
$id_jadwal = $_POST['id_jadwal'];
$id_praktikum = $_POST['id_praktikum'];
$id_ruang = $_POST['id_ruang'];
$hari = $_POST['hari'];
$jam_mulai = $_POST['jam_mulai'];
$jam_selesai = $_POST['jam_selesai'];

// Query untuk menambah data
$query = "INSERT INTO jadwal (id_jadwal, id_praktikum, id_ruang, hari, jam_mulai, jam_selesai) 
          VALUES ('$id_jadwal', '$id_praktikum', '$id_ruang', '$hari', '$jam_mulai', '$jam_selesai')";
$result = mysqli_query($koneksi, $query);

if($result){
    header("location: prakIndex.php?activeTable=jadwal&action=tambah");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>