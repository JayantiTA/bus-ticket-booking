<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<body>
  <img src="/bus3.jpg" alt="bus" class="img-fluid top-50 start-50 translate-middle position-absolute" style="min-width: 100vw; max-height: 100vh; opacity: 0.6;">
  <?= $this->include('navbar') ?>

  <div class="top-50 start-50 translate-middle position-absolute container-sm d-flex align-items-center justify-content-center shadow p-3" style="max-width: 500px; background-color: #F8F9FA; border-radius: 15px;">
    <div class="row text-center">
      <div class="align-items-center">
        <h3>Contact WhatsApp</h3>
        <h5>+62 812-3456-7890</h5>
        <form action="<?= base_url('contact') ?>" method="POST">
          <button type="submit" class="btn btn-primary my-3">Send Message</button>
        </form>
      </div>
    </div>
  </div>

  <!-- SCRIPTS -->

  <?= $this->endSection() ?>