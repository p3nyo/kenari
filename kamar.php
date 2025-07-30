<?php include 'layout/header.php'; ?>

<div class="container mt-5">
  <h3>	🛏️ TYPE KAMAR </h3>

  <div class="row">
    <?php
    $file = "data/kamar.json";
    if (file_exists($file)) {
      $kamar = json_decode(file_get_contents($file), true);
      foreach ($kamar as $k) {
        ?>
        <div class="col-md-4 mb-4">
          <div class="card shadow-sm h-100" style="background-color: #d9fdd3;"> <!-- Hijau muda -->
            <?php if (!empty($k['foto'])): ?>
              <img src="img/kamar/<?= htmlspecialchars($k['foto']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
            <?php endif; ?>
            <div class="card-body">
              <h5 class="card-title text-primary"><?= htmlspecialchars($k['tipe']) ?></h5>
              <p><strong>Fasilitas:</strong></p>
              <ul>
                <?php
                $fasilitas = explode(",", $k['fasilitas']);
                foreach ($fasilitas as $f) {
                  echo "<li>" . htmlspecialchars(trim($f)) . "</li>";
                }
                ?>
              </ul>
              <p><strong>Harga:</strong> Rp <?= number_format($k['harga']) ?></p>
              <?php if (!empty($k['diskon'])): ?>
                <p class="text-danger"><strong>Promo:</strong> <?= htmlspecialchars($k['diskon']) ?></p>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php
      }
    } else {
      echo "<p class='text-center'>Data kamar belum tersedia.</p>";
    }
    ?>
  </div>
</div>

<?php include 'layout/footer.php'; ?>
