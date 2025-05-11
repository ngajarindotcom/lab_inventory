<?= $this->extend('layouts/blank') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center mt-5">
    <div class="col-md-6 text-center mb-6">
        <!-- Logo -->
        <img src="<?= base_url('assets/images/pkcblogo.png') ?>" alt="Logo Lab Asset" style="max-width: 300px;">

        <!-- Headline -->
        <h3 class="mt-3">Aplikasi Asset Management</h3>
        <p class="text-muted">Silakan login untuk melanjutkan</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card">
            
            <div class="card-body">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('/auth/attemptLogin') ?>" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
