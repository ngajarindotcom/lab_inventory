<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
        <a href="<?= base_url('/users/create') ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah User
        </a>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-<?= session()->getFlashdata('type') ?>">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $index => $user): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td>
                            <span class="badge bg-<?= 
                                $user['role'] == 'admin' ? 'danger' : 
                                ($user['role'] == 'manager' ? 'warning' : 'primary') 
                            ?>">
                                <?= ucfirst($user['role']) ?>
                            </span>
                        </td>
                        <td>
                            <a href="<?= base_url('/users/edit/' . $user['id']) ?>" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="<?= base_url('/users/delete/' . $user['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
<?= $this->endSection() ?>