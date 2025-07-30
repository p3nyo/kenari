<?php
$json_file = '../data/galeri.json';
$folder_gambar = '../img/galeri/';
$galeri = file_exists($json_file) ? json_decode(file_get_contents($json_file), true) : [];

// Hapus gambar
if (isset($_GET['hapus'])) {
    $index = $_GET['hapus'];
    if (isset($galeri[$index])) {
        $file = $galeri[$index]['file'];
        if (file_exists($folder_gambar . $file)) {
            unlink($folder_gambar . $file);
        }
        array_splice($galeri, $index, 1);
        file_put_contents($json_file, json_encode($galeri, JSON_PRETTY_PRINT));
        header("Location: admin_galeri.php");
        exit;
    }
}

// Upload gambar
if (isset($_POST['upload'])) {
    $caption = $_POST['caption'];
    $gambar = $_FILES['gambar'];

    if ($gambar['error'] === 0) {
        $ext = pathinfo($gambar['name'], PATHINFO_EXTENSION);
        $nama_baru = 'galeri_' . time() . '.' . $ext;
        move_uploaded_file($gambar['tmp_name'], $folder_gambar . $nama_baru);

        $galeri[] = ['file' => $nama_baru, 'caption' => $caption];
        file_put_contents($json_file, json_encode($galeri, JSON_PRETTY_PRINT));
        header("Location: admin_galeri.php");
        exit;
    }
}

// Edit caption
if (isset($_POST['edit_caption'])) {
    $index = $_POST['index'];
    $new_caption = $_POST['new_caption'];
    if (isset($galeri[$index])) {
        $galeri[$index]['caption'] = $new_caption;
        file_put_contents($json_file, json_encode($galeri, JSON_PRETTY_PRINT));
        header("Location: admin_galeri.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin Galeri</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    img.thumb {
      height: 150px;
      object-fit: cover;
    }
  </style>
</head>
<body>
<div class="container mt-4">
  <h3>Kelola Galeri Roemah Kenari</h3>

  <!-- Form Upload -->
  <form method="POST" enctype="multipart/form-data" class="row g-3 mb-4">
    <div class="col-md-5">
      <label class="form-label">Pilih Gambar</label>
      <input type="file" name="gambar" required class="form-control">
    </div>
    <div class="col-md-5">
      <label class="form-label">Keterangan</label>
      <input type="text" name="caption" required class="form-control">
    </div>
    <div class="col-md-2 d-flex align-items-end">
      <button type="submit" name="upload" class="btn btn-success w-100">Upload</button>
    </div>
  </form>

  <!-- Galeri -->
  <div class="row">
    <?php foreach ($galeri as $i => $g): ?>
      <div class="col-md-4 mb-3">
        <div class="card">
          <img src="<?= $folder_gambar . $g['file'] ?>" class="card-img-top thumb" alt="">
          <div class="card-body">
            <form method="POST" class="d-flex flex-column">
              <input type="hidden" name="index" value="<?= $i ?>">
              <input type="text" name="new_caption" class="form-control mb-2" value="<?= htmlspecialchars($g['caption']) ?>">
              <div class="d-flex justify-content-between">
                <button type="submit" name="edit_caption" class="btn btn-primary btn-sm">Simpan</button>
                <a href="?hapus=<?= $i ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus gambar ini?')">Hapus</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  </div>
</div>
</body>
</html>
