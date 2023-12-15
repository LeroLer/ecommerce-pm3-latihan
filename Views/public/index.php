<header>
  <?php include 'layouts/_header.php'; ?>
</header>

<!-- ini bagian toast notifikasi -->
<?php include 'layouts/_toast.php'; ?>

<section class="py-3">
  <div class="container z-0">
    <div class="row">
      <div class="col-md-4 col-lg-3 d-none d-md-block">
        <div class="card h-100">
          <div class="card-body">
            <h5 class="fw-bold card-title">
              <i class="bi bi-list"></i> Kategori
            </h5>
            <div class="list-group">
              <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                Semua
              </a>
              <?php foreach ($kategoris as $kategori) { ?>
                <a href="#" class="list-group-item list-group-item-action">
                  <?= $kategori['nama_kategori'] ?>
                </a>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8 col-lg-9">
        <div class="row">
          <div class="d-flex gap-2">
            <?php foreach ($produks as $produk) { ?>
              <div class="card" style="width: 18rem">
                <img src="<?= $produk['foto'] ?>" class="card-img-center" alt="No Image" />
                <div class="card-body">
                  <h5 class="card-title">
                    <?= $produk['nama_produk'] ?>
                  </h5>
                  <p class="card-text">
                    <small><?= $produk['deskripsi'] ?></small>
                  </p>
                  <a target="_blank" href="https://api.whatsapp.com/send?phone=6285156998225&text=Tes" class="btn btn-primary">WhatsApp
                  </a>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'layouts/_footer.php'; ?>