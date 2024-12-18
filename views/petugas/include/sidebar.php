<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="./index.php">
        <i class="mdi mdi-trello menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#userMenu" role="button" aria-expanded="false" aria-controls="userMenu">
        <i class="mdi mdi-account-multiple menu-icon"></i>
        <span class="menu-title">Manajemen User</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="userMenu">
        <ul class="nav flex-column sub-menu">
          
          <li class="nav-item">
            <a class="nav-link" href="./data_siswa.php">
              <i class="mdi mdi-account-multiple-outline menu-icon"></i>
              <span class="menu-title">Siswa</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./data_guru.php">
              <i class="mdi mdi-school menu-icon"></i>
              <span class="menu-title">Guru</span>
            </a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#bookMenu" role="button" aria-expanded="false" aria-controls="bookMenu">
        <i class="mdi mdi-book-open-page-variant menu-icon"></i>
        <span class="menu-title">Manajemen Buku</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="bookMenu">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="./data_buku.php">
              <i class="mdi mdi-book-multiple menu-icon"></i>
              <span class="menu-title">Data Buku</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./katalog.php">
              <i class="bi bi-bookshelf menu-icon"></i>
              <span class="menu-title">Katalog Buku</span>
            </a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#peminjamanMenu" role="button" aria-expanded="false"
        aria-controls="peminjamanMenu">
        <i class="mdi mdi-account-card-details menu-icon"></i>
        <span class="menu-title">Manajemen Pinjaman</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="peminjamanMenu">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="./data_peminjaman.php">
              <i class="mdi mdi-account-card-details menu-icon"></i>
              <span class="menu-title">Peminjaman</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./data_request_perpanjangan.php">
              <i class="mdi mdi-bookmark-plus-outline menu-icon"></i>
              <span class="menu-title">Perpanjangan</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./data_denda.php">
              <i class="mdi mdi-wallet-outline menu-icon"></i>
              <span class="menu-title">Denda</span>
            </a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../logout.php">
        <i class="mdi mdi-logout menu-icon"></i>
        <span class="menu-title">Logout</span>
      </a>
    </li>
  </ul>
</nav>
