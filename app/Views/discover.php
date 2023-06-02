<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<body>
  <img src="/bus3.jpg" alt="bus" class="img-fluid top-50 start-50 translate-middle position-absolute" style="min-width: 100vw; max-height: 100vh; opacity: 0.6;">
  <?= $this->include('navbar') ?>

  <div class="container-sm position-absolute top-50 start-50 translate-middle shadow" style="max-width: 800px; background-color: #F8F9FA; border-radius: 15px;">
    <form action="<?= base_url('discover') ?>" method="POST">
      <div class="row justify-content-center m-3">
        <div class="col-6">
          <div class=" my-3">
            <label for="departure_city" class="form-label">Departure City</label>
            <input type="text" name="departure_city" class="form-control" id="departure_city" placeholder="Surabaya">
          </div>
        </div>
        <div class="col-6">
          <div class=" my-3">
            <label for="destination_city" class="form-label">Destination City</label>
            <input type="text" name="destination_city" class="form-control" id="destination_city" placeholder="Jakarta">
          </div>
        </div>
        <div class="my-3">
          <label for="departure_date" class="form-label">Departure Date</label>
          <input type="date" name="departure_date" class="form-control" id="departure_date" placeholder="">
        </div>
        <div class="d-grid gap-4 d-md-flex justify-content-center my-4">
          <button class="btn btn-primary btn-lg px-5" type="submit">Search</button>
        </div>
      </div>
    </form>
  </div>

  <!-- SCRIPTS -->

  <?= $this->endSection() ?>