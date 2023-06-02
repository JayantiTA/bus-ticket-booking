<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<body>
  <div class="position-fixed top-20 start-0 end-0" style="height: 100vh; overflow: hidden;">
    <img src="/bus3.jpg" alt="bus" class="img-fluid top-50 start-50 translate-middle position-absolute" style="opacity: 0.6; object-fit: cover; z-index: -1;">

    <?= $this->include('navbar') ?>

    <?php
    // if (count($buses) > 0) :
    ?>
    <?php
    // foreach ($buses as $bus) :
    ?>
    <div class="position-relative" style="min-height: 100vh; overflow-y: auto;">
      <div class="container-sm position-absolute">
        <div class="container-sm shadow" style="max-width: 600px; background-color: #F8F9FA; border-radius: 15px;">
          <form action="<?= base_url() ?>" method="POST">
            <div class="row m-3">
              <div class="col-4 my-3">
                <h2>
                  Jayakarta
                </h2>
              </div>
              <div class="col-8 justify-content-end align-items-center text-center d-flex my-3">
                <span class="badge rounded-pill text-bg-primary p-2">Pending</span>
              </div>

              <div class="row justify-content-center">
                <div class="col-4">
                  <p>
                    Jakarta
                  </p>
                  <h5>
                    19:00
                  </h5>
                  <p>
                    2 June 2023
                  </p>
                </div>
                <div class="col-4">
                  <i class="bi bi-arrow-right" style="font-size: 2rem; color: cornflowerblue;"></i>
                </div>
                <div class="col-4">
                  <p>
                    Surabaya
                  </p>
                  <h5>
                    00.00
                  </h5>
                  <p>
                    3 June 2023
                  </p>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="container-sm shadow" style="max-width: 600px; background-color: #F8F9FA; border-radius: 15px;">
          <form action="<?= base_url() ?>" method="POST">
            <div class="row m-3">
              <div class="col-4 my-3">
                <h2>
                  Jayakarta
                </h2>
              </div>
              <div class="col-8 justify-content-end align-items-center text-center d-flex my-3">
                <span class="badge rounded-pill text-bg-primary p-2">Pending</span>
              </div>

              <div class="row justify-content-center">
                <div class="col-4">
                  <p>
                    Jakarta
                  </p>
                  <h5>
                    19:00
                  </h5>
                  <p>
                    2 June 2023
                  </p>
                </div>
                <div class="col-4">
                  <i class="bi bi-arrow-right" style="font-size: 2rem; color: cornflowerblue;"></i>
                </div>
                <div class="col-4">
                  <p>
                    Surabaya
                  </p>
                  <h5>
                    00.00
                  </h5>
                  <p>
                    3 June 2023
                  </p>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="container-sm shadow" style="max-width: 600px; background-color: #F8F9FA; border-radius: 15px;">
          <form action="<?= base_url() ?>" method="POST">
            <div class="row m-3">
              <div class="col-4 my-3">
                <h2>
                  Jayakarta
                </h2>
              </div>
              <div class="col-8 justify-content-end align-items-center text-center d-flex my-3">
                <span class="badge rounded-pill text-bg-primary p-2">Pending</span>
              </div>

              <div class="row justify-content-center">
                <div class="col-4">
                  <p>
                    Jakarta
                  </p>
                  <h5>
                    19:00
                  </h5>
                  <p>
                    2 June 2023
                  </p>
                </div>
                <div class="col-4">
                  <i class="bi bi-arrow-right" style="font-size: 2rem; color: cornflowerblue;"></i>
                </div>
                <div class="col-4">
                  <p>
                    Surabaya
                  </p>
                  <h5>
                    00.00
                  </h5>
                  <p>
                    3 June 2023
                  </p>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="container-sm shadow" style="max-width: 600px; background-color: #F8F9FA; border-radius: 15px;">
          <form action="<?= base_url() ?>" method="POST">
            <div class="row m-3">
              <div class="col-4 my-3">
                <h2>
                  Jayakarta
                </h2>
              </div>
              <div class="col-8 justify-content-end align-items-center text-center d-flex my-3">
                <span class="badge rounded-pill text-bg-primary p-2">Pending</span>
              </div>

              <div class="row justify-content-center">
                <div class="col-4">
                  <p>
                    Jakarta
                  </p>
                  <h5>
                    19:00
                  </h5>
                  <p>
                    2 June 2023
                  </p>
                </div>
                <div class="col-4">
                  <i class="bi bi-arrow-right" style="font-size: 2rem; color: cornflowerblue;"></i>
                </div>
                <div class="col-4">
                  <p>
                    Surabaya
                  </p>
                  <h5>
                    00.00
                  </h5>
                  <p>
                    3 June 2023
                  </p>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <?php
      // endforeach;
      ?>
      <?php
      // else :
      ?>
      <!-- <div class="container-sm d-flex align-items-center justify-content-center" style="max-width: 800px; min-height: 500px; border-radius: 15px;">
      <div class="row text-center m-3">
        <h2>
          You haven't created any booking yet
        </h2>
        <form action="<?= base_url('discover') ?>" method="GET">
          <div class="d-grid gap-4 d-md-flex justify-content-center my-4">
            <button class="btn btn-primary btn-lg px-5" type="submit">Book now</button>
          </div>
        </form>
      </div>
    </div> -->
      <?php
      // endif;
      ?>
    </div>
  </div>

  <!-- SCRIPTS -->

  <?= $this->endSection() ?>