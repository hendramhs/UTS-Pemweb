<?php 
include 'koneksi.php';
 
$id = $_GET['id'];
 
$result = mysqli_query($koneksi, "DELETE FROM mata_kuliah WHERE kode_mk='$id'");

if($result){
    // Tambahkan parameter untuk menandakan tabel aktif
    header("location: prakIndex.php?activeTable=mata_kuliah&action=hapus");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>