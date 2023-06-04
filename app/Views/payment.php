<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<body>
  <div class="position-fixed top-20 start-0 end-0" style="height: 100vh; overflow: hidden;">
    <div class="position-fixed top-0 start-0 end-0 bottom-0">
      <img src="/bus2.jpg" class="position-absolute top-0 start-0 h-100 w-100" style="object-fit: cover; z-index: -1; opacity: 0.6;">
    </div>
    <?= $this->include('navbar') ?>
    <div class="position-relative" style="height: 100vh; overflow-y: scroll;">
      <?php if (isset($success)) : ?>
        <div class="alert alert-dismissible alert-<?php echo $success ? "success" : "danger" ?> " role="alert">
          <?php echo $message ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
      <div class="container-sm shadow my-5 p-5" style="max-width: 900px; background-color: #F8F9FA; border-radius: 15px;">
        <div class="row justify-content-center">
          <div class="col-6 my-3">
            <div class="container-sm border border-dark d-flex align-items-center justify-content-center" style="max-width: 350px; border-radius: 15px">
              <div class=" row text-center m-3">
                <h3>Payment Account</h3>
                <h5>1234567890 (BRI)</h5>
                <h5>1234567890 (BNI)</h5>
                <h5>1234567890 (MANDIRI)</h5>
                <h5>1234567890 (BSI)</h5>
              </div>
            </div>
          </div>
          <div class=" col-6 my-3">
            <div class="align-items-center">
              <h3>Upload payment for:</h3>
              <h5>
                <?php echo $bus_data['name'] ?>
                -
                <?php echo \DateTime::createFromFormat('Y-m-d', $date)->format('d F Y'); ?>
                -
                <?php echo \DateTime::createFromFormat('H:i:s', $bus_data['departure_time'])->format('H:i'); ?>
                -
                <?php echo $seat_data['seat_position'] ?>
              </h5>
            </div>
            <form action="<?= base_url('pay') ?>" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="seat_id" class="form-label">Transfer Receipt</label>
                <input type="hidden" name="departure_date" class="form-control" id="departure_date" value="<?= $date ?>">
                <input type="hidden" name="bus_id" class="form-control" id="date" value="<?= $bus_data['id'] ?>">
                <input type="hidden" name="seat_id" class="form-control" id="date" value="<?= $seat_data['id'] ?>">
                <input type="file" name="attachment" class="form-control" id="attachment" placeholder="Bus Name">
                <div class="justify-content-end d-flex">
                  <button type=" submit" class="btn btn-primary my-3">Confirm</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- SCRIPTS -->

  <?= $this->endSection() ?>