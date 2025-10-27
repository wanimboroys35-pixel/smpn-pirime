<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tentang Kami | SMP Negeri 1 Pirime</title>

  <!-- Font & Icon -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    * {
      margin: 0; padding: 0;
      box-sizing: border-box;
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: url('{{ asset('images/pirime.jpg') }}') no-repeat center center/cover;
      color: #fff;
      min-height: 100vh;
      overflow-x: hidden;
      position: relative;
    }

    /* Overlay dengan efek gradasi elegan */
    body::before {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(to bottom, rgba(0,10,40,0.85), rgba(0,0,0,0.75));
      z-index: 0;
    }

    /* Navbar */
    nav {
      position: sticky;
      top: 0;
      z-index: 10;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      background: rgba(10, 20, 60, 0.8);
      backdrop-filter: blur(10px);
      box-shadow: 0 4px 10px rgba(0,0,0,0.4);
    }

    nav .logo {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
    }

    nav .logo img {
      width: 50px; height: 50px;
      border-radius: 50%;
      border: 2px solid #ffc107;
      box-shadow: 0 0 10px rgba(255,255,255,0.3);
    }

    nav .logo h3 {
      color: #fff;
      font-weight: 700;
      letter-spacing: 0.5px;
    }

    nav ul {
      list-style: none;
      display: flex;
      gap: 25px;
    }

    nav ul li a {
      color: #fff;
      text-decoration: none;
      font-weight: 500;
      padding: 8px 16px;
      border-radius: 6px;
      transition: all 0.3s ease;
    }

    nav ul li a:hover,
    nav ul li a.active {
      background-color: #ffc107;
      color: #0d1b5e;
      box-shadow: 0 0 10px rgba(255, 193, 7, 0.6);
    }

    /* Hamburger */
    .hamburger {
      display: none;
      flex-direction: column;
      gap: 5px;
      cursor: pointer;
    }

    .hamburger div {
      width: 28px; height: 3px;
      background: #fff;
      border-radius: 3px;
      transition: 0.4s;
    }

    .hamburger.active div:nth-child(1) { transform: rotate(45deg) translate(6px,6px); }
    .hamburger.active div:nth-child(2) { opacity: 0; }
    .hamburger.active div:nth-child(3) { transform: rotate(-45deg) translate(6px,-6px); }

    @media (max-width: 768px) {
      nav ul {
        position: fixed;
        top: 0; right: -100%;
        width: 250px;
        height: 100vh;
        background: rgba(5, 10, 40, 0.97);
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 25px;
        transition: 0.4s ease;
      }

      nav ul.show { right: 0; }
      .hamburger { display: flex; }
    }

    /* Main Content */
    main {
      position: relative;
      z-index: 2;
      max-width: 900px;
      margin: auto;
      padding: 100px 20px 60px;
      text-align: center;
    }

    h1 {
      font-size: 2.8rem;
      color: #ffc107;
      text-shadow: 2px 2px 10px rgba(0,0,0,0.6);
      margin-bottom: 10px;
      letter-spacing: 1px;
    }

    h2 {
      font-size: 1.8rem;
      margin-top: 45px;
      color: #ffda66;
      text-shadow: 0 0 8px rgba(255,255,255,0.2);
    }

    p {
      color: #f1f1f1;
      line-height: 1.8;
      font-size: 1rem;
    }

    .card {
      background: rgba(255,255,255,0.08);
      border-radius: 16px;
      padding: 25px;
      margin-top: 25px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.5);
      backdrop-filter: blur(6px);
      transition: all 0.5s ease;
      opacity: 0;
      transform: translateY(40px);
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 20px rgba(255,193,7,0.4);
    }

    .card.reveal {
      opacity: 1;
      transform: translateY(0);
      transition: all 0.8s ease-out;
    }

    ul {
      text-align: left;
      display: inline-block;
      margin-left: 20px;
    }

    ul li {
      margin: 8px 0;
    }

    /* Footer */
    footer {
      background: rgba(0,0,0,0.6);
      backdrop-filter: blur(8px);
      padding: 20px;
      color: #ccc;
      text-align: center;
      border-top: 1px solid rgba(255,255,255,0.2);
    }

    footer a {
      color: #0dcaf0;
      text-decoration: none;
      font-weight: 500;
    }

    footer a:hover {
      color: #ffc107;
    }

    @media (max-width:480px) {
      h1 { font-size: 2rem; }
      h2 { font-size: 1.3rem; }
      p { font-size: 0.95rem; }
    }
  </style>
</head>
<body>

  <nav>
    <a href="{{ route('home') }}" class="logo">
      <img src="{{ asset('images/logo.jpg') }}" alt="Logo SMP Negeri 1 Pirime">
      <h3>SMP NEGERI 1 PIRIME</h3>
    </a>

    <div class="hamburger" onclick="toggleMenu(this)">
      <div></div><div></div><div></div>
    </div>

    <ul id="menu">
      <li><a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> Home</a></li>
      <li><a href="{{ route('tentang') }}" class="active"><i class="fa-solid fa-users"></i> Tentang</a></li>
      <li><a href="#"><i class="fa-solid fa-newspaper"></i> Berita</a></li>
      <li><a href="#"><i class="fa-solid fa-envelope"></i> Kontak</a></li>
      <li><a href="{{ route('daftar') }}"><i class="fa-solid fa-user-plus"></i> Daftar</a></li>
    </ul>
  </nav>

  <main>
    <h1><i class="fa-solid fa-school"></i> Tentang Kami</h1>

    <div class="card">
      <p><strong>SMP Negeri 1 Pirime</strong> berkomitmen mencetak generasi muda yang berprestasi, berkarakter, dan siap menghadapi tantangan masa depan.</p>
      <p>Berlokasi di tengah keindahan alam Lanny Jaya, sekolah ini terus berinovasi menciptakan lingkungan belajar berbasis teknologi dan berorientasi masa depan, termasuk melalui sistem <strong>PPDB Online</strong>.</p>
    </div>

    <h2><i class="fa-solid fa-bullseye"></i> Visi</h2>
    <div class="card">
      <p>“Terwujudnya peserta didik yang beriman, berilmu, berakhlak mulia, dan berwawasan global.”</p>
    </div>

    <h2><i class="fa-solid fa-lightbulb"></i> Misi</h2>
    <div class="card">
      <ul>
        <li>Meningkatkan kualitas pendidikan berbasis karakter.</li>
        <li>Mengembangkan potensi peserta didik di bidang akademik dan non-akademik.</li>
        <li>Menumbuhkan semangat cinta tanah air dan budaya lokal.</li>
        <li>Meningkatkan literasi digital dan inovasi pembelajaran.</li>
      </ul>
    </div>

    <h2><i class="fa-solid fa-users-gear"></i> Tim Pengembang Aplikasi</h2>
    <div class="card">
      <p><strong>Roys Wanimbo</strong> – Developer PPDB Online</p>
      <p><strong>Komunitas Sacode</strong> – Pendamping Belajar & Bantu Dalam Merancang Website ppdb Sekolah</p>
      <p><strong>kepsek </strong> – Dokumentasi & Data</p>
  
    </div>
  </main>

  <footer>
    &copy; 2025 <strong>SMP Negeri 1 Pirime</strong> | Dikembangkan oleh <a href="#">Roys Wanimbo</a>
  </footer>

  <script>
    // Toggle menu mobile
    function toggleMenu(hamburger){
      const menu = document.getElementById('menu');
      menu.classList.toggle('show');
      hamburger.classList.toggle('active');
    }

    // Scroll animation
    const revealElements = document.querySelectorAll('.card');
    function revealOnScroll() {
      revealElements.forEach(el => {
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight - 100) {
          el.classList.add('reveal');
        }
      });
    }
    window.addEventListener('scroll', revealOnScroll);
    window.addEventListener('load', revealOnScroll);
  </script>

</body>
</html>
