<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PPDB Online | SMP Negeri 1 Pirime</title>

  <!-- Font & Icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    * {margin:0; padding:0; box-sizing:border-box;}
    html, body {
      font-family: "Poppins", sans-serif;
      background: #eef3f8;
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
      background: linear-gradient(90deg, #002b6d, #0048b0);
      box-shadow: 0 4px 15px rgba(0,0,0,0.35);
      z-index: 1000;
      backdrop-filter: blur(8px);
    }

    nav .logo {
      display: flex;
      align-items: center;
      text-decoration: none;
      gap: 10px;
    }

    nav .logo img {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      border: 2px solid #fff;
      transition: transform 0.3s ease;
    }

    nav .logo img:hover { transform: rotate(10deg) scale(1.1); }

    nav .logo h3 {
      color: #fff;
      font-size: 1.15rem;
      font-weight: 700;
      letter-spacing: 0.5px;
    }

    nav ul {
      display: flex;
      gap: 25px;
      list-style: none;
      transition: 0.3s ease;
    }

    nav ul li a {
      color: #fff;
      text-decoration: none;
      font-weight: 500;
      padding: 6px 14px;
      border-radius: 10px;
      transition: 0.3s ease;
    }

    nav ul li a:hover,
    nav ul li a.active {
      background: #ffc107;
      color: #002b6d;
      box-shadow: 0 0 10px rgba(255, 193, 7, 0.7);
    }

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
        background: rgba(0,0,50,0.95);
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

    /* ===== SLIDER PARALLAX ===== */
    .slider {
      margin-top: 70px;
      position: relative;
      width: 100%;
      height: 80vh;
      overflow: hidden;
      border-radius: 0 0 25px 25px;
    }

    .slide {
      position: absolute;
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
      height: 120%;
      object-fit: cover;
      filter: brightness(0.75);
      transform: translateY(0);
      transition: transform 8s ease;
    }

    .slide.active img {
      transform: translateY(-30px) scale(1.1);
    }

    .slide-caption {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: rgba(0,0,0,0.45);
      color: #fff;
      text-align: center;
      padding: 30px 50px;
      border-radius: 15px;
      backdrop-filter: blur(6px);
      animation: fadeUp 1s ease;
    }

    @keyframes fadeUp {
      from {opacity: 0; transform: translate(-50%, -40%);}
      to {opacity: 1; transform: translate(-50%, -50%);}
    }

    .slide-caption h2 { font-size: 2.2rem; margin-bottom: 10px; }
    .slide-caption p { font-size: 1rem; }

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
      transition: 0.3s;
    }

    .dots span.active {
      background-color: #ffc107;
      transform: scale(1.3);
    }

    /* ===== MAIN ===== */
    main {
      text-align: center;
      padding: 80px 20px;
      background: #fff;
    }

    main h1 {
      font-size: 2.4rem;
      color: #003366;
      margin-bottom: 20px;
      font-weight: 700;
    }

    main p {
      color: #444;
      max-width: 800px;
      margin: 0 auto 40px;
      line-height: 1.8;
    }

    /* ===== FADE-IN ANIMATION ===== */
    .fade-in {
      opacity: 0;
      transform: translateY(40px);
      transition: all 0.8s ease;
    }

    .fade-in.show {
      opacity: 1;
      transform: translateY(0);
    }

    section {
      background: linear-gradient(135deg, #fefefe, #f5f7ff);
      border-radius: 15px;
      padding: 30px;
      margin: 30px auto;
      max-width: 850px;
      text-align: left;
      box-shadow: 0 6px 18px rgba(0,0,0,0.08);
      transition: all 0.3s ease;
    }

    section:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    }

    section h2 {
      color: #0d47a1;
      margin-bottom: 10px;
      border-left: 6px solid #ffc107;
      padding-left: 10px;
      font-size: 1.3rem;
    }

    .btn-group {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 20px;
      margin-top: 40px;
    }

    .login-link {
      background: #ffc107;
      color: #003366;
      padding: 13px 32px;
      font-weight: 600;
      border-radius: 50px;
      text-decoration: none;
      box-shadow: 0 5px 14px rgba(0,0,0,0.25);
      transition: all 0.35s ease;
    }

    .login-link:hover {
      background: #003366;
      color: #fff;
      transform: translateY(-3px);
      box-shadow: 0 7px 20px rgba(0,0,0,0.35);
    }

    footer {
      text-align: center;
      background: linear-gradient(90deg, #002b6d, #003b9a);
      color: #fff;
      padding: 25px;
      margin-top: 50px;
      font-size: 0.9rem;
      letter-spacing: 0.4px;
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
      <img src="{{ asset('images/bg.jpg') }}" alt="SMP Pirime">
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
      <img src="{{ asset('/images/pirime.jpg') }}" alt="PPDB Online">
      <div class="slide-caption">
          <img src="{{ asset('/images/Kartun_Siswa_SMP.png') }}" alt="PPDB Online" width="100px">
        <h2>PPDB Online 2025</h2>
        <p>Pendaftaran mudah, cepat, dan transparan</p>
      </div>
    </div>

    <div class="dots" id="dots"></div>
  </div>

  <!-- MAIN CONTENT -->
  <main>
    <h1 class="fade-in">PPDB Online SMP Negeri 1 Pirime Tahun 2025</h1>
    <p class="fade-in">Pendaftaran siswa baru kini dapat dilakukan secara <strong>online</strong>. Lengkapi data dan pantau hasil seleksi dari website resmi sekolah ini.</p>

    <section class="fade-in">
      <h2>🧾 Tentang PPDB Online</h2>
      <p>Sistem ini dirancang untuk mempermudah proses pendaftaran dan memastikan seleksi berjalan transparan. Calon peserta cukup melengkapi data, unggah berkas, dan tunggu hasil verifikasi dari panitia PPDB SMP Negeri 1 Pirime.</p>
    </section>

    <section class="fade-in">
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

    <div class="btn-group fade-in">
      <a href="{{ route('login') }}" class="login-link"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
      <a href="{{ route('daftar') }}" class="login-link"><i class="fa-solid fa-user-plus"></i> Daftar Sekarang</a>
    </div>
  </main>

  <footer class="fade-in">
    &copy; 2025 SMP Negeri 1 Pirime | Sistem Informasi PPDB Online
  </footer>

  <!-- SCRIPT -->
  <script>
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

    setInterval(() => showSlide(index + 1), 6000);

    // Fade-in saat scroll
    const fadeEls = document.querySelectorAll('.fade-in');
    window.addEventListener('scroll', () => {
      const trigger = window.innerHeight * 0.85;
      fadeEls.forEach(el => {
        const top = el.getBoundingClientRect().top;
        if (top < trigger) el.classList.add('show');
      });
    });

    // Parallax scroll effect
    window.addEventListener('scroll', () => {
      const slider = document.getElementById('slider');
      const offset = window.pageYOffset;
      slider.style.backgroundPositionY = offset * 0.5 + "px";
    });
  </script>
</body>
</html>
