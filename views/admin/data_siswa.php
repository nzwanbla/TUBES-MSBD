<?php

require './include/Admin_function.php';

if (empty($_SESSION['username']) or $_SESSION['status'] != 'Admin') {
	header("Location: ./error-403.php");
}

$kelasX = getDataSiswa("X");
$kelasXI = getDataSiswa("XI");
$kelasXII = getDataSiswa("XII");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Perpustakaan SMAN 2 Binjai</title>

	<?php include "./include/css.php"; ?>

</head>

<body>
	<div class="container-scroller">
		<!-- include:navbar.php -->
		<?php
		include "./include/navbar.php";
		?>

		<div class="container-fluid page-body-wrapper">
			<!-- include -->
			<!-- sidebar_settings.php -->
			<?php
			include "../../include/sidebar_setting.php";
			?>



			<!-- sidebar.php -->
			<?php
			include "./include/sidebar.php";
			?>

			<ul id="nav-tabs">
				<li><a href="#">X</a>
					<section style="max-height: 500px; overflow-y: auto;">

						<div class="card mb-4">
							<div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
								<h4 class="m-0 font-weight-bold text-primary">Data Siswa</h4>
								<button type="button" class="btn btn-primary" data-toggle="modal"
									data-target="#tambahSiswa">
									Tambah Siswa
								</button>
							</div>
							<div class="table-responsive p-3">
								<table class="table align-items-center table-flush table-hover" id="dataTableHover1">
									<thead class="bg-primary text-white">
										<tr>
											<th>No</th>
											<th>Profile</th>
											<th>Username/NISN</th>
											<th>Nama</th>
											<th>Kelas</th>
											<th>Tahun Masuk</th>
											<th>Alamat</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 1;
										foreach ($kelasX as $kelas10) {
											?>
											<tr>
												<td><?= $i ?></td>
												<td><img src="<?= $kelas10['foto_profil'] ?>"
														alt="<?= $kelas10['nama_pengunjung'] ?>" width="50" height="75">
												</td>
												<td><?= $kelas10['username'] ?></td>
												<td><?= $kelas10['nama_pengunjung'] ?></td>
												<td><?= $kelas10['kelas'] ?></td>
												<td><?= $kelas10['tahun_masuk'] ?></td>
												<td><?= $kelas10['alamat'] ?></td>

												<td>
													<button type="button"
														class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center"
														data-bs-toggle="modal" data-bs-target="#tombolEdit"
														data-id="<?= $kelas10['id_user'] ?>"
														data-username="<?= $kelas10['username'] ?>"
														data-nama="<?= $kelas10['nama_pengunjung'] ?>"
														data-foto_profil="<?= $kelas10['foto_profil'] ?>"
														data-role="<?= $kelas10['role'] ?>"
														data-kelas="<?= $kelas10['kelas'] ?>"
														data-tahun_masuk="<?= $kelas10['tahun_masuk'] ?>">
														<i class="bi bi-pencil"></i>
													</button>
													<button type="button"
														class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center"
														data-bs-toggle="modal" data-bs-target="#tombolReset"
														data-id="<?= $kelas10['id_user'] ?>"
														data-username="<?= $kelas10['username'] ?>">
														<i class="bi bi-arrow-repeat"></i>
													</button>
												</td>
											</tr>
											<?php $i++;
										}
										?>

									</tbody>
								</table>
							</div>
						</div>
					</section>
				</li>

				<li><a href="#">XI</a>
					<section style="max-height: 500px; overflow-y: auto;">

						<div class="card mb-4">
							<div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
								<h4 class="m-0 font-weight-bold text-primary">Data Siswa</h4>
								<button type="button" class="btn btn-primary" data-toggle="modal"
									data-target="#tambahSiswa">
									Tambah Siswa
								</button>
							</div>
							<div class="table-responsive p-3">
								<table class="table align-items-center table-flush table-hover" id="dataTableHover2">
									<thead class="bg-primary text-white">
										<tr>
											<th>No</th>
											<th>Profile</th>
											<th>Username/NISN</th>
											<th>Nama</th>
											<th>Kelas</th>
											<th>Tahun Masuk</th>
											<th>Alamat</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 1;
										foreach ($kelasXI as $kelas11) {
											?>
											<tr>
												<td><?= $i ?></td>
												<td><img src="<?= $kelas11['foto_profil'] ?>"
														alt="<?= $kelas11['nama_pengunjung'] ?>" width="50" height="75">
												</td>
												<td><?= $kelas11['username'] ?></td>
												<td><?= $kelas11['nama_pengunjung'] ?></td>
												<td><?= $kelas11['kelas'] ?></td>
												<td><?= $kelas11['tahun_masuk'] ?></td>
												<td><?= $kelas11['alamat'] ?></td>

												<td>
													<button type="button"
														class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center"
														data-bs-toggle="modal" data-bs-target="#tombolEdit"
														data-id="<?= $kelas11['id_user'] ?>"
														data-username="<?= $kelas11['username'] ?>"
														data-nama="<?= $kelas11['nama_pengunjung'] ?>"
														data-foto_profil="<?= $kelas11['foto_profil'] ?>"
														data-role="<?= $kelas11['role'] ?>"
														data-kelas="<?= $kelas11['kelas'] ?>"
														data-tahun_masuk="<?= $kelas11['tahun_masuk'] ?>">
														<i class="bi bi-pencil"></i>
													</button>
													<button type="button"
														class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center"
														data-bs-toggle="modal" data-bs-target="#tombolReset"
														data-id="<?= $kelas11['id_user'] ?>"
														data-username="<?= $kelas11['username'] ?>">
														<i class="bi bi-arrow-repeat"></i>
													</button>
												</td>
											</tr>
											<?php $i++;
										}
										?>

									</tbody>
								</table>
							</div>
						</div>
					</section>
				</li>

				<li><a href="#">XII</a>
					<section style="max-height: 500px; overflow-y: auto;">

						<div class="card mb-4">
							<div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
								<h4 class="m-0 font-weight-bold text-primary">Data Siswa</h4>
								<button type="button" class="btn btn-primary" data-toggle="modal"
									data-target="#tambahSiswa">
									Tambah Siswa
								</button>
							</div>
							<div class="table-responsive p-3">
								<table class="table align-items-center table-flush table-hover" id="dataTableHover3">
									<thead class="bg-primary text-white">
										<tr>
											<th>No</th>
											<th>Profile</th>
											<th>Username/NISN</th>
											<th>Nama</th>
											<th>Kelas</th>
											<th>Tahun Masuk</th>
											<th>Alamat</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 1;
										foreach ($kelasXII as $kelas12) {
											?>
											<tr>
												<td><?= $i ?></td>
												<td><img src="<?= $kelas12['foto_profil'] ?>"
														alt="<?= $kelas12['nama_pengunjung'] ?>" width="50" height="75">
												</td>
												<td><?= $kelas12['username'] ?></td>
												<td><?= $kelas12['nama_pengunjung'] ?></td>
												<td><?= $kelas12['kelas'] ?></td>
												<td><?= $kelas12['tahun_masuk'] ?></td>
												<td><?= $kelas12['alamat'] ?></td>

												<td>
													<button type="button"
														class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center"
														data-bs-toggle="modal" data-bs-target="#tombolEdit"
														data-id="<?= $kelas12['id_user'] ?>"
														data-username="<?= $kelas12['username'] ?>"
														data-nama="<?= $kelas12['nama_pengunjung'] ?>"
														data-foto_profil="<?= $kelas12['foto_profil'] ?>"
														data-role="<?= $kelas12['role'] ?>"
														data-kelas="<?= $kelas12['kelas'] ?>"
														data-tahun_masuk="<?= $kelas12['tahun_masuk'] ?>">
														<i class="bi bi-pencil"></i>
													</button>
													<button type="button"
														class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center"
														data-bs-toggle="modal" data-bs-target="#tombolReset"
														data-id="<?= $kelas12['id_user'] ?>"
														data-username="<?= $kelas12['username'] ?>">
														<i class="bi bi-arrow-repeat"></i>
													</button>
												</td>
											</tr>
											<?php $i++;
										}
										?>

									</tbody>
								</table>
							</div>
						</div>
					</section>
				</li>
			</ul>

			<?php include "./include/js.php"; ?>

			<script>
				$(document).ready(function () {
					$('#dataTable').DataTable(); // ID From dataTable 
					$('#dataTableHover1').DataTable(); // ID From dataTable with Hover
					$('#dataTableHover2').DataTable(); // ID From dataTable with Hover
					$('#dataTableHover3').DataTable();  // ID From dataTable with Hover
				});
			</script>
		</div>
	</div>
</body>

<!-- The Modal -->
<div class="modal fade" id="tambahSiswa">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Tambah Siswa</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<form class="forms-sample" method="POST" action="" enctype="multipart/form-data">
				<div class="modal-body">

					<!-- Username/NISN -->
					<div class="form-group">
						<label for="Username">Username/NISN <small class="text-danger">*</small></label>
						<input type="text" class="form-control" name="username" id="Username"
							placeholder="Masukkan Username atau NISN" required>
					</div>

					<!-- Nama -->
					<div class="form-group">
						<label for="Nama">Nama <small class="text-danger">*</small></label>
						<input type="text" class="form-control" name="nama" id="Nama" placeholder="Masukkan Nama"
							required>
					</div>

					<!-- Kelas -->
					<div class="form-group">
						<label for="Kelas">Kelas <small class="text-danger">*</small></label>
						<select class="form-control" name="kelas" id="Kelas" required>
							<option value="" disabled selected>Pilih Kelas</option>
							<optgroup label="IPA">
								<option value="IPA 1">IPA 1</option>
								<option value="IPA 2">IPA 2</option>
								<option value="IPA 3">IPA 3</option>
								<option value="IPA 4">IPA 4</option>
								<option value="IPA 5">IPA 5</option>
								<option value="IPA 6">IPA 6</option>
								<option value="IPA 7">IPA 7</option>
								<option value="IPA 8">IPA 8</option>
							</optgroup>
							<optgroup label="IPS">
								<option value="IPS 1">IPS 1</option>
								<option value="IPS 2">IPS 2</option>
								<option value="IPS 3">IPS 3</option>
								<option value="IPS 4">IPS 4</option>
							</optgroup>
						</select>
					</div>

					<!-- Tahun Masuk -->
					<div class="form-group">
						<label for="TahunMasuk">Tahun Masuk <small class="text-danger">*</small></label>
						<input type="number" class="form-control" name="tahun_masuk" id="TahunMasuk"
							placeholder="Masukkan Tahun Masuk" required min="2000" max="<?php echo date('Y'); ?>">
					</div>

					<!-- Upload Foto Profil -->
					<div class="form-group">
						<label>Upload Foto Profil</label>
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

					<!-- Tombol Submit -->
					<button type="submit" name="btnTambahSiswa" class="btn btn-primary mr-2">Simpan Perubahan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="tombolEdit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Siswa</h4>
				<button type="button" class="close" data-bs-dismiss="modal">&times;</button>
			</div>

			<form class="forms-sample" method="POST" action="" enctype="multipart/form-data">
				<div class="modal-body">

					<input type="text" name="id_user" id="idUser" hidden>
					<input type="text" name="foto_profil" id="FotoProfil" hidden>

					<div class="form-group">
						<label for="Username">Username <small class="text-danger">*</small></label>
						<input type="text" class="form-control" name="username" id="Username"
							placeholder="Masukkan Username">
					</div>

					<!-- Nama -->
					<div class="form-group">
						<label for="Nama">Nama <small class="text-danger">*</small></label>
						<input type="text" class="form-control" name="nama" id="Nama" placeholder="Masukkan Nama"
							required>
					</div>

					<!-- Kelas -->
					<div class="form-group">
						<label for="Kelas">Kelas <small class="text-danger">*</small></label>
						<select class="form-control" name="kelas" id="Kelas" required>
							<option value="" disabled selected>Pilih Kelas</option>
							<optgroup label="IPA">
								<option value="IPA 1">IPA 1</option>
								<option value="IPA 2">IPA 2</option>
								<option value="IPA 3">IPA 3</option>
								<option value="IPA 4">IPA 4</option>
								<option value="IPA 5">IPA 5</option>
								<option value="IPA 6">IPA 6</option>
								<option value="IPA 7">IPA 7</option>
								<option value="IPA 8">IPA 8</option>
							</optgroup>
							<optgroup label="IPS">
								<option value="IPS 1">IPS 1</option>
								<option value="IPS 2">IPS 2</option>
								<option value="IPS 3">IPS 3</option>
								<option value="IPS 4">IPS 4</option>
							</optgroup>
						</select>
					</div>

					<!-- Tahun Masuk -->
					<div class="form-group">
						<label for="TahunMasuk">Tahun Masuk <small class="text-danger">*</small></label>
						<input type="number" class="form-control" name="tahun_masuk" id="TahunMasuk"
							placeholder="Masukkan Tahun Masuk" required min="2000" max="<?php echo date('Y'); ?>">
					</div>

					<div class="form-group">
						<label>Upload Foto Profil</label>
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

					<label>Role User <small class="text-danger">*</small></label><br>
					<div class="form-group row">
						<div class="col-sm-5">
							<div class="form-check">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" name="role" id="rolePengunjung"
										value="Pengunjung" required>
									Pengunjung
								</label>
							</div>
						</div>
						<div class="col-sm-5">
							<div class="form-check">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" name="role" id="roleNonAktif"
										value="Non Aktif" required>
									Non Aktif
								</label>
							</div>
						</div>
					</div>
					<!-- Tombol Submit -->
					<button type="submit" name="btnEditSiswa" class="btn btn-primary mr-2">Simpan Perubahan</button>
				</div>
			</form>

		</div>
	</div>
</div>

<div class="modal fade" id="tombolReset">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Reset Password</h4>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <h4>Apakah Anda yakin ingin melakukan reset Password ?</h4>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <form action="" method="POST">
                    <input type="hidden" name="id_user" id="idUser">
                    <input type="hidden" name="username" id="Username">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="btnResetPass" class="btn btn-success">Setuju</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
	document.querySelector('.custom-file-input1').addEventListener('change', function (e) {
		const fileName = e.target.files[0]?.name || 'Pilih file...';
		const label = document.querySelector('label[for="uploadImage1"]'); // Pilih label berdasarkan atribut 'for'
		label.textContent = fileName; // Mengubah teks label

		// Menampilkan pratinjau gambar jika file adalah gambar
		const preview = document.getElementById('previewImage1');
	});


	// Update label saat file dipilih
	document.querySelector('.custom-file-input2').addEventListener('change', function (e) {
		const fileName = e.target.files[0]?.name || 'Pilih file...';
		const label = document.querySelector('label[for="uploadImage2"]'); // Pilih label berdasarkan atribut 'for'
		label.textContent = fileName; // Mengubah teks label

		// Menampilkan pratinjau gambar jika file adalah gambar
		const preview = document.getElementById('previewImage2');
	});
</script>

<script>
    $('#tombolEdit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang diklik
        var userId = button.data('id'); // Ambil ID User
        var username = button.data('username'); // Ambil Username
        var nama = button.data('nama'); // Ambil Nama
        var fotoProfil = button.data('foto_profil'); // Ambil Foto Profil
        var role = button.data('role'); // Ambil Role User
        var kelas = button.data('kelas'); // Ambil Kelas
        var tahunMasuk = button.data('tahun_masuk'); // Ambil Tahun Masuk

        // Masukkan data ke dalam field input di dalam modal
        var modal = $(this);
        modal.find('#idUser').val(userId); // Isi field ID User
        modal.find('#Username').val(username); // Isi field Username
        modal.find('#Nama').val(nama); // Isi field Nama
        modal.find('#FotoProfil').val(fotoProfil); // Isi field Foto Profil (jika berupa hidden input)
        modal.find('#Kelas').val(kelas); // Isi field Kelas (dropdown)
        modal.find('#TahunMasuk').val(tahunMasuk); // Isi field Tahun Masuk

        // Reset radio buttons role terlebih dahulu
        $('input[name="role"]').prop('checked', false); // Menghapus status yang terpilih sebelumnya

        // Menandai radio button yang sesuai dengan role
        if (role === "Pengunjung") {
            $('#rolePengunjung').prop('checked', true); // Check radio button Pengunjung
        } else if (role === "Non Aktif") {
            $('#roleNonAktif').prop('checked', true); // Check radio button Non Aktif
        }
    });
</script>

<script>
	$('#tombolReset').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Tombol yang diklik
		var userId = button.data('id'); // Ambil ID User
		var username = button.data('username'); // Ambil Username

		// Masukkan data ke dalam field input di dalam modal
		var modal = $(this);
		modal.find('#idUser').val(userId); // Isi field ID User
		modal.find('#Username').val(username); // Isi field Username
	});

</script>


<?php include "./crud/input_siswa.php" ?>
<?php include "./crud/edit_siswa.php" ?>
<?php include "./crud/reset_password.php" ?>

</html>