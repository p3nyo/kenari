<?php include 'layout/header.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Booking Roemah Kenari</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .form-container {
      max-width: 800px;
      margin: auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .form-group label {
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container mt-5" >
   <h3 class="text-center mb-4">📝 FORM BOOKING</h3>
    <div class="form-container"  style="background: #e0f4e4">
     
      <form action="booking_proses.php" method="post">
        <?php
          date_default_timezone_set('Asia/Jakarta');
          $today = date('Y-m-d');
          $today_display = date('d-m-Y');
        ?>

        <!-- Tanggal Pemesanan -->
        <div class="form-group mb-4" >
          <label for="tanggal_pesan">Tanggal Pemesanan</label>
          <input type="text" class="form-control" value="<?= $today_display ?>" readonly>
          <input type="hidden" name="tanggal_pesan" value="<?= $today ?>">
        </div>

        <div class="row">
          <!-- Kolom Kiri -->
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label for="nama">Nama Lengkap</label>
              <input type="text" class="form-control" name="nama" required>
            </div>

         <div class="mb-3 w-80">
				<label for="alamat" class="form-label">Alamat</label>
				<textarea name="alamat" id="alamat" class="form-control" rows="3" required></textarea>
		  </div>

            <div class="form-group mb-3">
              <label for="no_hp">No HP</label>
              <input type="text" class="form-control" name="nohp" required>
            </div>

            <div class="form-group mb-3">
              <label for="email">Email (opsional)</label>
              <input type="email" class="form-control" name="email">
            </div>
          </div>

          <!-- Kolom Kanan -->
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label for="jumlah_orang">Jumlah Orang</label>
              <input type="number" class="form-control" name="jumlah_orang" required min="1">
            </div>

            <div class="form-group mb-3">
              <label for="tipe_kamar">Tipe Kamar</label>
              <select class="form-control" name="tipe_kamar" required>
                <option value="">-- Pilih Tipe Kamar --</option>
                <option value="Deluxe">Deluxe</option>
                <option value="Deluxe Pool Access">Deluxe Pool Access</option>
                <option value="Superior">Superior</option>
              </select>
            </div>

            <div class="form-group mb-3">
              <label for="checkin">Tanggal Check-in</label>
              <input type="date" class="form-control" name="checkin" id="checkin" min="<?= $today ?>" required>
            </div>

            <div class="form-group mb-3">
              <label for="checkout">Tanggal Check-out</label>
              <input type="date" class="form-control" name="checkout" id="checkout" min="<?= $today ?>" required>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-success btn-block mt-4">Kirim Booking</button>
      </form>
    </div>
  </div>

  <script>
    const checkin = document.getElementById('checkin');
    const checkout = document.getElementById('checkout');

    checkin.addEventListener('change', function () {
      checkout.min = checkin.value;
    });
  </script>
</body>
</html>


<?php include 'layout/footer.php'; ?>