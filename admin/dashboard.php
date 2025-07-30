<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - Roemah Kenari</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <style>
    body {
      margin: 0;
      overflow: hidden;
    }
    .sidebar {
      position: fixed;
      left: 0;
      top: 0;
      height: 100%;
      width: 220px;
      background-color: #197b30;
      padding-top: 20px;
      color: white;
    }
    .sidebar a {
      display: block;
      color: white;
      padding: 12px 16px;
      text-decoration: none;
    }
    .sidebar a:hover {
      background-color: #003060;
    }
    .main {
      margin-left: 220px;
      height: 100vh;
    }
    iframe {
      width: 100%;
      height: 100%;
      border: none;
    }
  </style>
</head>
<body>

<div class="sidebar">
  <h5 class="text-center">ROEMAH KENARI</h5>
  <hr>
 <a href="isi.php" target="konten">🏠 Dashboard</a> 
  <a href="admin_event.php" target="konten">📅 Kelola Event</a>
  <a href="admin_kamar.php" target="konten">🛏️ Kelola Kamar</a>
  <a href="admin_booking.php" target="konten">📋 Data Booking</a>
  <a href="admin_galeri.php" target="konten">🖼️ Kelola Galeri</a>
  <a href="admin_testimoni.php" target="konten">💬 Kelola Testimoni</a>
  <hr>
  <a href="logout.php">LOGOUT</a>
</div>

<div class="main">
  <iframe name="konten" src="isi.php"></iframe>
</div>

</body>
</html>
