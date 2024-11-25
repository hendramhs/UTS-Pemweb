<?php
$koneksi = mysqli_connect("localhost", "root", "", "prak");
if(mysqli_connect_errno()) {
    echo "gagal " .mysqli_connect_error();
}
?>