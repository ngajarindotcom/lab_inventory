<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah User Baru</h6>
    </div>
    <div class="card-body">
        <?php if (isset($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/users/store') ?>" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="staff" selected>Staff</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('/users') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>