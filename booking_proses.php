<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $tanggal_pesan = date("d-m-Y", strtotime(str_replace("/", "-", $_POST["tanggal_pesan"])));
    $nama           = htmlspecialchars($_POST["nama"]);
    $alamat         = htmlspecialchars($_POST["alamat"]);
    $nohp           = htmlspecialchars($_POST["nohp"]);
    $email          = !empty($_POST["email"]) ? htmlspecialchars($_POST["email"]) : "-";
    $jumlah_orang   = (int) $_POST["jumlah_orang"];
    $tipe_kamar     = $_POST["tipe_kamar"];
    $checkin        = date("d-m-Y", strtotime($_POST["checkin"]));
    $checkout       = date("d-m-Y", strtotime($_POST["checkout"]));

    // Jika No HP kosong, ganti dengan placeholder
    if (empty($nohp)) {
        $nohp = "08xxx";
    }

    // Buat data array booking
    $dataBaru = array(
        "tanggal_pesan" => $tanggal_pesan,
        "nama"          => $nama,
        "alamat"        => $alamat,
        "nohp"          => $nohp,
        "email"         => $email,
        "jumlah_orang"  => $jumlah_orang,
        "tipe_kamar"    => $tipe_kamar,
        "checkin"       => $checkin,
        "checkout"      => $checkout
    );

    // Simpan ke file JSON
    $file = "data/booking.json";
    if (file_exists($file)) {
        $dataLama = json_decode(file_get_contents($file), true);
    } else {
        $dataLama = [];
    }

    $dataLama[] = $dataBaru;
    file_put_contents($file, json_encode($dataLama, JSON_PRETTY_PRINT));

    // Redirect atau tampilkan notifikasi sukses
    echo "<script>
        alert('Booking berhasil disimpan!');
        window.location.href = 'booking.php';
    </script>";
} else {
    echo "Akses tidak sah.";
}
?>
