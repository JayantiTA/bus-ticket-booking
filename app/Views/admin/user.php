<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<body>
    <div class="container">
        <h1 class="text-center">Users Table</h1>
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
                <form action="<?= base_url('admin/user/create') ?>" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Create User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class=" mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
                            </div>
                            <div class=" mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Full Name">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="role_id" class="form-label">Role</label>
                                <select class="form-select" name="role_id" aria-label="Default select example">
                                    <option value="admin">Admin</option>
                                    <option selected value="user">User</option>
                                </select>
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
                        <th scope="col">Email</th>
                        <th scope="col">Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <th scope="row"><?= $user['id'] ?></th>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['role_id'] ?></td>
                            <td><?= $user['created_at'] ?></td>
                            <td><?= $user['updated_at'] ?></td>
                            <!-- button Update (with modal) and delete post to /admin/user/delete -->
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal<?= $user['id'] ?>">
                                    Update
                                </button>
                                <!-- Modal Update -->
                                <div class="modal fade" id="updateModal<?= $user['id'] ?>" tabindex="-1" aria-labelledby="updateModalLabel<?= $user['id'] ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="<?= base_url('admin/user/update/' . $user['id']) ?>" method="POST">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateModalLabel<?= $user['id'] ?>">Update User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class=" mb-3">
                                                        <label for="email" class="form-label">Email address</label>
                                                        <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" value="<?= $user['email'] ?>">
                                                    </div>
                                                    <div class=" mb-3">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" name="name" class="form-control" id="name" placeholder="Full Name" value="<?= $user['name'] ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="role_id" class="form-label">Role</label>
                                                        <select class="form-select" name="role_id" aria-label="Default select example">
                                                            <option value="admin" <?= $user['role_id'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                                            <option value="user" <?= $user['role_id'] == 'user' ? 'selected' : '' ?>>User</option>
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

                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $user['id'] ?>">
                                    Delete
                                </button>
                                <!-- Modal Delete -->
                                <div class="modal fade" id="deleteModal<?= $user['id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $user['id'] ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel<?= $user['id'] ?>">Delete User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure want to delete this user?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <form action=" <?= base_url('admin/user/delete/' . $user['id']) ?>" method="POST" class="d-inline">
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