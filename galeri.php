<?php include 'layout/header.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Galeri Roemah Kenari</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">

  <style>
    img.thumb {
      height: 150px;
      width: 50%;
      object-fit: cover;
      border-radius: 4px;
    }
	 .carousel-item img {
    height:600px;
    object-fit: cover;
    width: 100%;
  }

    .galeri-thumb {
      cursor: pointer;
      transition: 0.3s ease;
    }
    .galeri-thumb:hover {
      transform: scale(1.05);
    }
    .galeri-grid img {
      max-height: 200px;
      object-fit: cover;
      width: 100%;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <h2>🖼️ GALERI FOTO</h2>
  <div class="row galeri-grid">
    <?php
    $json = file_get_contents('data/galeri.json');
    $data = json_decode($json, true);
    foreach($data as $i => $item){
      echo '
        <div class="col-md-4 mb-3">
          <img src="img/galeri/'.$item['file'].'" class="img-fluid galeri-thumb" data-bs-toggle="modal" data-bs-target="#galeriModal" data-slide="'.$i.'">
        </div>';
    }
    ?>
  </div>
</div>

<!-- Modal / Popup -->
<div class="modal fade" id="galeriModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content bg-dark text-white">
      <div class="modal-body p-0">
        <div id="galeriCarousel" class="carousel slide" data-bs-ride="false">
          <div class="carousel-inner">
            <?php
            foreach($data as $i => $item){
              echo '
              <div class="carousel-item '.($i==0?'active':'').'">
                <img src="img/galeri/'.$item['file'].'" class="d-block w-100" alt="">
                <div class="carousel-caption d-none d-md-block">
                  <p>'.$item['caption'].'</p>
                </div>
              </div>';
            }
            ?>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#galeriCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#galeriCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>
      </div>
      <div class="modal-footer justify-content-center bg-dark">
        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script src="css/bootstrap.bundle.min.js"></script>
<script>
  const thumbs = document.querySelectorAll('.galeri-thumb');
  const carousel = document.querySelector('#galeriCarousel');
  const bsCarousel = new bootstrap.Carousel(carousel);

  thumbs.forEach((img, idx) => {
    img.addEventListener('click', () => {
      bsCarousel.to(idx);
    });
  });
</script>

</body>
</html>


<?php include 'layout/footer.php'; ?>
