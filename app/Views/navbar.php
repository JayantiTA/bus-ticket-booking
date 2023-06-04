<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #0AA2C0;">
  <div class="container-fluid">
    <a class="navbar-brand mx-5" href="#">SleeperB</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php if (session()->has('email')) : ?>
          <?php if (session()->has('role_id') && session()->get('role_id') == 'admin') : ?>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?= base_url('admin/user') ?>">User</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?= base_url('admin/book') ?>">Book</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?= base_url('admin/bus') ?>">Bus</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?= base_url('admin/seat') ?>">Seat</a>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?= session()->has('role_id') && session()->get('role_id') == 'admin' ? base_url('admin/user') : base_url('discover')  ?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?= base_url('bookings') ?>">My Bookings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/contact">Contact</a>
            </li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>
      <?php if (session()->has('email')) : ?>
        <a type="button" class="d-flex btn btn-outline-light mx-3" href="<?= base_url('logout') ?>">Logout</a>
      <?php else : ?>
        <a type="button" class="d-flex btn btn-outline-light mx-3" href="<?= base_url('login') ?>">Login</a>
      <?php endif; ?>
    </div>
  </div>
</nav>