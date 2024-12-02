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

      <!-- to do list.php -->
      <?php
      include "../../include/to_do_list.php";
      ?>

      <!-- sidebar.php -->
      <?php
      include "./include/sidebar.php";
      ?>

      <!-- Tampilan main yang diubah tiap file -->
      <div class="col-lg-10">
              <div class="card mb-4">
                <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
                  <h4 class="m-0 font-weight-bold text-primary">Data Denda</h4>
                   <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                        Tambah Denda
                    </button>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="bg-primary text-white">
                      <tr>
                      <th>No</th>
                       <th>ID User</th>
                       <th>Nominal Denda</th>
                       <th>Keterangan</th>
                       <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>1290192</td>
                        <td>10.000</td>
                        <td>Telat 2 hari</td>
                        <td>
                        <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
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
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Denda</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post">
        <div class="modal-body">
        <label>ID User <small class="text-danger">*</small></label>
          <input type="text" name="id_user" placeholder="ID User" class="form-control" required>
          <br>
          <label>Nominal Denda <small class="text-danger">*</small></label>
          <input type="text" name="denda" placeholder="Denda" class="form-control" required>
          <br>
          <label>Keterangan <small class="text-danger">*</small></label>
          <input type="text" name="keterangan" placeholder="Keterangan" class="form-control" required>
          <br>
          <button type="submit" class="btn btn-primary" name="addnewpetugas">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</html>