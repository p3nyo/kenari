<?php
$data = file_exists("data/testimoni.json") ? json_decode(file_get_contents("data/testimoni.json"), true) : [];
?>
<?php include 'layout/header.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <title>Testimoni - Roemah Kenari</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
  
    .testimoni-box {
      background-color: #e0f4e4;
      padding: 10px;
      border: 1px solid #ccc;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      border-radius: 30px;
	  width: 500px;
      height:150px;
    }
    .testimoni-box img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 50%;
      margin-right: 15px;
    }
    .testimoni-form {
      background: #f4efe0;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="container mt-4">
    <div class="row">
      <!-- Form Testimoni -->
      <div class="col-md-5">
        <h4>📜 KIRIM TESTIMONI ANDA  </h4>
        <form action="testimoni_kirim.php" method="post" enctype="multipart/form-data" class="testimoni-form">
          <div class="form-group mb-2">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
          </div>
          <div class="form-group mb-2">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" required>
          </div>
          <div class="form-group mb-2">
            <label>No Telp/HP (opsional)</label>
            <input type="text" name="nohp" class="form-control">
          </div>
          <div class="form-group mb-2">
            <label>Pesan/Kesan</label>
            <textarea name="pesan" class="form-control" required></textarea>
          </div>
          <div class="form-group mb-3">
            <label>Foto (opsional)</label>
            <input type="file" name="foto" accept="image/*" class="form-control">
          </div>
          <button type="submit" class="btn btn-success w-100">Kirim</button>
        </form>
      </div>

      <!-- Tampilan Testimoni -->
      <div class="col-md-7">
        <h4>📜 TESTIMONI PENGUNJUNG</h4>
        <?php foreach($data as $d): ?>
		<hr>
          <?php if($d['tampil']): ?>
            <div class="testimoni-box">
              <?php if(!empty($d['foto'])): ?>
                <img src="img/testimoni/<?= $d['foto'] ?>" alt="foto">
              <?php else: ?>
                <img src="img/testimoni/awal.png" alt="default">
              <?php endif; ?>
			  

			  <div>
                <strong style="color:#277b2b;"><?= htmlspecialchars($d['nama']) ?></strong> ,<i><?= htmlspecialchars($d['alamat']) ?>,
                <?= !empty($d['nohp']) ? htmlspecialchars($d['nohp']) : '08xxx'; ?></i><br>
				<style="font-size:20px;"><i><?= htmlspecialchars($d['pesan'])?></i></style>
              </div>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</body>
</html>
<?php include 'layout/footer.php'; ?>
