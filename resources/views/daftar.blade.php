<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PPDB Online | SMP Negeri 1 Pirime</title>
    <!-- Font & Icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    /* Reset & Font */
    * { margin:0; padding:0; box-sizing:border-box; }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      background: url('{{ asset('images/pirime.jpg') }}') no-repeat center center;
      background-size: cover;
      color: #1a1c1c;
      position: relative;
    }

.dots span.active {
      background-color: #ffc107;
      transform: scale(1.2);
    }

    /* Overlay background */
    body::before {
      content: "";
      position: absolute;
      top:0; left:0;
      width:100%; height:100%;
      background: rgba(111, 123, 152, 0.7);
      z-index: 0;
      pointer-events: none;
    }

    /* Navbar */
    nav {
      position: sticky;
      top:0;
      width:100%;
      display:flex;
      justify-content: space-between;
      align-items: center;
      padding:10px 25px;
      background: rgba(33, 23, 222, 0.5);
      backdrop-filter: blur(10px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.3);
      z-index: 10;
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

    nav .logo { display:flex; align-items:center; gap:10px; text-decoration:none; }
    nav .logo img { width:45px; height:45px; border-radius:50%; box-shadow:0 2px 6px rgba(0,0,0,0.4); }
    nav .logo h3 { color:#fff; font-size:1.1rem; margin:0; font-weight:bold; }

    nav ul { list-style:none; display:flex; gap:20px; margin:0; padding:0; transition: all 0.4s ease; }
    nav ul li a { color:#fff; text-decoration:none; font-weight:500; padding:8px 12px; border-radius:5px; transition:all 0.3s; }
    nav ul li a:hover { background:#f2a304; color:#fff; }

    /* Hamburger menu mobile */
    .hamburger { display:none; flex-direction:column; gap:5px; cursor:pointer; z-index:15; }
    .hamburger div { width:28px; height:3px; background:#fff; border-radius:2px; transition:all 0.4s; }
    .hamburger.active div:nth-child(1) { transform: rotate(45deg) translate(5px,5px); }
    .hamburger.active div:nth-child(2) { opacity:0; }
    .hamburger.active div:nth-child(3) { transform: rotate(-45deg) translate(5px,-5px); }

    @media (max-width:768px){
      nav ul {
        position:fixed; top:0; right:-100%;
        height:100vh; width:250px;
        background: rgba(89, 89, 94, 0.9);
        flex-direction:column; padding-top:80px; gap:20px; align-items:center;
        transition:right 0.4s ease;
      }
      nav ul.show { right:0; }
      .hamburger { display:flex; }
    }

    /* Main content */
    main {
      position: relative;
      z-index: 10;
      margin-top: 180px;
      padding:0 20px;
    }

    h1 { font-size:2.2rem; margin-bottom:15px; text-shadow:2px 2px 6px rgba(0,0,0,0.5); }
    p { font-size:1rem; margin-bottom:25px; }

    .btn-group { display:flex; gap:15px; justify-content:center; flex-wrap:wrap; }
    .login-link {
      position: relative;
      z-index: 11;
      padding:10px 25px;
      background:#fff;
      color:#198754;
      font-weight:bold;
      text-decoration:none;
      border-radius:25px;
      transition: all 0.3s ease;
      box-shadow:0 4px 10px rgba(224, 224, 224, 0.3);
    }
    .login-link:hover {
      background:#ffd70e;
      color:#fff;
      transform: translateY(-2px);
      box-shadow:0 6px 14px rgba(1, 52, 255, 0.4);
    }

    footer { position: relative; margin-top:40px; font-size:0.8rem; opacity:0.9; z-index:10; }

    @media (max-width:480px){
      h1 { font-size:1.6rem; }
      p { font-size:0.9rem; }
      .login-link { padding:8px 15px; font-size:0.85rem; }
      main { margin-top:130px; }
    }
  </style>
</head>
<body>
  <nav>
    <!-- ✅ Logo Sekarang Klik ke Halaman Utama -->
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
    <h1></h1>
    <h1>Selamat Datang di PPDB Online 2025</h1>
    <p>SMP Negeri 1 Pirime - Sistem Penerimaan Peserta Didik Baru</p>

    <div class="btn-group">
      <a href="{{ route('login') }}" class="login-link">Login</a>
      <a href="{{ route('register') }}" class="login-link">Daftar</a>
    </div>
  </main>

  <footer>
    &copy; 2025 SMP Negeri 1 Pirime | Sistem PPDB Online
  </footer>

  <script>
    function toggleMenu(hamburger){
      const menu = document.getElementById('menu');
      menu.classList.toggle('show');
      hamburger.classList.toggle('active');
    }
  </script>
</body>
</html>
