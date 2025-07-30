<?php
$json_file = "../data/testimoni.json";
$data = json_decode(file_get_contents($json_file), true);

// Menangani aksi tampil/hapus
if (isset($_GET['aksi']) && isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    if ($_GET['aksi'] == 'tampil') {
        $data[$id]['tampil'] = true;
        file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT));
        header("Location: admin_testimoni.php");
        exit;
    } elseif ($_GET['aksi'] == 'sembunyikan') {
        $data[$id]['tampil'] = false;
        file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT));
        header("Location: admin_testimoni.php");
        exit;
    } elseif ($_GET['aksi'] == 'hapus') {
        // Hapus file foto jika ada
        if (!empty($data[$id]['foto'])) {
            $foto_path = "../img/testimoni/" . $data[$id]['foto'];
            if (file_exists($foto_path)) {
                unlink($foto_path);
            }
        }
        array_splice($data, $id, 1);
        file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT));
        header("Location: admin_testimoni.php");
        exit;
    }
}
?>

<?php include 'layout/header.php'; ?>

<div class="container mt-4">
  <h2 class="mb-4">Kelola Testimoni Pengunjung</h2>
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="table-success">
        <tr>
          <th>No</th>
          <th>Nama</th>
		  <th>Alamat</th>
          <th>No Telp/HP</th>
		  <th>Pesan</th>
          <th>Foto</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data as $i => $t): ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= htmlspecialchars($t['nama']) ?></td>
          <td><?= htmlspecialchars($t['alamat']) ?></td>
		  <td><?= htmlspecialchars($t['nohp']) ?></td>
          <td><?= htmlspecialchars($t['pesan']) ?></td>
          <td>
            <?php if (!empty($t['foto'])): ?>
              <img src="../img/testimoni/<?= $t['foto'] ?>" width="80">
            <?php else: ?>
              -
            <?php endif; ?>
          </td>
          <td>
            <?= $t['tampil'] ? '<span class="text-success">Tampil</span>' : '<span class="text-danger">Tersembunyi</span>' ?>
          </td>
          <td>
            <?php if (!$t['tampil']): ?>
              <a href="?aksi=tampil&id=<?= $i ?>" class="btn btn-success">Tampilkan</a>
            <?php else: ?>
              <a href="?aksi=sembunyikan&id=<?= $i ?>" class="btn btn-warning">Sembunyikan</a>
            <?php endif; ?>
            <a href="?aksi=hapus&id=<?= $i ?>" class="btn  btn-danger" onclick="return confirm('Hapus testimoni ini?')">Hapus</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include 'layout/footer.php'; ?>
