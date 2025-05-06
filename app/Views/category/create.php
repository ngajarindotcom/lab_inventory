<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Kategori Baru</h6>
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

        <form action="<?= base_url('/categories/store') ?>" method="post">
            <div class="form-group">
                <label for="name">Nama Kategori</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('/categories') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>