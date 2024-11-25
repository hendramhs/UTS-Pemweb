<?php 
include 'koneksi.php';
 
$id = $_GET['id'];
 
$result = mysqli_query($koneksi, "DELETE FROM asisten WHERE id_asisten='$id'");

if($result){
    // Tambahkan parameter untuk menandakan tabel aktif
    header("location: prakIndex.php?activeTable=asisten&action=hapus");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
