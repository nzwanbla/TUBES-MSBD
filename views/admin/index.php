<?php

    require './include/Admin_function.php';

    if (empty($_SESSION['username']) or $_SESSION['status'] != 'Admin')
    {
        header("Location: ../login.php");
    }

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

      <!-- to do list.php -->
      <?php
      include "../../include/to_do_list.php";
      ?>

      <!-- sidebar.php -->
      <?php
      include "./include/sidebar.php";
      ?>

      <!-- Tampilan main yang diubah tiap file -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Selamat Datang, <?=$_SESSION['nama']?> !</h3>
                  <h6 class="font-weight-normal mb-0">Perpustakaan SMA Negeri 2 Binjai<span class="text-primary"></span>
                  </h6>
                </div>
                <div class="col-12 col-xl-4">
                  <div class="justify-content-end d-flex">
                    <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                      <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
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
                  <img src="../../assets/images/dashboard/people.svg" alt="people">
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
                  <div class="book-sum">Readers of all ages and walks of life have drawn inspiration and empowerment
                    from Elizabeth Gilbert’s books for years. </div>
                  <div class="book-see" onclick="goToDetail('big-magic')">See The Book</div>
                </div>
              </div>
              <div class="book-cell">
                <div class="book-img">
                  <img src="https://i.pinimg.com/originals/a8/b9/ff/a8b9ff74ed0f3efd97e09a7a0447f892.jpg" alt=""
                    class="book-photo">
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
                  <div class="book-sum">The hunt for each splinter of Paul's soul sends Marguerite racing through a
                    war-torn San Francisco.</div>
                  <div class="book-see book-blue" onclick="goToDetail('ten-thousand')">See The Book</div>
                </div>
              </div>
              <div class="book-cell">
                <div class="book-img">
                  <img src="https://i.pinimg.com/originals/a8/b9/ff/a8b9ff74ed0f3efd97e09a7a0447f892.jpg" alt=""
                    class="book-photo">
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
                  <div class="book-sum">In Tokyo, sixteen-year-old Nao has decided there’s only one escape from her
                    aching loneliness and her classmates’ bullying.</div>
                  <div class="book-see book-pink" onclick="goToDetail('a-tale')">See The Book</div>
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
                  <div class="book-sum">The Great Gatsby, F. Scott Fitzgerald’s third book, stands as the supreme
                    achievement of his career.</div>
                  <div class="book-see book-yellow" onclick="goToDetail('the')">See The Book</div>
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
                  <div class="book-sum">Louisa Clark is no longer just an ordinary girl living an ordinary life. After
                    the transformative six months spent.</div>
                  <div class="book-see book-purple" onclick="goToDetail('after-you')">See The Book</div>
                </div>
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

  </div>

  <?php include "./include/js.php"; ?>

</body>

</html>