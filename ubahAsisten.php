<?php
include 'koneksi.php';

// Mengambil data dari form
$id_asisten_lama = $_POST['id_asisten_lama']; // Tambahkan input tersembunyi untuk ID asli
$id_asisten_baru = $_POST['id_asisten']; // ID baru yang diinputkan
$nama_asisten = $_POST['nama_asisten'];
$no_tlp = $_POST['no_tlp'];

// Cek apakah ID Asisten baru sudah ada (kecuali untuk ID yang sama)
$cek_id = mysqli_query($koneksi, "SELECT * FROM asisten WHERE id_asisten='$id_asisten_baru' AND id_asisten != '$id_asisten_lama'");
if(mysqli_num_rows($cek_id) > 0) {
    // ID Asisten sudah digunakan
    header("location: prakIndex.php?activeTable=asisten&error=id_exists");
    exit();
}

// Query untuk mengubah data
$query = "UPDATE asisten SET id_asisten='$id_asisten_baru', nama_asisten='$nama_asisten', no_tlp='$no_tlp' WHERE id_asisten='$id_asisten_lama'";
$result = mysqli_query($koneksi, $query);

if($result){
    // Tambahkan parameter untuk menandakan tabel aktif
    header("location: prakIndex.php?activeTable=asisten&action=ubah");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>