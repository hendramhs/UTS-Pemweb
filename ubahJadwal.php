<?php
include 'koneksi.php';

// Mengambil data dari form
$id_jadwal_lama = $_POST['id_jadwal_lama'];
$id_jadwal_baru = $_POST['id_jadwal'];
$id_praktikum = $_POST['id_praktikum'];
$id_ruang = $_POST['id_ruang'];
$hari = $_POST['hari'];
$jam_mulai = $_POST['jam_mulai'];
$jam_selesai = $_POST['jam_selesai'];

// Cek apakah ID Jadwal baru sudah ada
$cek_id = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE id_jadwal='$id_jadwal_baru' AND id_jadwal != '$id_jadwal_lama'");
if(mysqli_num_rows($cek_id) > 0) {
    header("location: prakIndex.php?activeTable=jadwal&error=id_exists");
    exit();
}

// Query untuk mengubah data
$query = "UPDATE jadwal SET 
    id_jadwal='$id_jadwal_baru', 
    id_praktikum='$id_praktikum', 
    id_ruang='$id_ruang', 
    hari='$hari', 
    jam_mulai='$jam_mulai', 
    jam_selesai='$jam_selesai' 
    WHERE id_jadwal='$id_jadwal_lama'";
$result = mysqli_query($koneksi, $query);

if($result){
    header("location: prakIndex.php?activeTable=jadwal&action=ubah");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>