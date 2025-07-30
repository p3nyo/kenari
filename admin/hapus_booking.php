<?php
$id = $_GET['id'] ?? -1;
$file = "../data/booking.json";
$data = json_decode(file_get_contents($file), true);

if ($id > -1 && isset($data[$id])) {
    unset($data[$id]);
    $data = array_values($data); // reset index
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

header("Location: admin_booking.php");
exit;
