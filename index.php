<?php
include "koneksi.php"; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Project Personal Journal</title>
    <link rel="icon" href="img/logo.png" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
      crossorigin="anonymous"
    />
    <style> 
      .banner {
       width: 100%;
       height: 220px; 
       object-fit: cover;
       border-radius: 10px;
      }
      .article-img {
       width: 100%;          
       height: 180px;        
       object-fit: cover;    
       border-radius: 6px;
       display: block;
       margin-left: auto;
       margin-right: auto;
      }
      .dark-theme {
        background-color: #121212 !important;
        color: #ffffff !important;
      }

      .dark-theme .navbar,
      .dark-theme footer {
        background-color: #222 !important;
      }

      .dark-theme .navbar-brand,
      .dark-theme .navbar-nav .nav-link {
        color: #ffffff !important;
      }

      .dark-theme .card {
        background-color: #1f1f1f !important;
        color: #ffffff !important;
      }

      .dark-theme footer i {
        color: #ffffff !important;
      }

      .dark-theme #gallery,
      .dark-theme #hero {
        background-color: #1b1b1b !important;
        color: #ffffff !important;
      }

      .dark-theme #schedule {
        background-color: #121212 !important;
        color: #ffffff !important;
      }

      .dark-theme #schedule .card {
        background-color: #1f1f1f !important;
        border: 1px solid #333 !important;
      }

      .dark-theme #schedule .text-muted {
        color: #bbb !important;
      }

      .dark-theme #schedule .border-bottom {
        border-bottom: 1px solid #333 !important;
      }

      .dark-theme .shadow {
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.5) !important;
      }

      * {
        transition: background-color 0.3s, color 0.3s;
      }

      .carousel-item img {
        height: 800px;
        width: 100%;
        object-fit: cover;
        object-position: center;
      }

      @media (max-width: 768px) {
        .carousel-item img {
          height: 300px;
        }
      }

      @media (max-width: 576px) {
        .carousel-item img {
          height: 200px;
        }
      }
    </style>
  </head>
  <body>
    <!-- nav begin -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
      <div class="container">
        <a class="navbar-brand" href="#">Web Daily Journal</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
            <li class="nav-item">
              <a class="nav-link" href="#hero">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#article">Article</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#gallery">Gallery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#schedule">Schedule</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#profile">Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php" target="_blank">Login</a>
            </li>
            <li class="nav-item d-flex align-items-center ms-3">
              <button id="btn-dark" class="btn btn-dark me-2">
                <i class="bi bi-moon-stars-fill"></i>
              </button>
              <button id="btn-light" class="btn btn-light border">
                <i class="bi bi-sun-fill"></i>
              </button>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- nav end -->
    <!-- hero begin -->
    <section id="hero" class="text-center p-5 bg-dark-subtle text-sm-start">
      <div class="container">
        <div class="d-sm-flex flex-sm-row-reverse align-items-center">
          <img src="img/banner.jpg" class="banner" alt="Banner"/>
          <div>
            <h1 class="fw-bold display-4">Web Daily Journal</h1>
            <h4 class="lead display-6">
              Personal Web Daily Journal Berisi Tentang Dunia Perkuliahan Saya
            </h4>
            <h6>
              <span id="tanggal"></span>
              <span id="jam"></span>
            </h6>
          </div>
        </div>
      </div>
    </section>
    <!-- hero end -->
    <!-- article begin -->
<section id="article" class="text-center p-5">
  <div class="container">
    <h1 class="fw-bold display-4 pb-3">Article</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
      <?php
      $sql = "SELECT * FROM article ORDER BY tanggal DESC";
      $hasil = $conn->query($sql); 

      while($row = $hasil->fetch_assoc()){
      ?>
        <div class="col">
          <div class="card h-100">
            <img src="img/<?php echo $row['gambar']; ?>" class="article-img">
            <div class="card-body">
              <h5 class="card-title"><?= $row["judul"]?></h5>
              <p class="card-text">
                <?= $row["isi"]?>
              </p>
            </div>
            <div class="card-footer">
              <small class="text-body-secondary">
                <?= $row["tanggal"]?>
              </small>
            </div>
          </div>
        </div>
        <?php
      }
      ?> 
    </div>
  </div>
</section>
<!-- article end -->
<!-- gallery begin -->
    <section id="gallery" class="text-center p-5 bg-danger-subtle">
  <div class="container">
    <h1 class="fw-bold display-4 pb-3">Gallery</h1>
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <?php
        $sql = "SELECT * FROM gallery ORDER BY tanggal DESC";
        $hasil = $conn->query($sql);
        
        $active = "active"; 
        if ($hasil->num_rows > 0) {
            while($row = $hasil->fetch_assoc()) {
                ?>
                <div class="carousel-item <?= $active ?>">
                  <img src="img/<?= $row['gambar'] ?>" class="d-block w-100 banner" alt="<?= $row['judul'] ?>">
                  <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
                    <h5><?= $row['judul'] ?></h5>
                  </div>
                </div>
                <?php
                $active = ""; 
            }
        } else {
            echo '
            <div class="carousel-item active">
              <img src="img/default.jpg" class="d-block w-100 banner" alt="No Image">
            </div>';
        }
        ?>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-view="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-next="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</section>
    <!-- gallery end -->
    <!-- footer begin -->
    <section id="schedule" class="container-fluid bg-light py-5">
      <div class="container">
        <h2 class="text-center mb-4 fw-bold">Jadwal Kuliah</h2>

        <div
          class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center"
        >
          <div class="col">
            <div class="card h-100 shadow border-0">
              <div class="card-header bg-primary text-white text-center">
                <h5 class="fw-bold mb-0">Senin</h5>
              </div>
              <div class="card-body p-4">
                <ul class="list-unstyled mb-0">
                  <li class="mb-3 pb-3 border-bottom">
                    <div class="fw-bold">Sistem Informasi</div>
                    <div
                      class="d-flex align-items-center text-muted small mt-1"
                    >
                      <i class="bi bi-clock me-2"></i>
                      <span>07:00 - 09:30</span>
                    </div>
                    <div class="d-flex align-items-center text-muted small">
                      <i class="bi bi-geo-alt me-2"></i>
                      <span>H.4.10</span>
                    </div>
                  </li>
                  <li class="mb-3 pb-3 border-bottom">
                    <div class="fw-bold">Basis Data Teori</div>
                    <div
                      class="d-flex align-items-center text-muted small mt-1"
                    >
                      <i class="bi bi-clock me-2"></i>
                      <span>10:20 - 12:00</span>
                    </div>
                    <div class="d-flex align-items-center text-muted small">
                      <i class="bi bi-geo-alt me-2"></i>
                      <span>H.5.4</span>
                    </div>
                  </li>
                  <li>
                    <div class="fw-bold">Pendidikan Kewarganegaraan</div>
                    <div
                      class="d-flex align-items-center text-muted small mt-1"
                    >
                      <i class="bi bi-clock me-2"></i>
                      <span>12:30 - 14:10</span>
                    </div>
                    <div class="d-flex align-items-center text-muted small">
                      <i class="bi bi-laptop me-2"></i>
                      <span>Kulino</span>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card h-100 shadow border-0">
              <div class="card-header bg-primary text-white text-center">
                <h5 class="fw-bold mb-0">Selasa</h5>
              </div>
              <div class="card-body p-4">
                <ul class="list-unstyled mb-0">
                  <li class="mb-3 pb-3 border-bottom">
                    <div class="fw-bold">Basis Data Praktek</div>
                    <div
                      class="d-flex align-items-center text-muted small mt-1"
                    >
                      <i class="bi bi-clock me-2"></i>
                      <span>08:40 - 10:20</span>
                    </div>
                    <div class="d-flex align-items-center text-muted small">
                      <i class="bi bi-geo-alt me-2"></i>
                      <span>D.2.K</span>
                    </div>
                  </li>
                  <li>
                    <div class="fw-bold">Sistem Operasi</div>
                    <div
                      class="d-flex align-items-center text-muted small mt-1"
                    >
                      <i class="bi bi-clock me-2"></i>
                      <span>12:30 - 15:00</span>
                    </div>
                    <div class="d-flex align-items-center text-muted small">
                      <i class="bi bi-geo-alt me-2"></i>
                      <span>H.5.7</span>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card h-100 shadow border-0">
              <div class="card-header bg-primary text-white text-center">
                <h5 class="fw-bold mb-0">Rabu</h5>
              </div>
              <div class="card-body p-4">
                <ul class="list-unstyled mb-0">
                  <li class="mb-3 pb-3 border-bottom">
                    <div class="fw-bold">Probabilitas & Statistik</div>
                    <div
                      class="d-flex align-items-center text-muted small mt-1"
                    >
                      <i class="bi bi-clock me-2"></i>
                      <span>07:00 - 09:30</span>
                    </div>
                    <div class="d-flex align-items-center text-muted small">
                      <i class="bi bi-geo-alt me-2"></i>
                      <span>H.4.4</span>
                    </div>
                  </li>
                  <li>
                    <div class="fw-bold">Pemrograman Berbasis Web</div>
                    <div
                      class="d-flex align-items-center text-muted small mt-1"
                    >
                      <i class="bi bi-clock me-2"></i>
                      <span>10:20 - 12:00</span>
                    </div>
                    <div class="d-flex align-items-center text-muted small">
                      <i class="bi bi-geo-alt me-2"></i>
                      <span>D.2.J</span>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card h-100 shadow border-0">
              <div class="card-header bg-primary text-white text-center">
                <h5 class="fw-bold mb-0">Kamis</h5>
              </div>
              <div class="card-body p-4">
                <ul class="list-unstyled mb-0">
                  <li>
                    <div class="fw-bold">Logika Informatika</div>
                    <div
                      class="d-flex align-items-center text-muted small mt-1"
                    >
                      <i class="bi bi-clock me-2"></i>
                      <span>07:00 - 09:30</span>
                    </div>
                    <div class="d-flex align-items-center text-muted small">
                      <i class="bi bi-geo-alt me-2"></i>
                      <span>H.4.10</span>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card h-100 shadow border-0">
              <div class="card-header bg-primary text-white text-center">
                <h5 class="fw-bold mb-0">Jumat</h5>
              </div>
              <div class="card-body p-4">
                <ul class="list-unstyled mb-0">
                  <li>
                    <div class="fw-bold">Rekayasa Perangkat Lunak</div>
                    <div
                      class="d-flex align-items-center text-muted small mt-1"
                    >
                      <i class="bi bi-clock me-2"></i>
                      <span>07:00 - 09:30</span>
                    </div>
                    <div class="d-flex align-items-center text-muted small">
                      <i class="bi bi-geo-alt me-2"></i>
                      <span>H.4.3</span>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- schedule end -->
    <!-- profile begin -->
    <section id="profile" class="container py-5">
      <h2 class="text-center mb-4 fw-bold">Profile</h2>

      <div class="row justify-content-center align-items-center">
        <!-- Foto -->
        <div class="col-12 col-md-4 text-center mb-4 mb-md-0">
          <img
            src="img/profile.jpeg"
            class="rounded-circle img-fluid shadow"
            alt="Foto Profile"
            style="width: 200px; height: 200px; object-fit: cover"
          />
        </div>

        <!-- Card + Table -->
        <div class="col-12 col-md-6">
          <div class="card shadow">
            <div class="card-body">
              <table class="table table-borderless text-center">
                <tr>
                  <th>Nama</th>
                  <td>Muhammad Cahya Kuncoro</td>
                </tr>
                <tr>
                  <th>NIM</th>
                  <td>A11.2024,15899</td>
                </tr>
                <tr>
                  <th>Program Studi</th>
                  <td>Teknik Informatika</td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td>cahyamuhamad2005@gmail.com</td>
                </tr>
                <tr>
                  <th>No. Telp</th>
                  <td>087830690450</td>
                </tr>
                <tr>
                  <th>Alamat</th>
                  <td>Jalan Tirto Agung Barat 3</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- profile end -->
    <!-- footer begin -->
    <footer class="text-center p-5">
      <div>
        <a href="https://www.instagram.com/koenigsegg/"
          ><i class="bi bi-instagram h2 p-2 text-dark"></i
        ></a>
        <a href="https://x.com/koenigsegg"
          ><i class="bi bi-twitter h2 p-2 text-dark"></i
        ></a>
        <a href="https://www.koenigsegg.com/contact"
          ><i class="bi bi-whatsapp h2 p-2 text-dark"></i
        ></a>
      </div>
      <div>Muhammad Cahya Kuncoro (A11.2024.15899) &copy; 2025</div>
    </footer>
    <!-- footer end -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
      crossorigin="anonymous"
    ></script>
    <script type="text/javascript">
      window.setTimeout("tampilWaktu()", 1000);

      function tampilWaktu() {
        var waktu = new Date();
        var bulan = waktu.getMonth() + 1;

        setTimeout("tampilWaktu()", 1000);
        document.getElementById("tanggal").innerHTML =
          waktu.getDate() + "/" + bulan + "/" + waktu.getFullYear();
        document.getElementById("jam").innerHTML =
          waktu.getHours() +
          ":" +
          waktu.getMinutes() +
          ":" +
          waktu.getSeconds();
      }

      const body = document.body;
      const btnDark = document.getElementById("btn-dark");
      const btnLight = document.getElementById("btn-light");

      btnDark.addEventListener("click", function () {
        body.classList.add("dark-theme");
      });

      btnLight.addEventListener("click", function () {
        body.classList.remove("dark-theme");
      });
    </script>
    <script>
      document.querySelectorAll("a.nav-link").forEach((link) => {
        link.addEventListener("click", function (e) {
          if (this.getAttribute("href").startsWith("#")) {
            e.preventDefault();
            document.querySelector(this.getAttribute("href")).scrollIntoView({
              behavior: "smooth",
            });
          }
        });
      });
    </script>
  </body>
</html>
