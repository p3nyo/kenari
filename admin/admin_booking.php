<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin - Daftar Booking Roemah Kenari</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .table-container {
      background: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .table th, .table td {
      vertical-align: middle;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="table-container">
      <h3 class="text-center mb-4">📋 DAFTAR BOOKING RK</h3>
      
      <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
          <thead class="thead-dark">
            <tr>
              <th>No</th>
              <th>Tgl.Booking</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>No.Telp</th>
              <th>Check-in</th>
              <th>Check-out</th>
              <th>Jumlah</th>
              <th>Tipe Kamar</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $file = "../data/booking.json";
              if (file_exists($file)) {
                $data = json_decode(file_get_contents($file), true);
                if (!empty($data)) {
                  $no = 1;
                  foreach ($data as $index => $row) {
                    echo "<tr>
                            <td>$no</td>
                            <td class='text-primary font-weight-bold'>".date('d-m-Y', strtotime($row['tanggal_pesan']))."</td>
                            <td>{$row['nama']}</td>
                            <td>{$row['alamat']}</td>
                            <td>{$row['nohp']}</td>
                            <td>".date('d-m-Y', strtotime($row['checkin']))."</td>
                            <td class='text-danger font-weight-bold'>".date('d-m-Y', strtotime($row['checkout']))."</td>
                            <td>{$row['jumlah_orang']}</td>
                            <td>{$row['tipe_kamar']}</td>
                            <td>
                              <a href='hapus_booking.php?id=$index' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</a>
                            </td>
                          </tr>";
                    $no++;
                  }
                } else {
                  echo "<tr><td colspan='10'>Belum ada data booking.</td></tr>";
                }
              } else {
                echo "<tr><td colspan='10'>File booking.json tidak ditemukan.</td></tr>";
              }
            ?>
          </tbody>
        </table>
      </div>

      <div class="text-center mt-4">
        <a href="export_pdf.php" class="btn btn-outline-primary">🖨 Cetak PDF</a>
      </div>
    </div>
  </div>
</body>
</html>
