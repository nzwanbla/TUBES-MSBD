<?php

require './include/Admin_function.php';

if (empty($_SESSION['username']) or $_SESSION['status'] != 'Admin') {
	header("Location: ./error-403.php");
}

$res = getDataPetugas();
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
				<li><a href="#">Data Petugas</a>
					<section style="max-height: 500px; overflow-y: auto;">
						<div class="card mb-4">
							<div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
								<h4 class="m-0 font-weight-bold text-primary">Data Petugas</h4>
								<!-- Button to Open the Modal -->
								<button type="button" class="btn btn-primary" data-toggle="modal"
									data-target="#tambahPetugas">
									Tambah Petugas
								</button>
							</div>
							<div class="table-responsive p-3">
								<table class="table align-items-center table-flush table-hover" id="dataTableHover">
									<thead class="bg-primary text-white">
										<tr>
											<th>No</th>
											<th>Profile</th>
											<th>Username</th>
											<th>Nama</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 1;
										foreach ($res as $data) {
											?>
											<tr>
												<td><?= $i ?></td>
												<td><img src="<?= $data['foto_profil'] ?>" alt="<?= $data['nama'] ?>"
														width="50" height="75"></td>
												<td><?= $data['username'] ?></td>
												<td><?= $data['nama'] ?></td>
												<td>
													<button type="button"
														class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center"
														data-bs-toggle="modal" data-bs-target="#tombolEdit"
														data-id="<?= $data['id_user'] ?>"
														data-username="<?= $data['username'] ?>"
														data-nama="<?= $data['nama'] ?>"
														data-foto_profil="<?= $data['foto_profil'] ?>"
														data-role="<?= $data['role'] ?>">
														<i class="bi bi-pencil"></i>
													</button>
													<button type="button"
														class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center"
														data-bs-toggle="modal" data-bs-target="#tombolReset"
														data-id="<?= $data['id_user'] ?>"
														data-username="<?= $data['username'] ?>">
														<i class="bi bi-arrow-repeat"></i>
													</button>
												</td>
											</tr>
											<?php $i++;
										} ?>
									</tbody>
								</table>
							</div>
						</div>
					</section>
				</li>

			</ul>
			<!-- Tampilan main yang diubah tiap file -->

		</div>
		<!-- include/footer.php -->
		<?php
		include "../../include/footer.php";
		?>
	</div>
	</div>

	<?php include "./include/js.php"; ?>

	<!-- Page level custom scripts -->
	<script>
		$(document).ready(function () {
			$('#dataTable').DataTable(); // ID From dataTable 
			$('#dataTableHover').DataTable(); // ID From dataTable with Hover
		});
	</script>
</body>
<!-- The Modal -->
<div class="modal fade" id="tambahPetugas">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Tambah Petugas</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<form class="forms-sample" method="POST" action="" enctype="multipart/form-data">
				<div class="modal-body">

					<div class="form-group">
						<label for="Username">Username <small class="text-danger">*</small></label>
						<input type="text" class="form-control" name="username" id="Username"
							placeholder="Masukkan Username" required>
					</div>

					<!-- Nama -->
					<div class="form-group">
						<label for="Nama">Nama <small class="text-danger">*</small></label>
						<input type="text" class="form-control" name="nama" id="Nama" placeholder="Masukkan Nama"
							required>
					</div>

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
					<button type="submit" name="btnTambahPetugas" class="btn btn-primary mr-2">Simpan Perubahan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="tombolEdit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Petugas</h4>
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
									<input type="radio" class="form-check-input" name="role" id="rolePetugas"
										value="Petugas" required>
									Petugas
								</label>
							</div>
						</div>
						<div class="col-sm-5">
							<div class="form-check">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" name="role" id="statusNonAktif"
										value="Non Aktif" required>
									Non Aktif
								</label>
							</div>
						</div>
					</div>
					<!-- Tombol Submit -->
					<button type="submit" name="btnEditPetugas" class="btn btn-primary mr-2">Simpan Perubahan</button>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="btnResetPass" class="btn btn-danger">Setuju</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
	$('#tombolEdit').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Tombol yang diklik
		var userId = button.data('id'); // Ambil ID User
		var username = button.data('username'); // Ambil Username
		var nama = button.data('nama'); // Ambil Nama
		var fotoProfil = button.data('foto_profil'); // Ambil Foto Profil
		var role = button.data('role'); // Ambil Role User

		// Masukkan data ke dalam field input di dalam modal
		var modal = $(this);
		modal.find('#idUser').val(userId); // Isi field ID User
		modal.find('#Username').val(username); // Isi field Username
		modal.find('#Nama').val(nama); // Isi field Nama
		modal.find('#FotoProfil').val(fotoProfil); // Isi field Foto Profil (jika berupa hidden input)

		// Reset radio buttons role terlebih dahulu
		$('input[name="role"]').prop('checked', false); // Menghapus status yang terpilih sebelumnya

		// Menandai radio button yang sesuai dengan role
		if (role === "Petugas") {
			$('#rolePetugas').prop('checked', true); // Check radio button Petugas
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

<?php include "./crud/edit_petugas.php" ?>
<?php include "./crud/input_petugas.php" ?>
<?php include "./crud/reset_password.php" ?>

</html>