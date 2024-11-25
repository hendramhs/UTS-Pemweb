<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .modal-content {
            border-radius: 10px;
            border: none;
        }

        .modal-header {
            background-color: #3498db;
            color: white;
            border-radius: 10px 10px 0 0;
        }

        .modal-body {
            padding: 20px;
        }

        .form-group label {
            color: #2c3e50;
            font-weight: 500;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #bdc3c7;
            padding: 5px;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        /* Animasi fade untuk transisi tabel */
        .table-section {
            opacity: 0;
            animation: fadeIn 0.5s forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <!-- Modal Ubah Asisten -->
    <?php 
    $data = mysqli_query($koneksi,"SELECT * FROM asisten");
    while($d = mysqli_fetch_array($data)){
    ?>
    <div class="modal fade" id="ubahAsistenModal<?php echo $d['id_asisten']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahAsistenModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahAsistenModalLabel">Ubah Data Asisten</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="ubahAsisten.php" method="POST">
                    <div class="modal-body">
                        <!-- Input tersembunyi untuk menyimpan ID asli -->
                        <input type="hidden" name="id_asisten_lama" value="<?php echo $d['id_asisten']; ?>">
                        
                        <div class="form-group">
                            <label>ID Asisten</label>
                            <input type="text" name="id_asisten" class="form-control" value="<?php echo $d['id_asisten']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Asisten</label>
                            <input type="text" name="nama_asisten" class="form-control" value="<?php echo $d['nama_asisten']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="text" name="no_tlp" class="form-control" value="<?php echo $d['no_tlp']; ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>
    
    <!-- Modal Ubah Jadwal -->
    <?php 
    $data = mysqli_query($koneksi,"SELECT * FROM jadwal");
    while($d = mysqli_fetch_array($data)){
    ?>
    <div class="modal fade" id="ubahJadwalModal<?php echo $d['id_jadwal']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahJadwalModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahJadwalModalLabel">Ubah Data Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="ubahJadwal.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id_jadwal_lama" value="<?php echo $d['id_jadwal']; ?>">
                        <div class="form-group">
                            <label>ID Jadwal</label>
                            <input type="text" name="id_jadwal" class="form-control" value="<?php echo $d['id_jadwal']; ?>" required>
                        </div>
                    <div class="form-group">
                        <label>ID Praktikum</label>
                        <select name="id_praktikum" class="form-control" required>
                            <?php 
                            $praktikum = mysqli_query($koneksi, "SELECT * FROM praktikum");
                            while($p = mysqli_fetch_array($praktikum)) {
                                $selected = ($p['id_praktikum'] == $d['id_praktikum']) ? 'selected' : '';
                                echo "<option value='".$p['id_praktikum']."' ".$selected.">".$p['nama_praktikum']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>ID Ruang</label>
                        <select name="id_ruang" class="form-control" required>
                            <?php 
                            $ruang = mysqli_query($koneksi, "SELECT * FROM ruang");
                            while($r = mysqli_fetch_array($ruang)) {
                                $selected = ($r['id_ruang'] == $d['id_ruang']) ? 'selected' : '';
                                echo "<option value='".$r['id_ruang']."' ".$selected.">".$r['nama_ruang']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Hari</label>
                        <select name="hari" class="form-control" required>
                            <?php 
                            $hari = array('senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu');
                            foreach($hari as $h) {
                                $selected = ($h == $d['hari']) ? 'selected' : '';
                                echo "<option value='".$h."' ".$selected.">".ucfirst($h)."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="form-control" value="<?php echo $d['jam_mulai']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="form-control" value="<?php echo $d['jam_selesai']; ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>
<!-- Modal Ubah Mata Kuliah -->
    <?php 
    $data = mysqli_query($koneksi,"SELECT * FROM mata_kuliah");
    while($d = mysqli_fetch_array($data)){
    ?>
    <div class="modal fade" id="ubahMataKuliahModal<?php echo $d['kode_mk']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahMataKuliahModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahMataKuliahModalLabel">Ubah Data Mata Kuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="ubahMatkul.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="kode_mk_lama" value="<?php echo $d['kode_mk']; ?>">
                        <div class="form-group">
                            <label>Kode Mata Kuliah</label>
                            <input type="text" name="kode_mk" class="form-control" value="<?php echo $d['kode_mk']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Mata Kuliah</label>
                            <input type="text" name="nama_mk" class="form-control" value="<?php echo $d['nama_mk']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>SKS</label>
                            <input type="number" name="sks" class="form-control" value="<?php echo $d['sks']; ?>" min="1" max="6" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php 
    $data = mysqli_query($koneksi,"SELECT * FROM peserta");
    while($d = mysqli_fetch_array($data)){
    ?>
    <div class="modal fade" id="ubahPesertaModal<?php echo $d['nim']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahPesertaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahPesertaModalLabel">Ubah Data Peserta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="ubahPeserta.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="nim_lama" value="<?php echo $d['nim']; ?>">
                        <div class="form-group">
                            <label>NIM</label>
                            <input type="text" name="nim" class="form-control" value="<?php echo $d['nim']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Mahasiswa</label>
                            <input type="text" name="nama_mhs" class="form-control" value="<?php echo $d['nama_mhs']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <input type="text" name="jurusan" class="form-control" value="<?php echo $d['jurusan']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $d['email']; ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- Modal Ubah Praktikum -->
    <?php 
    $data = mysqli_query($koneksi,"SELECT * FROM praktikum");
    while($d = mysqli_fetch_array($data)){
    ?>
    <div class="modal fade" id="ubahPraktikumModal<?php echo $d['id_praktikum']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahPraktikumModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahPraktikumModalLabel">Ubah Data Praktikum</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="ubahPraktikum.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id_praktikum_lama" value="<?php echo $d['id_praktikum']; ?>">
                        <div class="form-group">
                            <label>ID Praktikum</label>
                            <input type="text" name="id_praktikum" class="form-control" value="<?php echo $d['id_praktikum']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Asisten</label>
                            <select name="id_asisten" class="form-control" required>
                                <?php 
                                $asisten = mysqli_query($koneksi, "SELECT * FROM asisten");
                                while($a = mysqli_fetch_array($asisten)) {
                                    $selected = ($a['id_asisten'] == $d['id_asisten']) ? 'selected' : '';
                                    echo "<option value='".$a['id_asisten']."' ".$selected.">".$a['nama_asisten']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mata Kuliah</label>
                            <select name="kode_mk" class="form-control" required>
                                <?php 
                                $matkul = mysqli_query($koneksi, "SELECT * FROM mata_kuliah");
                                while($m = mysqli_fetch_array($matkul)) {
                                    $selected = ($m['kode_mk'] == $d['kode_mk']) ? 'selected' : '';
                                    echo "<option value='".$m['kode_mk']."' ".$selected.">".$m['nama_mk']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Praktikum</label>
                            <input type="text" name="nama_praktikum" class="form-control" value="<?php echo $d['nama_praktikum']; ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- Modal Ubah Ruang -->
    <?php 
    $data = mysqli_query($koneksi,"SELECT * FROM ruang");
    while($d = mysqli_fetch_array($data)){
    ?>
    <div class="modal fade" id="ubahRuangModal<?php echo $d['id_ruang']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahRuangModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahRuangModalLabel">Ubah Data Ruang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="ubahRuang.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id_ruang_lama" value="<?php echo $d['id_ruang']; ?>">
                        <div class="form-group">
                            <label>ID Ruang</label>
                            <input type="text" name="id_ruang" class="form-control" value="<?php echo $d['id_ruang']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Ruang</label>
                            <input type="text" name="nama_ruang" class="form-control" value="<?php echo $d['nama_ruang']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Kapasitas</label>
                            <input type="number" name="kapasitas" class="form-control" value="<?php echo $d['kapasitas']; ?>" min="1" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- Modal Ubah Peserta Praktikum -->
    <?php 
    $data = mysqli_query($koneksi,"SELECT * FROM peserta_praktikum");
    while($d = mysqli_fetch_array($data)){
    ?>
    <div class="modal fade" id="ubahPesertaPraktikumModal<?php echo $d['id_peserta_praktikum']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahPesertaPraktikumModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahPesertaPraktikumModalLabel">Ubah Peserta Praktikum</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="ubahPesertaPraktikum.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id_peserta_praktikum" value="<?php echo $d['id_peserta_praktikum']; ?>">
                        
                        <div class="form-group">
                            <label>Nama Mahasiswa</label>
                            <select name="nim" class="form-control" required>
                                <?php 
                                $peserta = mysqli_query($koneksi, "SELECT * FROM peserta");
                                while($p = mysqli_fetch_array($peserta)){
                                ?>
                                    <option value="<?php echo $p['nim']; ?>" 
                                        <?php echo ($p['nim'] == $d['nim']) ? 'selected' : ''; ?>>
                                        <?php echo $p['nama_mhs'] . " - " . $p['nim']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Praktikum</label>
                            <select name="id_praktikum" class="form-control" required>
                                <?php 
                                $praktikum = mysqli_query($koneksi, "SELECT p.*, mk.nama_mk FROM praktikum p 
                                                                    JOIN mata_kuliah mk ON p.kode_mk = mk.kode_mk");
                                while($pr = mysqli_fetch_array($praktikum)){
                                ?>
                                    <option value="<?php echo $pr['id_praktikum']; ?>" 
                                        <?php echo ($pr['id_praktikum'] == $d['id_praktikum']) ? 'selected' : ''; ?>>
                                        <?php echo $pr['nama_praktikum'] . " - " . $pr['nama_mk']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Tanggal Daftar</label>
                            <input type="date" name="tgl_daftar" class="form-control" required value="<?php echo $d['tgl_daftar']; ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php 
    }
    ?>
</body>
</html>