<!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="../petugas/index.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../petugas/data_buku.php">
              <i class="mdi mdi-book-open-page-variant menu-icon"></i>
              <span class="menu-title">Books</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#laporan" aria-expanded="false" aria-controls="laporan">
              <i class="mdi mdi-account-multiple menu-icon"></i>
              <span class="menu-title">Laporan</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="laporan">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="../petugas/peminjaman.php">Data Peminjaman</a></li>
                <li class="nav-item"> <a class="nav-link" href="../petugas/pengembalian.php">Data Pengembalian</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="../petugas/denda.php">
                <i class="mdi mdi-account-card-details menu-icon"></i>
                <span class="menu-title">Data Denda</span>
              </a>
          <li class="nav-item">
            <a class="nav-link" href="../petugas/logout_petugas.php">
              <i class="mdi mdi-logout menu-icon"></i>
              <span class="menu-title">Logout</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->