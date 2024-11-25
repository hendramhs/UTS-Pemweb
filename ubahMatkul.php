<?php
include 'koneksi.php';

// Mengambil data dari form
$kode_mk_lama = $_POST['kode_mk_lama'];
$kode_mk_baru = $_POST['kode_mk'];
$nama_mk = $_POST['nama_mk'];
$sks = $_POST['sks'];

// Cek apakah Kode MK baru sudah ada
$cek_id = mysqli_query($koneksi, "SELECT * FROM mata_kuliah WHERE kode_mk='$kode_mk_baru' AND kode_mk != '$kode_mk_lama'");
if(mysqli_num_rows($cek_id) > 0) {
    header("location: prakIndex.php?activeTable=mata_kuliah&error=id_exists");
    exit();
}

// Query untuk mengubah data
$query = "UPDATE mata_kuliah SET 
    kode_mk='$kode_mk_baru', 
    nama_mk='$nama_mk', 
    sks='$sks' 
    WHERE kode_mk='$kode_mk_lama'";
$result = mysqli_query($koneksi, $query);

if($result){
    header("location: prakIndex.php?activeTable=mata_kuliah&action=ubah");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>