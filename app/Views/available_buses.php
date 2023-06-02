<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<body>
  <div class="position-fixed top-20 start-0 end-0" style="height: 100vh; overflow: hidden;">
    <img src="/bus2.jpg" alt="bus" class="img-fluid top-50 start-50 translate-middle position-absolute" style="opacity: 0.6; object-fit: cover; z-index: -1;">

    <?= $this->include('navbar') ?>

    <div class="position-relative" style="min-height: 100vh; overflow-y: auto;">
      <div class="container-sm position-absolute">
        <?php if (count($buses) > 0) : ?>
          <div class="container-sm" style="max-width: 800px;">
            <div class="row justify-content-center d-flex m-3">
              <div class="col-6 align-self-end">
                <h2>Available Bus</h2>
              </div>
              <div class="col-6 align-self-end justify-content-end d-flex">
                <h5>
                  <?php echo \DateTime::createFromFormat('Y-m-d', $date)->format('d F Y'); ?>
                </h5>
              </div>
            </div>
          </div>
          <!-- <?php foreach ($buses as $bus) : ?> -->
          <div class="container-sm shadow" style="max-width: 800px; background-color: #F8F9FA; border-radius: 15px;">
            <form action="<?= base_url('seats/' . $bus['id']) ?>" method="POST">
              <input type="hidden" name="date" class="form-control" id="date" value="<?= $date ?>">
              <div class="row m-3">
                <div class="col-4 my-3">
                  <h2>
                    <?php echo $bus['name'] ?>
                  </h2>
                </div>
                <div class="col-8 justify-content-end d-flex my-3">
                  <h4 class="mx-2 align-self-end">
                    <?php echo $bus['fare'] ?>
                  </h4>
                  <button type="submit" class="btn btn-primary mx-2">Book Now</button>
                </div>

                <div class="row justify-content-center">
                  <div class="col-4 my-3">
                    <p>
                      <?php echo $bus['source'] ?>
                    </p>
                    <h5>
                      <?php echo $bus['departure_time'] ?>
                    </h5>
                    <p>
                      <?php echo \DateTime::createFromFormat('Y-m-d', $date)->format('d F Y'); ?>
                    </p>
                  </div>
                  <div class="col-4 my-3">
                    <i class="bi bi-arrow-right" style="font-size: 2rem; color: cornflowerblue;"></i>
                  </div>
                  <div class="col-4 my-3">
                    <p>
                      <?php echo $bus['destination'] ?>
                    </p>
                    <h5>
                      <?php echo $bus['arrival_time'] ?>
                    </h5>
                    <p>
                      <?php echo $bus['arrival_date'] ?>
                    </p>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <!-- <?php endforeach; ?> -->
        <?php else : ?>
          <div class="container-sm d-flex align-items-center justify-content-center" style="max-width: 800px; min-height: 500px; border-radius: 15px;">
            <div class="row text-center m-3">
              <h2>
                No Bus Available
              </h2>
              <form action="<?= base_url('discover') ?>" method="GET">
                <div class="d-grid gap-4 d-md-flex justify-content-center my-4">
                  <button class="btn btn-primary btn-lg px-5" type="submit">Search for Another Date</button>
                </div>
              </form>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- SCRIPTS -->

  <?= $this->endSection() ?>