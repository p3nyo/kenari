<?php include 'layout/header.php'; ?>

<link rel="stylesheet" href="css/bootstrap-icons.css">

 <link rel="stylesheet" href="css/style.css">
<div class="container mt-5">
  <h3>📅 EVENT & PROMO </h3>

  <?php
  $data = file_exists('data/event.json') ? json_decode(file_get_contents('data/event.json'), true) : [];

  if (empty($data)) {
    echo "<div class='alert alert-info'>Belum ada event atau promo tersedia.</div>";
  } else {
  ?>
  
  <style>
  .carousel-control-prev-icon,
  .carousel-control-next-icon 
  {
    background-color: rgba(0, 0, 0, 0.7); /* warna gelap */
    border-radius: 50%;
	 background-size: 100% 100%;
   }
  
  </style>
  
  
    <div id="eventCarousel" class="carousel slide " data-bs-ride="carousel">
      <div class="carousel-inner shadow border " style="width:50% align-items-center">

        <?php foreach ($data as $index => $event) { ?>
          <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
            <div class="row p-2 align-items-center " style="background: #e0f4e4; border-radius: 10px; "shadow>
              <div class="col-md-4">
                <img src="img/event/<?= $event['gambar'] ?>" class="img-fluid rounded " style="height: 400px; object-fit: cover;" alt="<?= htmlspecialchars($event['nama']) ?>">
              </div>
              <div class="col-md-7">
                <h4><?= htmlspecialchars($event['nama']) ?></h4>
				<hr>
                <p><strong>Tanggal:</strong> <?= $event['tanggal'] ?></p>
				<p><strong>Jam:</strong> <?= $event['jam'] ?></p>
                <p><strong>Tempat:</strong> <?= htmlspecialchars($event['tempat']) ?></p>
                <p><strong>Deskripsi:</strong><?= nl2br(htmlspecialchars($event['deskripsi'])) ?></p>
              </div>
            </div>
          </div>
        <?php } ?>

      </div>

      <!-- Tombol Navigasi -->
      <button class="carousel-control-prev"  style="color:black" type="button" data-bs-target="#eventCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
		
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#eventCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  <?php } ?>
</div>



<?php include 'layout/footer.php'; ?>
