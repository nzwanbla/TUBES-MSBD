<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="../../vendors/feather/feather.css">
  <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="../../assets/css/vertical-layout-light/style.css">
  <link rel="stylesheet" href="../../assets/css/tabs_admin.css">
  <link rel="stylesheet" href="../../assets/vendor/simple-datatables/style.css">
  <link rel="stylesheet" href="../../assets/vendor/datatables/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="shortcut icon" href="../../assets/images/favicon.png" />

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

<ul id="nav-tabs">
  <li><a href="#">X</a>
    <section style="max-height: 500px; overflow-y: auto;">
   
    <div class="card mb-4">
                <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
                  <h4 class="m-0 font-weight-bold text-primary">Data Siswa</h4>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    Tambah Siswa
                </button>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover1">
                    <thead class="bg-primary text-white">
                      <tr>
                        <th>No</th>
                        <th>Profile</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>NIS</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td></td>
                        <td>aldi</td>
                        <td>Aldi</td>
                        <td>X IPA-1</td>
                        <td>12345678</td>
                        <td>
                            <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus<?php echo $data['']; ?>">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td></td>
                        <td>budi123</td>
                        <td>Budi</td>
                        <td>XI IPS-2</td>
                        <td>9382804</td>
                        <td>
                        <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus<?php echo $data['']; ?>">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td></td>
                        <td>citra456</td>
                        <td>Citra</td>
                        <td>X IPA-3</td>
                        <td>23201930</td>
                        <td>
                        <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus<?php echo $data['']; ?>">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td></td>
                        <td>mahennsdkj</td>
                        <td>Mahen</td>
                        <td>XII IPS-4</td>
                        <td>91289387</td>
                        <td>
                        <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus<?php echo $data['']; ?>">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td></td>
                        <td>laila098</td>
                        <td>Laila</td>
                        <td>XI IPA-1</td>
                        <td>29849209</td>
                        <td>
                        <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus<?php echo $data['']; ?>">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>6</td>
                        <td></td>
                        <td>putra</td>
                        <td>Putra</td>
                        <td>X IPS-2</td>
                        <td>93801288</td>
                        <td>
                        <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus<?php echo $data['']; ?>">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
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
                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    Tambah Siswa
                </button>
               </div>
               <div class="table-responsive p-3">
                 <table class="table align-items-center table-flush table-hover" id="dataTableHover2">
                   <thead class="bg-primary text-white">
                   <tr>
                        <th>No</th>
                        <th>Profile</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>NIS</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td></td>
                        <td>aldi</td>
                        <td>Aldi</td>
                        <td>X IPA-1</td>
                        <td>12345678</td>
                        <td>
                            <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus<?php echo $data['']; ?>">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td></td>
                        <td>budi123</td>
                        <td>Budi</td>
                        <td>XI IPS-2</td>
                        <td>9382804</td>
                        <td>
                        <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus<?php echo $data['']; ?>">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td></td>
                        <td>citra456</td>
                        <td>Citra</td>
                        <td>X IPA-3</td>
                        <td>23201930</td>
                        <td>
                        <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus<?php echo $data['']; ?>">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td></td>
                        <td>mahennsdkj</td>
                        <td>Mahen</td>
                        <td>XII IPS-4</td>
                        <td>91289387</td>
                        <td>
                        <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus<?php echo $data['']; ?>">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td></td>
                        <td>laila098</td>
                        <td>Laila</td>
                        <td>XI IPA-1</td>
                        <td>29849209</td>
                        <td>
                        <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus<?php echo $data['']; ?>">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>6</td>
                        <td></td>
                        <td>putra</td>
                        <td>Putra</td>
                        <td>X IPS-2</td>
                        <td>93801288</td>
                        <td>
                        <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus<?php echo $data['']; ?>">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
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
                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    Tambah Siswa
                </button>
               </div>
               <div class="table-responsive p-3">
                 <table class="table align-items-center table-flush table-hover" id="dataTableHover3">
                   <thead class="bg-primary text-white">
                   <tr>
                        <th>No</th>
                        <th>Profile</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>NIS</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td></td>
                        <td>aldi</td>
                        <td>Aldi</td>
                        <td>X IPA-1</td>
                        <td>12345678</td>
                        <td>
                            <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus<?php echo $data['']; ?>">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td></td>
                        <td>budi123</td>
                        <td>Budi</td>
                        <td>XI IPS-2</td>
                        <td>9382804</td>
                        <td>
                        <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus<?php echo $data['']; ?>">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td></td>
                        <td>citra456</td>
                        <td>Citra</td>
                        <td>X IPA-3</td>
                        <td>23201930</td>
                        <td>
                        <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus<?php echo $data['']; ?>">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td></td>
                        <td>mahennsdkj</td>
                        <td>Mahen</td>
                        <td>XII IPS-4</td>
                        <td>91289387</td>
                        <td>
                        <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus<?php echo $data['']; ?>">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td></td>
                        <td>laila098</td>
                        <td>Laila</td>
                        <td>XI IPA-1</td>
                        <td>29849209</td>
                        <td>
                        <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus<?php echo $data['']; ?>">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>6</td>
                        <td></td>
                        <td>putra</td>
                        <td>Putra</td>
                        <td>X IPS-2</td>
                        <td>93801288</td>
                        <td>
                        <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus<?php echo $data['']; ?>">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                   </tbody>
                 </table>
               </div>
             </div>
   </section>
  </li>
</ul>

  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <script src="../../assets/js/off-canvas.js"></script>
  <script src="../../assets/js/hoverable-collapse.js"></script>
  <script src="../../assets/js/template.js"></script>
  <script src="../../assets/js/settings.js"></script>
  <script src="../../assets/js/todolist.js"></script>
  <script src="../../assets/js/tabs_admin.js"></script>
  <script src="../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="../../assets/js/main.js"></script>

  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover1').DataTable(); // ID From dataTable with Hover
      $('#dataTableHover2').DataTable(); // ID From dataTable with Hover
      $('#dataTableHover3').DataTable();  // ID From dataTable with Hover
    });
  </script>
</body>
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Siswa</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post">
        <div class="modal-body">
        <label>Username <small class="text-danger">*</small></label>
          <input type="text" name="username" placeholder="Username" class="form-control" required>
          <br>
          <label>Nama <small class="text-danger">*</small></label>
          <input type="text" name="nama" placeholder="Nama" class="form-control" required>
          <br>
          <label>Kelas <small class="text-danger">*</small></label>
          <input type="text" name="kelas" placeholder="Kelas" class="form-control" required>
          <br>
          <label>NIS <small class="text-danger">*</small></label>
          <input type="text" name="NIS" placeholder="NIS" class="form-control" required>
          <br>
          <button type="submit" class="btn btn-primary" name="addnewsiswa">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</html>