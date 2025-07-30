<?php
$file = '../data/data_event.json';
$data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// Hapus Event
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if (isset($data[$id])) {
        $gambar = $data[$id]['gambar'];
        if (file_exists('../data/gambar/' . $gambar)) {
            unlink('../data/gambar/' . $gambar);
        }
        unset($data[$id]);
        $data = array_values($data);
        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    }
    header("Location: admin_event.php");
    exit();
}

// Edit Event - ambil data lama
$edit_mode = false;
$edit_data = null;
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $id_edit = $_GET['edit'];
    if (isset($data[$id_edit])) {
        $edit_data = $data[$id_edit];
    }
}

// Simpan atau Update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $jam = $_POST['jam'];
    $tanggal = $_POST['tanggal'];
    $tempat = $_POST['tempat'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal_format = date('d-m-Y', strtotime($tanggal));

    $gambar_name = '';
    if ($_FILES['gambar']['name']) {
        $gambar_name = time() . '_' . $_FILES['gambar']['name'];
        $gambar_tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($gambar_tmp, '../data/gambar/' . $gambar_name);
    }

    if (isset($_POST['id_edit'])) {
        // UPDATE
        $id = $_POST['id_edit'];
        if ($gambar_name == '') {
            $gambar_name = $data[$id]['gambar'];
        } else {
            if (file_exists('../data/gambar/' . $data[$id]['gambar'])) {
                unlink('../data/gambar/' . $data[$id]['gambar']);
            }
        }
        $data[$id] = [
            "gambar" => $gambar_name,
            "judul" => $judul,
            "jam" => $jam,
            "tanggal" => $tanggal_format,
            "tempat" => $tempat,
            "deskripsi" => $deskripsi
        ];
    } else {
        // TAMBAH BARU
        $data[] = [
            "gambar" => $gambar_name,
            "judul" => $judul,
            "jam" => $jam,
            "tanggal" => $tanggal_format,
            "tempat" => $tempat,
            "deskripsi" => $deskripsi
        ];
    }

    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    header("Location: admin_event.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin Event - Roemah Kenari</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-4">
  <h2 class="mb-4 text-center"><?= $edit_mode ? 'Edit' : 'Tambah' ?> Event / Promo</h2>

  <!-- Form -->
  <form method="POST" enctype="multipart/form-data" class="border p-3 bg-white rounded shadow-sm mb-4">
    <?php if ($edit_mode): ?>
      <input type="hidden" name="id_edit" value="<?= $id_edit ?>">
    <?php endif; ?>
    <div class="mb-3">
      <label>Judul Acara</label>
      <input type="text" name="judul" class="form-control" value="<?= $edit_mode ? $edit_data['judul'] : '' ?>" required>
    </div>
    <div class="mb-3">
      <label>Jam Acara</label>
      <input type="time" name="jam" class="form-control" value="<?= $edit_mode ? $edit_data['jam'] : '' ?>" required>
    </div>
    <div class="mb-3">
      <label>Tanggal Acara</label>
      <input type="date" name="tanggal" class="form-control"
             value="<?= $edit_mode ? date('Y-m-d', strtotime(str_replace('-', '/', $edit_data['tanggal']))) : '' ?>" required>
    </div>
    <div class="mb-3">
      <label>Tempat</label>
      <input type="text" name="tempat" class="form-control" value="<?= $edit_mode ? $edit_data['tempat'] : '' ?>" required>
    </div>
    <div class="mb-3">
      <label>Deskripsi</label>
      <textarea name="deskripsi" class="form-control" required><?= $edit_mode ? $edit_data['deskripsi'] : '' ?></textarea>
    </div>
    <div class="mb-3">
      <label>Upload Gambar <?= $edit_mode ? '(Kosongkan jika tidak diganti)' : '' ?></label>
      <input type="file" name="gambar" class="form-control" <?= $edit_mode ? '' : 'required' ?>>
    </div>
    <button type="submit" class="btn btn-success"><?= $edit_mode ? 'Update Event' : 'Simpan Event' ?></button>
    <?php if ($edit_mode): ?>
      <a href="admin_event.php" class="btn btn-secondary ms-2">Batal</a>
    <?php endif; ?>
  </form>

  <h4 class="mb-3">Daftar Event</h4>
  <div class="row">
    <?php foreach ($data as $i => $event): ?>
      <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
          <img src="../data/gambar/<?= $event['gambar'] ?>" class="card-img-top" style="height:200px; object-fit:cover;">
          <div class="card-body">
            <h5><?= $event['judul'] ?></h5>
            <p><strong>Waktu:</strong> <?= $event['jam'] ?>, <?= $event['tanggal'] ?></p>
            <p><strong>Tempat:</strong> <?= $event['tempat'] ?></p>
            <p><?= $event['deskripsi'] ?></p>
            <a href="?edit=<?= $i ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="?hapus=<?= $i ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
</body>
</html>
