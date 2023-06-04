<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<body>
  <div class="position-fixed top-20 start-0 end-0" style="height: 100vh; overflow: hidden;">
    <div class="position-fixed top-0 start-0 end-0 bottom-0">
      <img src="/bus2.jpg" class="position-absolute top-0 start-0 h-100 w-100" style="object-fit: cover; z-index: -1; opacity: 0.6;">
    </div>

    <?= $this->include('navbar') ?>
    <form action="<?= base_url('book') ?>" method="GET">
      <input type="hidden" name="date" class="form-control" id="date" value="<?= $date ?>">
      <input type="hidden" name="bus_id" class="form-control" id="bus_id" value="<?= $bus_id ?>">
      <div class="position-relative" style="height: 100vh; overflow-y: scroll;">
        <div class="container shadow my-5 p-3" style="max-width: 800px; min-height:100vh; background-color: #F8F9FA; border-radius: 15px;">
          <div class="row justify-content-center">
            <div class="col-6 my-3">
              <img src="/seat_position.png" alt="bus" class="m-2">
            </div>
            <div class=" col-6 my-3">
              <div class="align-items-center">
                <h2>Choose Seat</h2>
              </div>
              <div class="mb-3">
                <label for="seat_id" class="form-label">Seat Position</label>
                <select class="form-select" name="seat_id" aria-label="Default select example">
                  <?php foreach ($seats as $seat) : ?>
                    <option value="<?= $seat['id'] ?>">
                      <?php echo $seat['seat_position'] ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-primary my-3">Book</button>
              </div>
            </div>
          </div>
        </div>
        <div style="height: 100px;"></div>
      </div>
    </form>
  </div>

  <!-- SCRIPTS -->

  <?= $this->endSection() ?>