<?php
include 'koneksi.php';

// Mengambil parameter dari URL
$id_peserta_praktikum = $_GET['id'];

// Query untuk menghapus data
$query = mysqli_query($koneksi, "DELETE FROM peserta_praktikum 
                                WHERE id_peserta_praktikum='$id_peserta_praktikum'");

if($query){
  // Tambahkan parameter untuk menandakan tabel aktif
  header("location: prakIndex.php?activeTable=peserta_praktikum&action=hapus");
  exit();
} else {
  echo "Error: " . mysqli_error($koneksi);
}
?>