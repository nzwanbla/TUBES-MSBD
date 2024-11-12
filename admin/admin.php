<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/feather/feather.css">
  <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="../assets/js/select.dataTables.min.css">
  <link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../assets/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../assets/images/favicon.png" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/card.css">
  <link rel="stylesheet" href="../assets/css/flickity.css">

  <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
  
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <?php include "navbar.php"; ?>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li> -->
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
              </ul>
            </div>
            <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
              <p class="text-gray mb-0">The total number of sessions</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="../images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>

      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <?php include "sidebar.php"; ?>
      </nav>

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Selamat Datang, Admin !</h3>
                  <h6 class="font-weight-normal mb-0">Perpustakaan SMA Negeri 2 Binjai<span class="text-primary"></span></h6>
                </div>
                <div class="col-12 col-xl-4">
                 <div class="justify-content-end d-flex">
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                     <i class="mdi mdi-calendar"></i> Today (5 Nov 2024)
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                      <a class="dropdown-item" href="#">January - March</a>
                      <a class="dropdown-item" href="#">March - June</a>
                      <a class="dropdown-item" href="#">June - August</a>
                      <a class="dropdown-item" href="#">August - November</a>
                    </div>
                  </div>
                 </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="../assets/images/dashboard/people.svg" alt="people">
                  <div class="weather-info">
                    <div class="d-flex">
                      <div>
                        <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>
                      </div>
                      <div class="ml-2">
                        <h4 class="location font-weight-normal">Medan</h4>
                        <h6 class="font-weight-normal">Indonesia</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Total Buku</p>
                      <p class="fs-30 mb-2">4006</p>
                      <p>10.00% (30 days)</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Peminjaman Keseluruhan</p>
                      <p class="fs-30 mb-2">61344</p>
                      <p>22.00% (30 days)</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Laporan Denda</p>
                      <p class="fs-30 mb-2">34040</p>
                      <p>2.00% (30 days)</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Anggota Aktif</p>
                      <p class="fs-30 mb-2">47033</p>
                      <p>0.22% (30 days)</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Detail Peminjaman Buku</p>
                  <p class="font-weight-500">Laporan Detail Peminjaman Buku dari Anggota Perpustakaan</p>
                  <div class="d-flex flex-wrap mb-5">
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Total Buku</p>
                      <h3 class="text-primary fs-30 font-weight-medium">12.3k</h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Buku yang Sedang Dipinjam</p>
                      <h3 class="text-primary fs-30 font-weight-medium">14k</h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Persentase Buku Terpinjam</p>
                      <h3 class="text-primary fs-30 font-weight-medium">71.56%</h3>
                    </div>
                    <div class="mt-3">
                      <p class="text-muted">Total Anggota Terdaftar</p>
                      <h3 class="text-primary fs-30 font-weight-medium">34040</h3>
                    </div> 
                  </div>
                  <canvas id="order-chart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                 <div class="d-flex justify-content-between">
                  <p class="card-title">Laporan Aktivitas Peminjaman</p>
                  <a href="#" class="text-info">View all</a>
                 </div>
                  <p class="font-weight-500">Laporan Aktivitas Peminjaman dari Anggota Perpustakaan</p>
                  <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                  <canvas id="sales-chart"></canvas>
                </div>
              </div>
            </div>
          </div>

          <!-- katalog buku -->
          <div class="container">
        <div class="catalog" id="catalog">
            <h2>Katalog Buku</h2>
        </div>
        <div class="explore" id="explore">
            <a href="pages/katalog/katalog.php">Explore All</a>
        </div>
        </div>
          <div class="book-slide">
            <div class="book js-flickity" data-flickity-options='{ "wrapAround": true }'>
              <div class="book-cell">
                <div class="book-img">
                  <img src="https://images-na.ssl-images-amazon.com/images/I/81WcnNQ-TBL.jpg" alt="" class="book-photo">
                </div>
              <div class="book-content">
               <div class="book-title">BIG MAGIC</div>
               <div class="book-author">by Elizabeth Gilbert</div>
               <div class="rate">
                <fieldset class="rating">
                 <input type="checkbox" id="star5" name="rating" value="5" />
                 <label class="full" for="star5"></label>
                 <input type="checkbox" id="star4" name="rating" value="4" />
                 <label class="full" for="star4"></label>
                 <input type="checkbox" id="star3" name="rating" value="3" />
                 <label class="full" for="star3"></label>
                 <input type="checkbox" id="star2" name="rating" value="2" />
                 <label class="full" for="star2"></label>
                 <input type="checkbox" id="star1" name="rating" value="1" />
                 <label class="full" for="star1"></label>
                </fieldset>
                <span class="book-voters">1.987 voters</span>
               </div>
               <div class="book-sum">Readers of all ages and walks of life have drawn inspiration and empowerment from Elizabeth Gilbert’s books for years. </div>
               <div class="book-see" onclick="goToDetail('big-magic')">See The Book</div>
              </div>
             </div>
             <div class="book-cell">
              <div class="book-img">
               <img src="https://i.pinimg.com/originals/a8/b9/ff/a8b9ff74ed0f3efd97e09a7a0447f892.jpg" alt="" class="book-photo">
              </div>
              <div class="book-content">
               <div class="book-title">Ten Thousand Skies Above You</div>
               <div class="book-author">by Claudia Gray</div>
               <div class="rate">
                <fieldset class="rating blue">
                 <input type="checkbox" id="star6" name="rating" value="5" />
                 <label class="full1" for="star6"></label>
                 <input type="checkbox" id="star7" name="rating" value="4" />
                 <label class="full1" for="star7"></label>
                 <input type="checkbox" id="star8" name="rating" value="3" />
                 <label class="full1" for="star8"></label>
                 <input type="checkbox" id="star9" name="rating" value="2" />
                 <label class="full1" for="star9"></label>
                 <input type="checkbox" id="star10" name="rating" value="1" />
                 <label class="full1" for="star10"></label>
                </fieldset>
                <span class="book-voters">1.987 voters</span>
               </div>
               <div class="book-sum">The hunt for each splinter of Paul's soul sends Marguerite racing through a war-torn San Francisco.</div>
               <div class="book-see book-blue"  onclick="goToDetail('ten-thousand')">See The Book</div>
              </div>
             </div>
             <div class="book-cell">
              <div class="book-img">
               <img src="https://i.pinimg.com/originals/a8/b9/ff/a8b9ff74ed0f3efd97e09a7a0447f892.jpg" alt="" class="book-photo">
              </div>
              <div class="book-content">
               <div class="book-title">A Tale For The Time Being</div>
               <div class="book-author">by Ruth Ozeki</div>
               <div class="rate">
                <fieldset class="rating purple">
                 <input type="checkbox" id="star11" name="rating" value="5" />
                 <label class="full" for="star11"></label>
                 <input type="checkbox" id="star12" name="rating" value="4" />
                 <label class="full" for="star12"></label>
                 <input type="checkbox" id="star13" name="rating" value="3" />
                 <label class="full" for="star13"></label>
                 <input type="checkbox" id="star14" name="rating" value="2" />
                 <label class="full" for="star14"></label>
                 <input type="checkbox" id="star15" name="rating" value="1" />
                 <label class="full" for="star15"></label>
                </fieldset>
                <span class="book-voters">1.987 voters</span>
               </div>
               <div class="book-sum">In Tokyo, sixteen-year-old Nao has decided there’s only one escape from her aching loneliness and her classmates’ bullying.</div>
               <div class="book-see book-pink"  onclick="goToDetail('a-tale')">See The Book</div>
              </div>
             </div>
             <div class="book-cell">
              <div class="book-img">
               <img src="https://images-na.ssl-images-amazon.com/images/I/81af+MCATTL.jpg" alt="" class="book-photo">
              </div>
              <div class="book-content">
               <div class="book-title">The Great Gatsby</div>
               <div class="book-author">by F.Scott Fitzgerald</div>
               <div class="rate">
                <fieldset class="rating yellow">
                 <input type="checkbox" id="star16" name="rating" value="5" />
                 <label class="full" for="star16"></label>
                 <input type="checkbox" id="star17" name="rating" value="4" />
                 <label class="full" for="star17"></label>
                 <input type="checkbox" id="star18" name="rating" value="3" />
                 <label class="full" for="star18"></label>
                 <input type="checkbox" id="star19" name="rating" value="2" />
                 <label class="full" for="star19"></label>
                 <input type="checkbox" id="star20" name="rating" value="1" />
                 <label class="full" for="star20"></label>
                </fieldset>
                <span class="book-voters">1.987 voters</span>
               </div>
               <div class="book-sum">The Great Gatsby, F. Scott Fitzgerald’s third book, stands as the supreme achievement of his career.</div>
               <div class="book-see book-yellow"  onclick="goToDetail('the')">See The Book</div>
              </div>
             </div>
             <div class="book-cell">
              <div class="book-img">
               <img src="https://images-na.ssl-images-amazon.com/images/I/81UWB7oUZ0L.jpg" alt="" class="book-photo">
              </div>
              <div class="book-content">
               <div class="book-title">After You</div>
               <div class="book-author">by Jojo Moyes</div>
               <div class="rate">
                <fieldset class="rating dark-purp">
                 <input type="checkbox" id="star21" name="rating" value="5" />
                 <label class="full" for="star21"></label>
                 <input type="checkbox" id="star22" name="rating" value="4" />
                 <label class="full" for="star22"></label>
                 <input type="checkbox" id="star23" name="rating" value="3" />
                 <label class="full" for="star23"></label>
                 <input type="checkbox" id="star24" name="rating" value="2" />
                 <label class="full" for="star24"></label>
                 <input type="checkbox" id="star25" name="rating" value="1" />
                 <label class="full" for="star25"></label>
                </fieldset>
                <span class="book-voters">1.987 voters</span>
               </div>
               <div class="book-sum">Louisa Clark is no longer just an ordinary girl living an ordinary life. After the transformative six months spent.</div>
               <div class="book-see book-purple"  onclick="goToDetail('after-you')">See The Book</div>
              </div>
             </div>
            </div>
           </div>
          </div>
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
          </div>
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by <a href="https://www.themewagon.com/" target="_blank">Themewagon</a></span> 
          </div>
        </footer> 
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../vendors/chart.js/Chart.min.js"></script>
  <script src="../vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="../vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="../assets/js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../assets/js/off-canvas.js"></script>
  <script src="../assets/js/hoverable-collapse.js"></script>
  <script src="../assets/js/template.js"></script>
  <script src="../assets/js/settings.js"></script>
  <script src="../assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../assets/js/dashboard.js"></script>
  <script src="../assets/js/Chart.roundedBarCharts.js"></script>

  <!-- End custom js for this page-->
</body>

</html>

