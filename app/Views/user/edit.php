<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
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

        <form action="<?= base_url('/users/update/' . $user['id']) ?>" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" required>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="manager" <?= $user['role'] == 'manager' ? 'selected' : '' ?>>Manager</option>
                    <option value="staff" <?= $user['role'] == 'staff' ? 'selected' : '' ?>>Staff</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= base_url('/users') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>