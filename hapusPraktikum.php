<?php 
include 'koneksi.php';
 
$id = $_GET['id'];
 
$result = mysqli_query($koneksi, "DELETE FROM praktikum WHERE id_praktikum='$id'");

if($result){
    header("location: prakIndex.php?activeTable=praktikum&action=hapus");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>