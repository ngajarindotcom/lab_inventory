<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Jenis Barang Baru</h6>
    </div>
    <div class="card-body">
        <?php if (isset($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/item-kinds/store') ?>" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Jenis Barang <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" required>
                        <div class="form-text">Contoh: Alat Ukur, Bahan Habis Pakai, dll</div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= old('description') ?></textarea>
                <div class="form-text">Tambahkan deskripsi jika diperlukan</div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('/item-kinds') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#name').focus();
    });
</script>
<?= $this->endSection() ?>