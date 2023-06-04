<!-- ['bus_id', 'seat_position', 'created_at', 'updated_at']; -->
<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<body>
  <?= $this->include('navbar') ?>
  <div class="container">
    <h1 class="text-center my-3">Bookings Table</h1>
    <?php if (isset($success)) : ?>
      <div class="alert alert-dismissible alert-<?php echo $success ? "success" : "danger" ?> " role="alert">
        <?php echo $message ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <!-- 'email', 'name', 'role_id', 'created_at', 'updated_at' -->
            <th scope="col">Id</th>
            <th scope="col">Bus Id</th>
            <th scope="col">User Id</th>
            <th scope="col">Seat Id</th>
            <th scope="col">Departure Date</th>
            <th scope="col">Status</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($bookings as $booking) : ?>
            <tr>
              <th scope="row"><?= $booking['id'] ?></th>
              <td><?= $booking['bus_id'] ?></td>
              <td><?= $booking['user_id'] ?></td>
              <td><?= $booking['seat_id'] ?></td>
              <td><?= $booking['departure_date'] ?></td>
              <td><?= $booking['status'] ?></td>
              <td><?= $booking['created_at'] ?></td>
              <td><?= $booking['updated_at'] ?></td>
              <!-- button Update (with modal) and delete post to /admin/book/delete -->
              <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal<?= $booking['id'] ?>">
                  Update
                </button>
                <!-- Modal Update -->
                <div class="modal fade" id="updateModal<?= $booking['id'] ?>" tabindex="-1" aria-labelledby="updateModalLabel<?= $booking['id'] ?>" aria-hidden="true">
                  <div class="modal-dialog">
                    <form action="<?= base_url('admin/book/update/' . $booking['id']) ?>" method="POST">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="updateModalLabel<?= $booking['id'] ?>">Update Seat</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class=" mb-3">
                            <label for="bus_id" class="form-label">Bus Id</label>
                            <input disabled type="number" name="bus_id" class="form-control" id="bus_id" value="<?= $booking['bus_id'] ?>">
                          </div>
                          <div class=" mb-3">
                            <label for="user_id" class="form-label">User Id</label>
                            <input disabled type="number" name="user_id" class="form-control" id="user_id" value="<?= $booking['user_id'] ?>">
                          </div>
                          <div class=" mb-3">
                            <label for="seat_id" class="form-label">Seat Id</label>
                            <input disabled type="number" name="seat_id" class="form-control" id="seat_id" value="<?= $booking['seat_id'] ?>">
                          </div>
                          <div class=" mb-3">
                            <label for="departure_date" class="form-label">Departure Date</label>
                            <input disabled type="datetime" name="departure_date" class="form-control" id="departure_date" value="<?= $booking['departure_date'] ?>">
                          </div>
                          <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" aria-label="Default select example">
                              <option value="pending">Pending</option>
                              <option value="approved">Approved</option>
                              <option value="rejected">Rejected</option>
                            </select>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $booking['id'] ?>">
                  Delete
                </button>
                <!-- Modal Delete -->
                <div class="modal fade" id="deleteModal<?= $booking['id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $booking['id'] ?>" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel<?= $booking['id'] ?>">Delete Seat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Are you sure want to delete this booking?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form action=" <?= base_url('admin/book/delete/' . $booking['id']) ?>" method="POST" class="d-inline">
                          <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <?php if (isset($booking['image_path'])) : ?>
                  <a href="<?= base_url('uploads/' . $booking['image_path']) ?>" class="btn btn-info" target="_blank">Image</a>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
<?= $this->endSection() ?>