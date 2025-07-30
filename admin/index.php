<?php
session_start();

// Jika sudah login, langsung ke dashboard
if (isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Ganti dengan kredensial yang Anda inginkan
    if ($user == 'admin' && $pass == '123456') {
        $_SESSION['admin'] = $user;
        header("Location: index.php");
        exit;
    } else {
        $error = 'Username atau Password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Admin - Roemah Kenari</title>
  <link href="
css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card shadow">
        <div class="card-header bg-success text-white">Login Admin</div>
        <div class="card-body">
          <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
          <?php endif; ?>
          <form method="post">
            <div class="mb-3">
              <label>Username</label>
              <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <button class="btn btn-success w-100">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
