<!-- columns: 'id', 'name', 'source', 'destination', 'departure_time', 'arrival_time',
    'seats', 'fare', 'created_at', 'updated_at' -->
<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<body>
    <div class="container">
        <h1 class="text-center">Buses Table</h1>
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
                <form action="<?= base_url('admin/bus/create') ?>" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Create Bus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- todo bus form -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Bus Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Bus Name">
                            </div>
                            <div class="mb-3">
                                <label for="source" class="form-label">Source</label>
                                <input type="text" name="source" class="form-control" id="source" placeholder="Source">
                            </div>
                            <div class="mb-3">
                                <label for="destination" class="form-label">Destination</label>
                                <input type="text" name="destination" class="form-control" id="destination" placeholder="Destination">
                            </div>
                            <div class="mb-3">
                                <label for="departure_time" class="form-label">Departure Time</label>
                                <input type="time" name="departure_time" class="form-control" id="departure_time">
                            </div>
                            <div class="mb-3">
                                <label for="arrival_time" class="form-label">Arrival Time</label>
                                <input type="time" name="arrival_time" class="form-control" id="arrival_time">
                            </div>
                            <div class="mb-3">
                                <label for="seats" class="form-label">Seats</label>
                                <input type="number" name="seats" class="form-control" id="seats" placeholder="10">
                            </div>
                            <div class="mb-3">
                                <label for="fare" class="form-label">Fare</label>
                                <input type="number" name="fare" class="form-control" id="fare" placeholder="1000">
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
                        <!-- columns: 'id', 'name', 'source', 'destination', 'departure_time', 'arrival_time',
                            'seats', 'fare', 'created_at', 'updated_at' -->
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Source</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Departure Time</th>
                        <th scope="col">Arrival Time</th>
                        <th scope="col">Seats</th>
                        <th scope="col">Fare</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($buses as $bus) : ?>
                        <tr>
                            <th scope="row"><?= $bus['id'] ?></th>
                            <td><?= $bus['name'] ?></td>
                            <td><?= $bus['source'] ?></td>
                            <td><?= $bus['destination'] ?></td>
                            <td><?= $bus['departure_time'] ?></td>
                            <td><?= $bus['arrival_time'] ?></td>
                            <td><?= $bus['seats'] ?></td>
                            <td><?= $bus['fare'] ?></td>
                            <td><?= $bus['created_at'] ?></td>
                            <td><?= $bus['updated_at'] ?></td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal<?= $bus['id'] ?>">
                                    Update
                                </button>
                                <!-- Modal Update -->
                                <div class="modal fade" id="updateModal<?= $bus['id'] ?>" tabindex="-1" aria-labelledby="updateModalLabel<?= $bus['id'] ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="<?= base_url('admin/bus/update/' . $bus['id']) ?>" method="POST">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateModalLabel<?= $bus['id'] ?>">Update Bus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- todo bus form -->
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Bus Name</label>
                                                        <input type="text" name="name" class="form-control" id="name" placeholder="Bus Name" value="<?= $bus['name'] ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="source" class="form-label">Source</label>
                                                        <input type="text" name="source" class="form-control" id="source" placeholder="Source" value="<?= $bus['source'] ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="destination" class="form-label">Destination</label>
                                                        <input type="text" name="destination" class="form-control" id="destination" placeholder="Destination" value="<?= $bus['destination'] ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="departure_time" class="form-label">Departure Time</label>
                                                        <input type="time" name="departure_time" class="form-control" id="departure_time" value="<?= $bus['departure_time'] ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="arrival_time" class="form-label">Arrival Time</label>
                                                        <input type="time" name="arrival_time" class="form-control" id="arrival_time" value="<?= $bus['arrival_time'] ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="seats" class="form-label">Seats</label>
                                                        <input type="number" name="seats" class="form-control" id="seats" placeholder="10" value="<?= $bus['seats'] ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="fare" class="form-label">Fare</label>
                                                        <input type="number" name="fare" class="form-control" id="fare" placeholder="1000" value="<?= $bus['fare'] ?>">
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

                                <form action=" <?= base_url('admin/bus/delete/' . $bus['id']) ?>" method="POST" class="d-inline">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>



<?= $this->endSection() ?>