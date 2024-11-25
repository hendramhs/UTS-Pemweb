<?php
include 'koneksi.php';

// Mengambil data dari form
$nim_lama = $_POST['nim_lama'];
$nim_baru = $_POST['nim'];
$nama_mhs = $_POST['nama_mhs'];
$jurusan = $_POST['jurusan'];
$email = $_POST['email'];

// Cek apakah NIM baru sudah ada
$cek_id = mysqli_query($koneksi, "SELECT * FROM peserta WHERE nim='$nim_baru' AND nim != '$nim_lama'");
if(mysqli_num_rows($cek_id) > 0) {
    header("location: prakIndex.php?activeTable=peserta&error=id_exists");
    exit();
}

// Query untuk mengubah data
$query = "UPDATE peserta SET 
    nim='$nim_baru', 
    nama_mhs='$nama_mhs', 
    jurusan='$jurusan', 
    email='$email' 
    WHERE nim='$nim_lama'";
$result = mysqli_query($koneksi, $query);

if($result){
    header("location: prakIndex.php?activeTable=peserta&action=ubah");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>