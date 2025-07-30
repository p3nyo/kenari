<?php include 'layout/header.php'; ?>

<?php
$file = '../data/event.json';
$event = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// Hapus event
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  if (isset($event[$id])) {
    $img = '../img/event/' . $event[$id]['gambar'];
    if (file_exists($img)) unlink($img);
    array_splice($event, $id, 1);
    file_put_contents($file, json_encode($event, JSON_PRETTY_PRINT));
    echo "<script>location.href='admin_event.php'</script>";
  }
}

// Simpan event (baru atau edit)
if (isset($_POST['simpan'])) {
  $id = $_POST['id'];
  $data = [
    'nama' => $_POST['nama'],
    'tanggal' => $_POST['tanggal'],
    'jam' => $_POST['jam'],
    'tempat' => $_POST['tempat'],
    'deskripsi' => $_POST['deskripsi'],
    'gambar' => ''
  ];

  // Gambar baru?
  if ($_FILES['gambar']['name'] != '') {
    $namaGambar = time() . '_' . $_FILES['gambar']['name'];
    move_uploaded_file($_FILES['gambar']['tmp_name'], '../img/event/' . $namaGambar);
    $data['gambar'] = $namaGambar;

    // Hapus gambar lama kalau sedang edit
    if ($id !== '' && isset($event[$id]['gambar'])) {
      $lama = '../img/event/' . $event[$id]['gambar'];
      if (file_exists($lama)) unlink($lama);
    }
  } else if ($id !== '') {
    // Jika tidak upload baru, pakai gambar lama
    $data['gambar'] = $event[$id]['gambar'];
  }

  if ($id === '') {
    $event[] = $data; // Tambah
  } else {
    $event[$id] = $data; // Edit
  }

  file_put_contents($file, json_encode($event, JSON_PRETTY_PRINT));
  echo "<script>location.href='admin_event.php'</script>";
}
?>

<div class="container mt-4">
  <h3><?= isset($_GET['edit']) ? 'Edit Event' : 'Tambah Event Baru' ?></h3>

  <?php
  $editID = isset($_GET['edit']) ? $_GET['edit'] : '';
  $edit = $editID !== '' && isset($event[$editID]) ? $event[$editID] : ['nama'=>'', 'tanggal'=>'', 'jam'=>'', 'tempat'=>'', 'deskripsi'=>'', 'gambar'=>''];
  ?>

  <!-- Form Event -->
  <form method="POST" enctype="multipart/form-data" class="p-3 border rounded bg-light mb-4">
    <input type="hidden" name="id" value="<?= $editID ?>">
    <div class="row g-3">
      <div class="col-md-6">
        <label>Nama Event</label>
        <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($edit['nama']) ?>" required>
      </div>
	  
      <div class="col-md-3">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control" value="<?= $edit['tanggal'] ?>" required>
      </div>
	  
      <div class="col-md-3">
        <label>Jam</label>
        <input type="time" name="jam" class="form-control" value="<?= $edit['jam'] ?>" required>
      </div>
      <div class="col-md-6">
        <label>Tempat</label>
        <input type="text" name="tempat" class="form-control" value="<?= htmlspecialchars($edit['tempat']) ?>" required>
      </div>
      <div class="col-md-6">
        <label>Upload Gambar <?= $edit['gambar'] ? "(Abaikan jika tidak diubah)" : "" ?></label>
        <input type="file" name="gambar" class="form-control" accept="image/*">
        <?php if ($edit['gambar']) echo "<img src='../img/event/{$edit['gambar']}' class='mt-2' width='100'>" ?>
      </div>
      <div class="col-md-12">
        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="3" class="form-control" required><?= htmlspecialchars($edit['deskripsi']) ?></textarea>
      </div>
      <div class="col-md-12 text-end">
        <button type="submit" name="simpan" class="btn btn-success"><?= $editID === '' ? 'Simpan' : 'Update' ?></button>
      </div>
    </div>
  </form>

  <!-- Daftar Event -->
  <h4>Daftar Event</h4>
  <?php if (!empty($event)): ?>
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <tr class="table-primary">
          <th>No</th><th>Nama</th><th>Tanggal</th><th>Jam</th><th>Tempat</th><th>Gambar</th><th>Opsi</th>
        </tr>
        <?php foreach ($event as $i => $e): ?>
        <tr>
          <td><?= $i+1 ?></td>
          <td><?= htmlspecialchars($e['nama']) ?></td>
          <td><?= $e['tanggal'] ?></td>
          <td><?= $e['jam'] ?></td>
          <td><?= htmlspecialchars($e['tempat']) ?></td>
          <td><img src="../img/event/<?= $e['gambar'] ?>" width="80"></td>
          <td>
            <a href="?edit=<?= $i ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="?hapus=<?= $i ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus event ini?')">Hapus</a>
          </td>
        </tr>
        <?php endforeach ?>
      </table>
    </div>
  <?php else: ?>
    <div class="alert alert-info">Belum ada event tersimpan.</div>
  <?php endif ?>
</div>

<?php include 'layout/footer.php'; ?>
