<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Satuan</h6>
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

        <form action="<?= base_url('/units/update/' . $unit['id']) ?>" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Satuan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= old('name', $unit['name']) ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="symbol" class="form-label">Simbol <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="symbol" name="symbol" value="<?= old('symbol', $unit['symbol']) ?>" required maxlength="5">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('/units') ?>" class="btn btn-secondary">
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

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#name').focus();
    });
</script>
<?= $this->endSection() ?>