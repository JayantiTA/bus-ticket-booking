<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<body>
  <div class="position-fixed top-20 start-0 end-0" style="height: 100vh; overflow: hidden; z-index: -1;">
    <img src="/bus3.jpg" alt="bus" class="img-fluid top-50 start-50 translate-middle position-absolute" style="opacity: 0.6; object-fit: cover;">
  </div>

  <?= $this->include('navbar') ?>

  <?php if (isset($success)) : ?>
    <div class="alert alert-dismissible alert-<?php echo $success ? "success" : "danger" ?> " role="alert">
      <?php echo $message ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <?php if (count($bookings) > 0) : ?>
    <?php foreach ($bookings as $booking) : ?>
      <div class="container-sm">
        <div class="container-sm shadow" style="max-width: 600px; background-color: #F8F9FA; border-radius: 15px;">
          <form action="<?= base_url('bookings') ?>" method="GET">
            <div class="row m-3">
              <div class="col-4 my-3">
                <h2>
                  <?php echo $booking['bus']['name'] ?>
                </h2>
              </div>
              <div class="col-8 justify-content-end align-items-center text-center d-flex my-3">
                <?php if ($booking['status'] != "approved") : ?>
                  <span class="badge rounded-pill text-bg-<?php echo $booking['status'] == "pending" ? "secondary" : "danger" ?> p-2">
                    <?php echo $booking['status'] ?>
                  </span>
                <?php else : ?>
                  <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#eTicketModal<?= $booking['id'] ?>">Show QR</button>
                  <!-- modal for showing ticket -->
                  <div class="modal fade" id="eTicketModal<?= $booking['id'] ?>" tabindex="-1" aria-labelledby="eTicketModalLabel<?= $booking['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="eTicketModalLabel<?= $booking['id'] ?>">Booking QR</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=booking-<?= $booking['id'] ?>&choe=UTF-8" alt="qr-<?= $booking['id'] ?>" class="img-fluid">
                        </div>
                        <div class="modal-footer">
                          <a class="btn btn-primary" href="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=booking-<?= $booking['id'] ?>&choe=UTF-8" alt="qr-<?= $booking['id'] ?>" download="qr-<?= $booking['id'] ?>.png">Download QR Code</a>
                          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>
              </div>

              <div class="row justify-content-center">
                <div class="col-4">
                  <p>
                    <?php echo $booking['bus']['source'] ?>
                  </p>
                  <h5>
                    <?php echo $booking['bus']['departure_time'] ?>
                  </h5>
                  <p>
                    <?php echo $booking['departure_date'] ?>
                  </p>
                </div>
                <div class="col-4">
                  <i class="bi bi-arrow-right" style="font-size: 2rem; color: cornflowerblue;"></i>
                </div>
                <div class="col-4">
                  <p>
                    <?php echo $booking['bus']['destination'] ?>
                  </p>
                  <h5>
                    <?php echo $booking['bus']['arrival_time'] ?>
                  </h5>
                  <p>
                    <?php
                    echo $booking['bus']['arrival_date']
                    ?>
                  </p>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else : ?>
    <div class="container-sm d-flex align-items-center justify-content-center" style="max-width: 800px; min-height: 500px; border-radius: 15px;">
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
    </div>
  <?php endif; ?>

  <!-- SCRIPTS -->

  <?= $this->endSection() ?>