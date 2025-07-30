
<div class="container mt-4">
  <h4>Kelola Data Kamar</h4>

  <?php
  $file = "../data/kamar.json";
  $data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

  // Simpan data kamar
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fotoName = '';
    if ($_FILES['foto']['name']) {
      $targetDir = "../img/kamar/";
      $fotoName = time() . "_" . basename($_FILES['foto']['name']);
      move_uploaded_file($_FILES['foto']['tmp_name'], $targetDir . $fotoName);
    }

    $fasilitas = isset($_POST['fasilitas']) ? implode(", ", $_POST['fasilitas']) : '';
    $new = [
      "tipe" => $_POST['tipe'],
      "fasilitas" => $fasilitas,
      "harga" => $_POST['harga'],
      "diskon" => $_POST['diskon'],
      "foto" => $fotoName
    ];
    $data[] = $new;
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    echo "<script>location.href='admin_kamar.php';</script>";
  }

  // Hapus data
  if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if (!empty($data[$id]['foto'])) {
      @unlink("../img/kamar/" . $data[$id]['foto']);
    }
    unset($data[$id]);
    $data = array_values($data);
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    echo "<script>location.href='admin_kamar.php';</script>";
  }
  ?>
  <?php include 'layout/header.php'; ?>

  <form method="post" enctype="multipart/form-data" class="mb-4 border p-3"style="background: #e0f4e4;"shadow>
    <div class="row" >
      <div class="col-md-3">
        <label>Tipe Kamar</label>
        <input type="text" name="tipe" class="form-control" required>
      </div>
      <div class="col-md-3">
        <label>Harga (Rp)</label>
        <input type="number" name="harga" class="form-control" required>
      </div>
      <div class="col-md-3">
        <label>Diskon/Promo</label>
        <input type="text" name="diskon" class="form-control">
      </div>
      <div class="col-md-6">
        <label>Fasilitas</label><br>
        <?php
        $opsi = ["AC", "Single Bed", "Double Bed", "Queen Bed", "sarapan", "Laundry" ];
        foreach ($opsi as $o) {
          echo '<div class="form-check">
                  <input class="form-check-input" type="checkbox" name="fasilitas[]" value="'.$o.'" id="'.$o.'">
                  <label class="form-check-label" for="'.$o.'">'.$o.'</label>
                </div>';
        }
        ?>
      </div>
    </div>
    <div class="mt-3">
      <label>Upload Foto</label>
      <input type="file" name="foto" accept="image/*" class="form-control">
    </div>
    <div class="text-end mt-3">
      <button type="submit" class="btn btn-primary">Tambah</button>
    </div>
  </form>

  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Foto</th>
        <th>Tipe</th>
        <th>Fasilitas</th>
        <th>Harga</th>
        <th>Diskon</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $i => $row): ?>
      <tr>
        <td><?= $i + 1 ?></td>
        <td>
          <?php if (!empty($row['foto'])): ?>
            <img src="../img/kamar/<?= $row['foto'] ?>" width="100">
          <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($row['tipe']) ?></td>
        <td><?= htmlspecialchars($row['fasilitas']) ?></td>
        <td>Rp <?= number_format($row['harga']) ?></td>
        <td><?= htmlspecialchars($row['diskon']) ?></td>
        <td><a href="?hapus=<?= $i ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

