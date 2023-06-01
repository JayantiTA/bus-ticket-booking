<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<body>
  <?= $this->include('navbar') ?>
  <div class="container-sm" style="max-width: 800px;">
    <div class="row justify-content-center m-3">
      <div class="col-6 align-self-end">
        <h2>Available Bus</h2>
      </div>
      <div class="col-6 align-self-end">
        <h5>2 June 2023</h5>
      </div>
    </div>
  </div>
  <!-- <?php foreach ($buses as $bus) : ?> -->
  <div class="container-sm shadow" style="max-width: 800px; background-color: #F8F9FA; border-radius: 15px;">
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
          <label for="departure_time" class="form-label">Departure Time</label>
          <input type="date" name="departure_time" class="form-control" id="departure_time" placeholder="">
        </div>
        <div class="d-grid gap-4 d-md-flex justify-content-center my-4">
          <button class="btn btn-primary btn-lg px-5" type="submit">Search</button>
        </div>
      </div>
    </form>
  </div>
  <!-- <?php endforeach; ?> -->

  <!-- SCRIPTS -->

  <?= $this->endSection() ?>