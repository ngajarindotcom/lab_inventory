<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Tipe Barang</h6>
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

        <form action="<?= base_url('/item-types/update/' . $itemType['id']) ?>" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Tipe <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= old('name', $itemType['name']) ?>" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= old('description', $itemType['description']) ?></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('/item-types') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>