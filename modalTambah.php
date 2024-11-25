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
            padding: 10px;
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
<div class="modal fade" id="tambahPesertaModal" tabindex="-1" role="dialog" aria-labelledby="tambahPesertaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPesertaModalLabel">Tambah Peserta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="tambahPeserta.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>NIM</label>
                            <input type="text" name="nim" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Mahasiswa</label>
                            <input type="text" name="nama_mhs" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <input type="text" name="jurusan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <!-- Modal Tambah Asisten -->
    <div class="modal fade" id="tambahAsistenModal" tabindex="-1" role="dialog" aria-labelledby="tambahAsistenModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahAsistenModalLabel">Tambah Asisten</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="tambahAsisten.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ID Asisten</label>
                            <input type="text" name="id_asisten" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Asisten</label>
                            <input type="text" name="nama_asisten" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="text" name="no_tlp" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <!-- Modal Tambah Jadwal -->
    <div class="modal fade" id="tambahJadwalModal" tabindex="-1" role="dialog" aria-labelledby="tambahJadwalModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahJadwalModalLabel">Tambah Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="tambahJadwal.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ID Jadwal</label>
                            <input type="text" name="id_jadwal" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>ID Praktikum</label>
                            <select name="id_praktikum" class="form-control" required>
                                <?php 
                                $praktikum = mysqli_query($koneksi, "SELECT * FROM praktikum");
                                while($p = mysqli_fetch_array($praktikum)) {
                                    echo "<option value='".$p['id_praktikum']."'>".$p['nama_praktikum']."</option>";
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
                                    echo "<option value='".$r['id_ruang']."'>".$r['nama_ruang']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Hari</label>
                            <select name="hari" class="form-control" required>
                                <option value="senin">Senin</option>
                                <option value="selasa">Selasa</option>
                                <option value="rabu">Rabu</option>
                                <option value="kamis">Kamis</option>
                                <option value="jumat">Jumat</option>
                                <option value="sabtu">Sabtu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <!-- Modal Tambah Mata Kuliah -->
    <div class="modal fade" id="tambahMataKuliahModal" tabindex="-1" role="dialog" aria-labelledby="tambahMataKuliahModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahMataKuliahModalLabel">Tambah Mata Kuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="tambahMatkul.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kode Mata Kuliah</label>
                            <input type="text" name="kode_mk" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Mata Kuliah</label>
                            <input type="text" name="nama_mk" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>SKS</label>
                            <input type="number" name="sks" class="form-control" min="1" max="6" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    
    <!-- Modal Tambah Praktikum -->
    <div class="modal fade" id="tambahPraktikumModal" tabindex="-1" role="dialog" aria-labelledby="tambahPraktikumModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPraktikumModalLabel">Tambah Praktikum</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="tambahPraktikum.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ID Praktikum</label>
                            <input type="text" name="id_praktikum" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Asisten</label>
                            <select name="id_asisten" class="form-control" required>
                                <?php 
                                $asisten = mysqli_query($koneksi, "SELECT * FROM asisten");
                                while($a = mysqli_fetch_array($asisten)) {
                                    echo "<option value='".$a['id_asisten']."'>".$a['nama_asisten']."</option>";
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
                                    echo "<option value='".$m['kode_mk']."'>".$m['nama_mk']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Praktikum</label>
                            <input type="text" name="nama_praktikum" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <!-- Modal Tambah Ruang -->
    <div class="modal fade" id="tambahRuangModal" tabindex="-1" role="dialog" aria-labelledby="tambahRuangModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahRuangModalLabel">Tambah Ruang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="tambahRuang.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ID Ruang</label>
                            <input type="text" name="id_ruang" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Ruang</label>
                            <input type="text" name="nama_ruang" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Kapasitas</label>
                            <input type="number" name="kapasitas" class="form-control" min="1" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Peserta Praktikum -->
    <!-- Modal Tambah Peserta Praktikum -->
<div class="modal fade" id="tambahPesertaPraktikumModal" tabindex="-1" role="dialog" aria-labelledby="tambahPesertaPraktikumModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPesertaPraktikumModalLabel">Tambah Peserta Praktikum</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="tambahPesertaPraktikum.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Mahasiswa</label>
                        <select name="nim" class="form-control" required>
                            <option value="">Pilih Mahasiswa</option>
                            <?php 
                            $peserta = mysqli_query($koneksi, "SELECT * FROM peserta");
                            while($p = mysqli_fetch_array($peserta)){
                            ?>
                                <option value="<?php echo $p['nim']; ?>">
                                    <?php echo $p['nama_mhs'] . " - " . $p['nim']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Praktikum</label>
                        <select name="id_praktikum" class="form-control" required>
                            <option value="">Pilih Praktikum</option>
                            <?php 
                            $praktikum = mysqli_query($koneksi, "SELECT p.*, mk.nama_mk FROM praktikum p 
                                                                JOIN mata_kuliah mk ON p.kode_mk = mk.kode_mk");
                            while($pr = mysqli_fetch_array($praktikum)){
                            ?>
                                <option value="<?php echo $pr['id_praktikum']; ?>">
                                    <?php echo $pr['nama_praktikum'] . " - " . $pr['nama_mk']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Daftar</label>
                        <input type="date" name="tgl_daftar" class="form-control" required value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

    
</body>
</html>