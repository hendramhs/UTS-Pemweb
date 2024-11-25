<?php 
include 'koneksi.php';
 
$id = $_GET['id'];
 
$result = mysqli_query($koneksi, "DELETE FROM ruang WHERE id_ruang='$id'");

if($result){
    // Tambahkan parameter untuk menandakan tabel aktif
    header("location: prakIndex.php?activeTable=ruang&action=hapus");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>