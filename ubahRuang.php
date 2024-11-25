<?php
include 'koneksi.php';

// Mengambil data dari form
$id_ruang_lama = $_POST['id_ruang_lama'];
$id_ruang_baru = $_POST['id_ruang'];
$nama_ruang = $_POST['nama_ruang'];
$kapasitas = $_POST['kapasitas'];

// Cek apakah ID Ruang baru sudah ada
$cek_id = mysqli_query($koneksi, "SELECT * FROM ruang WHERE id_ruang='$id_ruang_baru' AND id_ruang != '$id_ruang_lama'");
if(mysqli_num_rows($cek_id) > 0) {
    header("location: prakIndex.php?activeTable=ruang&error=id_exists");
    exit();
}

// Query untuk mengubah data
$query = "UPDATE ruang SET 
    id_ruang='$id_ruang_baru', 
    nama_ruang='$nama_ruang', 
    kapasitas='$kapasitas' 
    WHERE id_ruang='$id_ruang_lama'";
$result = mysqli_query($koneksi, $query);

if($result){
    header("location: prakIndex.php?activeTable=ruang&action=ubah");
    exit ();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>