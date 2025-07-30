<?php
// Pastikan folder img/testimoni/ dan data/ ada
$folder_foto = "img/testimoni/";
$folder_data = "data/testimoni.json";

// Ambil data dari form
$nama = $_POST['nama'] ?? '';
$alamat = $_POST['alamat'] ?? '';
$hp = $_POST['nohp'] ?? '';
$pesan = $_POST['pesan'] ?? '';
$foto = '';

// Cek dan upload foto jika ada
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
  $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
  $allowed = ['jpg', 'jpeg', 'png', 'gif'];

  if (in_array($ext, $allowed)) {
    $foto = uniqid() . '.' . $ext;
    move_uploaded_file($_FILES['foto']['tmp_name'], $folder_foto . $foto);
  }
}

// Data baru
$dataBaru = [
  "nama" => $nama,
  "alamat" => $alamat,
  "nohp" => $hp,
  "pesan" => $pesan,
  "foto" => $foto,
  "tampil" => "0" // Default tidak ditampilkan, perlu persetujuan admin
];

// Ambil data lama
$dataLama = [];
if (file_exists($folder_data)) {
  $dataLama = json_decode(file_get_contents($folder_data), false);
}

// Tambahkan data baru ke array lama
$dataLama[] = $dataBaru;

// Simpan kembali ke file JSON
file_put_contents($folder_data, json_encode($dataLama, JSON_PRETTY_PRINT));

echo "<script>alert('Terima kasih! Testimoni Anda telah dikirim.'); window.location='testimoni.php';</script>";
?>
