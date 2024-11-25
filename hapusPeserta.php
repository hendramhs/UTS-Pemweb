<?php 
include 'koneksi.php';
 
$id = $_GET['id'];
 
$result = mysqli_query($koneksi, "DELETE FROM peserta WHERE nim='$id'");

if($result){
    // Tambahkan parameter untuk menandakan tabel aktif
    header("location: prakIndex.php?activeTable=peserta&action=hapus");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>