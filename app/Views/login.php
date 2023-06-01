<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<body>
  <div class="container position-absolute top-50 start-50 translate-middle shadow">
    <div class="row justify-content-center" style="background-color: #FFE69C;">
      <div class="col-md-6 image">
        <img src="/bus.jpg" alt="bus" class="img-fluid">
      </div>
      <div class=" col-md-6">
        <form action="<?= base_url('login') ?>" method="POST">
          <h1 class="text-center my-5">Login</h1>
          <?php if (isset($success)) : ?>
            <div class="alert alert-<?php echo $success ? "success" : "danger" ?> " role="alert">
              <?php echo $message ?>
            </div>
          <?php endif; ?>
          <div class=" mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="">
          </div>
          <p>Do not have any account?
            <a href="<?= base_url('register') ?>">Register</a>
          </p>
          <div class="d-flex flex-row-reverse mx-3 my-5">
            <button class="btn btn-primary btn-lg" type="submit">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- SCRIPTS -->

  <script>
    function toggleMenu() {
      var menuItems = document.getElementsByClassName('menu-item');
      for (var i = 0; i < menuItems.length; i++) {
        var menuItem = menuItems[i];
        menuItem.classList.toggle("hidden");
      }
    }
  </script>
  <?= $this->endSection() ?>