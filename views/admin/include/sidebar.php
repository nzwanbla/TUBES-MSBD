<!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="../admin/index.php">
              <i class="mdi mdi-trello menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/add_books.php">
              <i class="mdi mdi-book-open-page-variant menu-icon"></i>
              <span class="menu-title">Books</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#user" aria-expanded="false" aria-controls="user">
              <i class="mdi mdi-account-multiple menu-icon"></i>
              <span class="menu-title">User Management</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="user">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> 
                  <a class="nav-link" href="../admin/petugas.php">
                  <i class="mdi mdi-account-tie menu-icon"></i>  
                  <span class="menu-title">Petugas</span>
                  </a>
                </li>
                <li class="nav-item"> 
                  <a class="nav-link" href="../admin/siswa.php">
                  <i class="mdi mdi-school menu-icon"></i>  
                  <span class="menu-title">Siswa</span>
                  </a>
                </li>
                <li class="nav-item"> 
                  <a class="nav-link" href="../admin/guru.php">
                  <i class="mdi mdi-account-multiple-outline menu-icon"></i>  
                  <span class="menu-title">Guru</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="../admin/data_peminjaman.php">
                <i class="mdi mdi-account-card-details menu-icon"></i>
                <span class="menu-title">Data Peminjaman</span>
              </a>
            </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/logout_admin.php">
              <i class="mdi mdi-logout menu-icon"></i>
              <span class="menu-title">Logout</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->