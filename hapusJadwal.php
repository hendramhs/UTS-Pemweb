<?php 
include 'koneksi.php';
 
$id = $_GET['id'];
 
$result = mysqli_query($koneksi, "DELETE FROM jadwal WHERE id_jadwal='$id'");

if($result){
    // Tambahkan parameter untuk menandakan tabel aktif
    header("location: prakIndex.php?activeTable=jadwal&action=hapus");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>