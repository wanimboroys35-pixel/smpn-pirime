<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tentang Kami | SMP Negeri 1 Pirime</title>

  <!-- Font & Icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; scroll-behavior: smooth; }
    body {
      font-family: 'Poppins', sans-serif;
      background: url('{{ asset('images/pirime.jpg') }}') no-repeat center center/cover;
      min-height: 100vh;
      color: #fff;
      text-align: center;
      position: relative;
      overflow-x: hidden;
    }

    /* Overlay gelap */
    body::before {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(rgba(0,0,50,0.7), rgba(0,0,0,0.7));
      z-index: 0;
    }

    /* Navbar */
    nav {
      position: sticky;
      top: 0;
      z-index: 20;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 25px;
      background: rgba(25, 25, 112, 0.7);
      backdrop-filter: blur(10px);
      box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    }

    nav .logo {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
    }

    nav .logo img {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      box-shadow: 0 2px 8px rgba(0,0,0,0.5);
    }

    nav .logo h3 {
      color: #fff;
      font-size: 1.1rem;
      font-weight: 700;
      letter-spacing: 0.5px;
    }

    nav ul {
      list-style: none;
      display: flex;
      gap: 20px;
      transition: 0.4s ease;
    }

    nav ul li a {
      color: #fff;
      text-decoration: none;
      font-weight: 500;
      padding: 8px 14px;
      border-radius: 6px;
      transition: 0.3s ease;
    }

      nav ul li a:hover,
      nav ul li a.active {
      background-color: #ffc107;
      box-shadow: 0 0 10px rgba(25,135,84,0.6);
    }

    section h2 {
      color: #0d47a1;
      margin-bottom: 10px;
      border-left: 5px solid #ffc107;
      padding-left: 10px;
    }

    /* Hamburger */
    .hamburger {
      display: none;
      flex-direction: column;
      gap: 5px;
      cursor: pointer;
      z-index: 30;
    }

    .hamburger div {
      width: 28px;
      height: 3px;
      background: #fff;
      border-radius: 3px;
      transition: all 0.4s;
    }

    .hamburger.active div:nth-child(1){ transform: rotate(45deg) translate(6px,6px); }
    .hamburger.active div:nth-child(2){ opacity: 0; }
    .hamburger.active div:nth-child(3){ transform: rotate(-45deg) translate(6px,-6px); }

    @media (max-width:768px) {
      nav ul {
        position: fixed;
        top: 0; right: -100%;
        width: 250px;
        height: 100vh;
        background: rgba(0,0,30,0.95);
        flex-direction: column;
        align-items: center;
        padding-top: 80px;
        gap: 25px;
        transition: 0.4s ease;
      }
      nav ul.show { right: 0; }
      .hamburger { display: flex; }
    }

    /* Main */
    main {
      position: relative;
      z-index: 10;
      padding: 100px 20px 60px;
      max-width: 900px;
      margin: auto;
    }

    h1 {
      font-size: 2.5rem;
      text-shadow: 2px 2px 6px rgba(0,0,0,0.6);
      margin-bottom: 10px;
    }

    h2 {
      margin-top: 35px;
      font-size: 1.7rem;
      color: #ffd700;
      text-shadow: 1px 1px 6px rgba(0,0,0,0.6);
    }

    p {
      font-size: 1rem;
      line-height: 1.7;
      color: #f1f1f1;
    }

    .card {
      background: rgba(255,255,255,0.08);
      border-radius: 15px;
      padding: 25px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.4);
      margin-top: 20px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      opacity: 0;
      transform: translateY(40px);
    }

    .card.reveal {
      opacity: 1;
      transform: translateY(0);
      transition: all 1s ease;
    }

    ul {
      text-align: left;
      display: inline-block;
      margin-left: 15px;
    }

    ul li {
      margin: 6px 0;
    }

    /* Footer */
    footer {
      position: relative;
      z-index: 10;
      font-size: 0.9rem;
      color: #ddd;
      background: rgba(0,0,0,0.5);
      backdrop-filter: blur(10px);
      padding: 15px 0;
      width: 100%;
      text-align: center;
      margin-top: 50px;
      border-top: 1px solid rgba(255,255,255,0.2);
    }

    footer a {
      color: #0dcaf0;
      text-decoration: none;
    }

    footer a:hover {
      text-decoration: underline;
    }

    @media (max-width:480px) {
      h1 { font-size: 1.8rem; }
      h2 { font-size: 1.3rem; }
      p { font-size: 0.9rem; }
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
      <p><strong>SMP Negeri 1 Pirime</strong> berkomitmen untuk mencetak generasi muda Pirime yang berprestasi, berkarakter, dan siap menghadapi tantangan masa depan.</p>
      <p>Berlokasi di tengah keindahan alam Lanny Jaya, sekolah ini terus berinovasi menciptakan lingkungan belajar yang nyaman, berbasis teknologi, dan berorientasi pada masa depan, termasuk melalui sistem <strong>PPDB Online</strong>.</p>
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
        <li>Menumbuhkan semangat cinta tanah air dan nilai-nilai budaya lokal.</li>
        <li>Meningkatkan literasi digital dan inovasi pembelajaran.</li>
      </ul>
    </div>

    <h2><i class="fa-solid fa-users-gear"></i> Tim Pengembang Aplikasi</h2>
    <div class="card">
      <p><strong>Roys Wanimbo</strong> – Developer PPDB Online</p>
      <p><strong>kepsek </strong> – Dokumentasi & Data</p>
      <p><strong>Komunitas Sacode</strong> – Pendamping Belajar</p>
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

    // Scroll Reveal Animation
    const revealElements = document.querySelectorAll('.card');

    function revealOnScroll() {
      for (let el of revealElements) {
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight - 100) {
          el.classList.add('reveal');
        }
      }
    }

    window.addEventListener('scroll', revealOnScroll);
    window.addEventListener('load', revealOnScroll);
  </script>

</body>
</html>
