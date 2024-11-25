<?php
include 'koneksi.php';

// Mengambil data dari form
$id_praktikum_lama = $_POST['id_praktikum_lama'];
$id_praktikum_baru = $_POST['id_praktikum'];
$id_asisten = $_POST['id_asisten'];
$kode_mk = $_POST['kode_mk'];
$nama_praktikum = $_POST['nama_praktikum'];

// Cek apakah ID Praktikum baru sudah ada
$cek_id = mysqli_query($koneksi, "SELECT * FROM praktikum WHERE id_praktikum='$id_praktikum_baru' AND id_praktikum != '$id_praktikum_lama'");
if(mysqli_num_rows($cek_id) > 0) {
    header("location: prakIndex.php?activeTable=praktikum&error=id_exists");
    exit();
}

// Query untuk mengubah data
$query = "UPDATE praktikum SET 
    id_praktikum='$id_praktikum_baru', 
    id_asisten='$id_asisten', 
    kode_mk='$kode_mk', 
    nama_praktikum='$nama_praktikum' 
    WHERE id_praktikum='$id_praktikum_lama'";
$result = mysqli_query($koneksi, $query);

if($result){
    header("location: prakIndex.php?activeTable=praktikum&action=ubah");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>