<!-- The Modal -->
<div class="modal fade" id="AddBookModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Buku</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form class="forms-sample" method="POST" action="input_buku.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- Judul Buku -->
                    <div class="form-group">
                        <label for="Judul">Judul Buku <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" name="judul" id="Judul"
                            placeholder="Masukkan Judul Buku" value="" required>
                    </div>

                    <!-- Penulis -->
                    <div class="form-group">
                        <label for="Penulis">Penulis <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" name="penulis" id="Penulis"
                            placeholder="Masukkan Penulis" value="" required>
                    </div>

                    <!-- Penerbit -->
                    <div class="form-group">
                        <label for="Penerbit">Penerbit <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" name="penerbit" id="Penerbit"
                            placeholder="Masukkan Penerbit" value="" required>
                    </div>

                    <!-- No ISBN -->
                    <div class="form-group">
                        <label for="ISBN">No ISBN</label>
                        <input type="text" class="form-control" name="isbn" id="ISBN" placeholder="Masukkan No ISBN"
                            value="0">
                    </div>

                    <!-- Tahun Terbit -->
                    <div class="form-group">
                        <label for="TahunTerbit">Tahun Terbit <small class="text-danger">*</small></label>
                        <input type="number" class="form-control" name="tahun_terbit" id="TahunTerbit"
                            placeholder="Masukkan Tahun Terbit" value="" required>
                    </div>

                    <label>Jenis Buku <small class="text-danger">*</small></label><br>
                    <div class="form-group row">
                        <div class="col-sm-5">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="jenis_buku" id="PaketPelajaran"
                                        value="Paket Pelajaran" required>
                                    Paket Pelajaran
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="jenis_buku"
                                        id="NonPaketPelajaran" value="Non Paket Pelajaran" required>
                                    Non Paket Pelajaran
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Lokasi Rak -->
                    <div class="form-group">
                        <label for="LokasiRak">Lokasi Rak <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" name="lokasi_rak" id="LokasiRak"
                            placeholder="Masukkan Lokasi Rak" value="" required>
                    </div>

                    <!-- Foto Buku -->
                    <div class="form-group">
                        <label>Upload Foto Buku</label>
                        <div class="custom-file">
                            <input type="file" name="berkas" class="custom-file-input1" id="uploadImage1"
                                accept="image/*">
                            <label class="custom-file-label" for="uploadImage1">Pilih file...</label>
                        </div>
                        <div class="mt-3">
                            <img id="previewImage1" src="#" alt="Pratinjau Gambar" class="img-fluid rounded"
                                style="display: none; max-height: 200px;">
                        </div>
                    </div>

                    <!-- Sinopsis -->
                    <div class="form-group">
                        <label for="Sinopsis">Sinopsis <small class="text-danger">*</small></label>
                        <textarea class="form-control" name="sinopsis" id="Sinopsis" rows="3"
                            placeholder="Masukkan Sinopsis" required></textarea>
                    </div>

                    <!-- Genre -->
                    <label>Genre</label><br>
                    <div class="form-group">
                        <div class="row">
                            <?php

                            $counter = 0; // Variabel penghitung untuk jumlah checkbox
                            $colCounter = 0; // Penghitung kolom
                            
                            // Iterasi untuk setiap genre
                            foreach ($genres as $genre) {
                                // Setiap 4 checkbox, buat kolom baru
                                if ($counter % 4 == 0) {
                                    if ($colCounter > 0) {
                                        echo '</div>';
                                        echo '</div>'; // Tutup kolom sebelumnya
                                    }
                                    echo '<div class="col-md-4"><div class="form-group">'; // Buka kolom baru
                                    $colCounter++;
                                }
                                // Cetak checkbox untuk genre
                                echo '<div class="form-check form-check-success">';
                                echo '<label class="form-check-label">';
                                echo '<input type="checkbox" class="form-check-input" name="genre[]" value="' . $genre['id_genre'] . '">';
                                echo $genre['nama_genre'];
                                echo '</label>';
                                echo '</div>';

                                $counter++;
                            }

                            // Menutup kolom terakhir jika perlu
                            if ($colCounter > 0) {
                                echo '</div></div>'; // Tutup kolom terakhir
                            }
                            ?>
                        </div>
                    </div>


                    <!-- Jumlah Eksemplar -->
                    <div class="form-group">
                        <label for="JumlahEksemplar">Jumlah Eksemplar <small class="text-danger">*</small></label>
                        <input type="number" class="form-control" name="jumlah_eksemplar" id="JumlahEksemplar"
                            placeholder="Masukkan Jumlah Eksemplar" min="1" value="" required>
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit" name="uploadbtn" class="btn btn-primary mr-2">Save Changes</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="tombolTambah">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Eksemplar</h4>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form class="forms-sample" method="POST" action="input_eksemplar.php" enctype="multipart/form-data">
                <div class="modal-body">

                    <input type="hidden" name="id_buku" id="idBuku">

                    <div class="form-group">
                        <label for="JudulBuku">Judul Buku <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" name="judul_buku" id="JudulBuku"
                            placeholder="Judul Buku" readonly>
                    </div>

                    <!-- Lokasi Rak -->
                    <div class="form-group">
                        <label for="LokasiRak">Lokasi Rak <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" name="lokasi_rak" id="LokasiRak"
                            placeholder="Masukkan Lokasi Rak" value="" required>
                    </div>

                    <!-- Jumlah Eksemplar -->
                    <div class="form-group">
                        <label for="JumlahEksemplar">Jumlah Eksemplar <small class="text-danger">*</small></label>
                        <input type="number" class="form-control" name="jumlah_eksemplar" id="JumlahEksemplar"
                            placeholder="Masukkan Jumlah Eksemplar" min="1" value="" required>
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit" name="uploadbtn" class="btn btn-primary mr-2">Save Changes</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="tombolEdit">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Buku</h4>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form class="forms-sample" method="POST" action="edit_buku.php" enctype="multipart/form-data">
                <div class="modal-body">

                    <input type="hidden" name="id_buku" id="idBuku">
                    <input type="text" name="fotoBuku" id="FotoBuku" hidden>

                    <!-- Judul Buku -->
                    <div class="form-group">
                        <label for="Judul">Judul Buku <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" name="judul" id="Judul"
                            placeholder="Masukkan Judul Buku" value="" required>
                    </div>

                    <!-- Penulis -->
                    <div class="form-group">
                        <label for="Penulis">Penulis <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" name="penulis" id="Penulis"
                            placeholder="Masukkan Penulis" value="" required>
                    </div>

                    <!-- Penerbit -->
                    <div class="form-group">
                        <label for="Penerbit">Penerbit <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" name="penerbit" id="Penerbit"
                            placeholder="Masukkan Penerbit" value="" required>
                    </div>

                    <!-- No ISBN -->
                    <div class="form-group">
                        <label for="ISBN">No ISBN</label>
                        <input type="text" class="form-control" name="isbn" id="Isbn" placeholder="Masukkan No ISBN"
                            value="">
                    </div>

                    <!-- Tahun Terbit -->
                    <div class="form-group">
                        <label for="TahunTerbit">Tahun Terbit <small class="text-danger">*</small></label>
                        <input type="number" class="form-control" name="tahun_terbit" id="TahunTerbit"
                            placeholder="Masukkan Tahun Terbit" value="" required>
                    </div>

                    <label>Jenis Buku <small class="text-danger">*</small></label><br>
                    <div class="form-group row">
                        <div class="col-sm-5">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="jenis_buku" id="PaketPelajaran2"
                                        value="Paket Pelajaran" required>
                                    Paket Pelajaran
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="jenis_buku"
                                        id="NonPaketPelajaran2" value="Non Paket Pelajaran" required>
                                    Non Paket Pelajaran
                                </label>
                            </div>
                        </div>
                    </div>


                    <!-- Foto Buku -->
                    <div class="form-group">
                        <label>Upload Foto Buku</label>
                        <div class="custom-file">
                            <input type="file" name="berkas" class="custom-file-input2" id="uploadImage2"
                                accept="image/*">
                            <label class="custom-file-label" for="uploadImage2">Pilih file...</label>
                        </div>
                        <div class="mt-3">
                            <img id="previewImage2" src="#" alt="Pratinjau Gambar" class="img-fluid rounded"
                                style="display: none; max-height: 200px;">
                        </div>
                    </div>

                    <!-- Sinopsis -->
                    <div class="form-group">
                        <label for="Sinopsis">Sinopsis <small class="text-danger">*</small></label>
                        <textarea class="form-control" name="sinopsis" id="Sinopsis" rows="3"
                            placeholder="Masukkan Sinopsis" required></textarea>
                    </div>

                    <!-- Genre -->
                    <label>Genre</label><br>
                    <div class="form-group">
                        <div class="row">
                            <?php

                            $counter = 0; // Variabel penghitung untuk jumlah checkbox
                            $colCounter = 0; // Penghitung kolom
                            
                            // Iterasi untuk setiap genre
                            foreach ($genres as $genre) {
                                // Setiap 4 checkbox, buat kolom baru
                                if ($counter % 4 == 0) {
                                    if ($colCounter > 0) {
                                        echo '</div>';
                                        echo '</div>'; // Tutup kolom sebelumnya
                                    }
                                    echo '<div class="col-md-4"><div class="form-group">'; // Buka kolom baru
                                    $colCounter++;
                                }
                                // Cetak checkbox untuk genre
                                echo '<div class="form-check form-check-success">';
                                echo '<label class="form-check-label">';
                                echo '<input type="checkbox" class="form-check-input" name="genre[]" value="' . $genre['id_genre'] . '">';
                                echo $genre['nama_genre'];
                                echo '</label>';
                                echo '</div>';

                                $counter++;
                            }

                            // Menutup kolom terakhir jika perlu
                            if ($colCounter > 0) {
                                echo '</div></div>'; // Tutup kolom terakhir
                            }
                            ?>
                        </div>
                    </div>
                    <!-- Tombol Submit -->
                    <button type="submit" name="uploadbtn" class="btn btn-primary mr-2">Save Changes</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="tombolEditEksemplar">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Eksemplar</h4>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form class="forms-sample" method="POST" action="edit_eksemplar.php" enctype="multipart/form-data">
                <div class="modal-body">

                    <input type="hidden" name="id_eksemplar" id="idEksemplar">

                    <!-- Judul Buku -->
                    <div class="form-group">
                        <label for="JudulBuku">Judul Buku <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" name="judul_buku" id="JudulBuku"
                            placeholder="Judul Buku" readonly>
                    </div>

                    <!-- Lokasi Rak -->
                    <div class="form-group">
                        <label for="LokasiRak">Lokasi Rak <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" name="lokasi_rak" id="LokasiRak"
                            placeholder="Masukkan Lokasi Rak" value="" required>
                    </div>

                    <!-- Status Buku -->
                    <label>Status Buku <small class="text-danger">*</small></label><br>
                    <div class="form-group row">
                        <div class="col-sm-5">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="statusTersedia"
                                        value="Tersedia" required>
                                    Tersedia
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="statusDipinjamkan"
                                        value="Dipinjamkan" required>
                                    Dipinjamkan
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="statusHilang"
                                        value="Hilang" required>
                                    Hilang
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="statusRusak"
                                        value="Rusak" required>
                                    Rusak
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit" name="uploadbtn" class="btn btn-primary mr-2">Save Changes</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="tombolHapusEksemplar">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Hapus Eksemplar</h4>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <h4>Apakah Anda yakin ingin menghapus eksemplar buku ini?</h4>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <form action="hapus_eksemplar.php" method="POST">
                    <input type="hidden" name="id_eksemplar_buku" id="idEksemplarBuku">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
