<?php
include 'koneksi.php';

// Mengambil data dari form
$nim = $_POST['nim'];
$id_praktikum = $_POST['id_praktikum'];
$tgl_daftar = $_POST['tgl_daftar'];

// Cek apakah kombinasi NIM dan ID Praktikum sudah ada
$cek_duplikat = mysqli_query($koneksi, "SELECT * FROM peserta_praktikum 
                                         WHERE nim='$nim' AND id_praktikum='$id_praktikum'");
if(mysqli_num_rows($cek_duplikat) > 0) {
    header("location: prakIndex.php?activeTable=peserta_praktikum&error=already_registered");
    exit();
}

// Generate ID Peserta Praktikum otomatis
$query_id = "SELECT MAX(id_peserta_praktikum) as max_id FROM peserta_praktikum";
$result_id = mysqli_query($koneksi, $query_id);
$row_id = mysqli_fetch_assoc($result_id);
$next_id = $row_id['max_id'] + 1;

// Query untuk menambah data
$query = "INSERT INTO peserta_praktikum (id_peserta_praktikum, nim, id_praktikum, tgl_daftar) 
          VALUES ('$next_id', '$nim', '$id_praktikum', '$tgl_daftar')";
$result = mysqli_query($koneksi, $query);

if($result){
    header("location: prakIndex.php?activeTable=peserta_praktikum&action=tambah");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
    exit();
}
?>