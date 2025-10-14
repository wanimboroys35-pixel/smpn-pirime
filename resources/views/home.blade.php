<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PPDB Online | SMP Negeri 1 Pirime</title>

  <!-- Font & Icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    * {margin:0; padding:0; box-sizing:border-box;}
    body {
      font-family: "Poppins", "Segoe UI", sans-serif;
      background: #f7f9fc;
      color: #222;
      scroll-behavior: smooth;
    }

    /* ===== NAVBAR ===== */
    nav {
      position: fixed;
      top: 0;
      width: 100%;
      padding: 12px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: linear-gradient(90deg, #002b6d, #003b9a);
      box-shadow: 0 4px 18px rgba(0, 0, 0, 0.4);
      z-index: 1000;
    }

    nav .logo {
      display: flex;
      align-items: center;
      text-decoration: none;
      gap: 10px;
    }

    nav .logo img {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      border: 2px solid #fff;
    }

    nav .logo h3 {
      color: #fff;
      font-size: 1.1rem;
      font-weight: 700;
    }

    nav ul {
      display: flex;
      gap: 25px;
      list-style: none;
    }

    nav ul li a {
      color: #fff;
      text-decoration: none;
      font-weight: 500;
      padding: 6px 14px;
      border-radius: 8px;
      transition: 0.3s;
    }

    nav ul li a:hover,
    nav ul li a.active {
      background: #ffc107;
      color: #002b6d;
    }

    /* ===== HAMBURGER MENU ===== */
    .hamburger {
      display: none;
      flex-direction: column;
      gap: 5px;
      cursor: pointer;
    }

    .hamburger div {
      width: 26px;
      height: 3px;
      background: #fff;
      border-radius: 2px;
      transition: all 0.3s;
    }

    @media(max-width:768px){
      .hamburger {display:flex;}
      nav ul {
        position: fixed;
        top: 0;
        right: -100%;
        height: 100vh;
        width: 250px;
        background: rgba(0,0,50,0.97);
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: right 0.4s ease;
      }
      nav ul.show { right: 0; }
      .hamburger.active div:nth-child(1){transform:rotate(45deg) translate(5px,5px);}
      .hamburger.active div:nth-child(2){opacity:0;}
      .hamburger.active div:nth-child(3){transform:rotate(-45deg) translate(5px,-5px);}
    }

    /* ===== SLIDER ===== */
    .slider {
      margin-top: 70px;
      position: relative;
      width: 100%;
      height: 75vh;
      overflow: hidden;
    }

    .slide {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0;
      transition: opacity 1s ease-in-out;
    }

    .slide.active {
      opacity: 1;
      z-index: 2;
    }

    .slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      filter: brightness(0.8);
    }

    .slide-caption {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: rgba(0,0,0,0.45);
      color: #fff;
      text-align: center;
      padding: 25px 40px;
      border-radius: 12px;
      backdrop-filter: blur(6px);
    }

    .slide-caption h2 {
      font-size: 2rem;
      margin-bottom: 10px;
    }

    .slide-caption p {
      font-size: 1rem;
    }

    .dots {
      position: absolute;
      bottom: 20px;
      width: 100%;
      text-align: center;
    }

    .dots span {
      height: 12px;
      width: 12px;
      margin: 0 4px;
      display: inline-block;
      background-color: rgba(255,255,255,0.6);
      border-radius: 50%;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .dots span.active {
      background-color: #ffc107;
      transform: scale(1.2);
    }

    /* ===== MAIN CONTENT ===== */
    main {
      text-align: center;
      padding: 70px 20px;
      background: #fff;
    }

    main h1 {
      font-size: 2.3rem;
      color: #003366;
      margin-bottom: 15px;
    }

    main p {
      color: #555;
      max-width: 800px;
      margin: 0 auto 35px;
      line-height: 1.8;
    }

    section {
      background: #f8f9fa;
      border-radius: 15px;
      padding: 25px;
      margin: 25px auto;
      max-width: 850px;
      text-align: left;
      box-shadow: 0 6px 18px rgba(0,0,0,0.08);
      transition: transform 0.3s ease;
    }
    section:hover { transform: translateY(-4px); }

    section h2 {
      color: #0d47a1;
      margin-bottom: 10px;
      border-left: 5px solid #ffc107;
      padding-left: 10px;
    }

    section ul {
      padding-left: 20px;
      line-height: 1.8;
    }

    .btn-group {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 15px;
      margin-top: 25px;
    }

    .login-link {
      background: #ffc107;
      color: #003366;
      padding: 12px 28px;
      font-weight: 600;
      border-radius: 30px;
      text-decoration: none;
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
      transition: all 0.3s ease;
    }

    .login-link:hover {
      background: #003366;
      color: #fff;
      transform: translateY(-3px);
      box-shadow: 0 6px 15px rgba(0,0,0,0.4);
    }

    footer {
      text-align: center;
      background: #002b6d;
      color: #fff;
      padding: 25px;
      margin-top: 50px;
      font-size: 0.9rem;
    }

    @media(max-width:480px){
      .slide-caption h2{font-size:1.3rem;}
      .slide-caption p{font-size:0.9rem;}
      main h1{font-size:1.6rem;}
      main p{font-size:0.9rem;}
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav>
    <a href="{{ route('home') }}" class="logo">
      <img src="{{ asset('images/logo.jpg') }}" alt="Logo SMP Negeri 1 Pirime">
      <h3>SMP NEGERI 1 PIRIME</h3>
    </a>

    <div class="hamburger" onclick="toggleMenu(this)">
      <div></div><div></div><div></div>
    </div>

    <ul id="menu">
      <li><a href="{{ route('home') }}" class="active"><i class="fa-solid fa-house"></i> Home</a></li>
      <li><a href="{{ route('tentang') }}"><i class="fa-solid fa-school"></i> Tentang</a></li>
      <li><a href="#"><i class="fa-solid fa-newspaper"></i> Berita</a></li>
      <li><a href="#"><i class="fa-solid fa-envelope"></i> Kontak</a></li>
      <li><a href="{{ route('daftar') }}"><i class="fa-solid fa-user-plus"></i> Daftar</a></li>
    </ul>
  </nav>

  <!-- SLIDER -->
  <div class="slider" id="slider">
    <div class="slide active">
      <img src="{{ asset('images/poster.jpeg') }}" alt="SMP Pirime">
      <div class="slide-caption">
        <h2>Selamat Datang di SMP Negeri 1 Pirime</h2>
        <p>Lingkungan belajar yang nyaman dan inspiratif</p>
      </div>
    </div>

    <div class="slide">
      <img src="{{ asset('images/pirime.jpg') }}" alt="Kegiatan Siswa">
      <div class="slide-caption">
        <h2>Kegiatan Siswa Berprestasi</h2>
        <p>Mengasah potensi dan karakter melalui kegiatan sekolah</p>
      </div>
    </div>

    <div class="slide">
      <img src="{{ asset('images/poster.jpeg') }}" alt="PPDB Online">
      <div class="slide-caption">
        <h2>PPDB Online 2025</h2>
        <p>Pendaftaran mudah, cepat, dan transparan</p>
      </div>
    </div>

    <div class="dots" id="dots"></div>
  </div>

  <!-- MAIN CONTENT -->
  <main>
    <h1>PPDB Online SMP Negeri 1 Pirime Tahun 2025</h1>
    <p>Proses pendaftaran siswa baru kini dapat dilakukan secara <strong>online</strong>. Calon peserta didik dapat mengisi formulir pendaftaran dari rumah dan memantau hasil seleksi langsung dari website ini.</p>

    <section>
      <h2>🧾 Tentang PPDB Online</h2>
      <p>Sistem ini dirancang untuk mempermudah proses pendaftaran dan memastikan seleksi berjalan transparan. Pendaftar hanya perlu melengkapi data, mengunggah berkas, dan menunggu hasil verifikasi dari panitia PPDB SMP Negeri 1 Pirime.</p>
    </section>

    <section>
      <h2>📋 Syarat Pendaftaran</h2>
      <ul>
        <li>Fotokopi ijazah SD/sederajat yang dilegalisir.</li>
        <li>Fotokopi akta kelahiran & kartu keluarga.</li>
        <li>Pas foto 3x4 berwarna (2 lembar).</li>
        <li>Surat keterangan lulus dari sekolah asal.</li>
        <li>Mengisi formulir online dengan data benar.</li>
        <li>Menyerahkan berkas saat verifikasi di sekolah.</li>
      </ul>
    </section>

    <div class="btn-group">
      <a href="{{ route('login') }}" class="login-link">Login</a>
      <a href="{{ route('daftar') }}" class="login-link">Daftar Sekarang</a>
    </div>
  </main>

  <footer>
    &copy; 2025 SMP Negeri 1 Pirime | Sistem Informasi PPDB Online
  </footer>

  <!-- SCRIPT -->
  <script>
    // Menu
    function toggleMenu(hamburger){
      const menu = document.getElementById('menu');
      menu.classList.toggle('show');
      hamburger.classList.toggle('active');
    }

    // Slider
    const slides = document.querySelectorAll('.slide');
    const dotsContainer = document.getElementById('dots');
    let index = 0;

    slides.forEach((_, i) => {
      const dot = document.createElement('span');
      dot.addEventListener('click', () => showSlide(i));
      dotsContainer.appendChild(dot);
    });
    const dots = dotsContainer.querySelectorAll('span');
    updateDots();

    function showSlide(i){
      slides[index].classList.remove('active');
      index = (i + slides.length) % slides.length;
      slides[index].classList.add('active');
      updateDots();
    }

    function updateDots(){
      dots.forEach((dot, i) => dot.classList.toggle('active', i === index));
    }

    setInterval(() => showSlide(index + 1), 5000);
  </script>
</body>
</html>
