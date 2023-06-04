<!-- ['bus_id', 'seat_position', 'created_at', 'updated_at']; -->
<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<body>
  <?= $this->include('navbar') ?>
  <div class="container">
    <h1 class="text-center my-3">Seats Table</h1>
    <?php if (isset($success)) : ?>
      <div class="alert alert-dismissible alert-<?php echo $success ? "success" : "danger" ?> " role="alert">
        <?php echo $message ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    <!-- button create with modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
      Create
    </button>

    <!-- Modal Create -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form action="<?= base_url('admin/seat/create') ?>" method="POST">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createModalLabel">Create Seat</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class=" mb-3">
                <label for="bus_id" class="form-label">Bus Id</label>
                <input type="number" name="bus_id" class="form-control" id="bus_id" placeholder="1">
              </div>
              <div class=" mb-3">
                <label for="seat_position" class="form-label">Seat Position</label>
                <input type="text" name="seat_position" class="form-control" id="seat_position" placeholder="1A">
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button class="btn btn-primary" type="submit">Create</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <!-- 'email', 'name', 'role_id', 'created_at', 'updated_at' -->
            <th scope="col">Id</th>
            <th scope="col">Bus Id</th>
            <th scope="col">Seat Position</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($seats as $seat) : ?>
            <tr>
              <th scope="row"><?= $seat['id'] ?></th>
              <td><?= $seat['bus_id'] ?></td>
              <td><?= $seat['seat_position'] ?></td>
              <td><?= $seat['created_at'] ?></td>
              <td><?= $seat['updated_at'] ?></td>
              <!-- button Update (with modal) and delete post to /admin/seat/delete -->
              <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal<?= $seat['id'] ?>">
                  Update
                </button>
                <!-- Modal Update -->
                <div class="modal fade" id="updateModal<?= $seat['id'] ?>" tabindex="-1" aria-labelledby="updateModalLabel<?= $seat['id'] ?>" aria-hidden="true">
                  <div class="modal-dialog">
                    <form action="<?= base_url('admin/seat/update/' . $seat['id']) ?>" method="POST">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="updateModalLabel<?= $seat['id'] ?>">Update Seat</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class=" mb-3">
                            <label for="bus_id" class="form-label">Bus Id</label>
                            <input type="number" name="bus_id" class="form-control" id="bus_id" placeholder="1" value="<?= $seat['bus_id'] ?>">
                          </div>
                          <div class=" mb-3">
                            <label for="seat_position" class="form-label">Seat Position</label>
                            <input type="text" name="seat_position" class="form-control" id="seat_position" placeholder="1A" value="<?= $seat['seat_position'] ?>">
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

                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $seat['id'] ?>">
                  Delete
                </button>
                <!-- Modal Delete -->
                <div class="modal fade" id="deleteModal<?= $seat['id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $seat['id'] ?>" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel<?= $seat['id'] ?>">Delete Seat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Are you sure want to delete this seat?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form action=" <?= base_url('admin/seat/delete/' . $seat['id']) ?>" method="POST" class="d-inline">
                          <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
<?= $this->endSection() ?>