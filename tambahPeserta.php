<?php 
include 'koneksi.php';
 
$nim = $_POST['nim'];
$nama_mhs = $_POST['nama_mhs'];
$jurusan = $_POST['jurusan'];
$email = $_POST['email'];

$result = mysqli_query($koneksi, "INSERT INTO peserta (nim, nama_mhs, jurusan, email) VALUES ('$nim', '$nama_mhs', '$jurusan', '$email')");
if($result){
    // Tambahkan parameter untuk menandakan tabel aktif
    header("location: prakIndex.php?activeTable=peserta&action=tambah");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>