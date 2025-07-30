<?php
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin - Roemah Kenari</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style : "background-color- #197b30">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Admin Roemah Kenari</a>
    <div class="d-flex gap-2 ms-auto">
      <a href="index.php" class="btn btn-outline-light btn-sm">Kembali</a>
	  <div>
      <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
	  </div>
    </div>
  </div>
</nav>
