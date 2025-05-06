<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Stok Opname</h6>
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

        <form action="<?= base_url('/stock-opname/update/' . $stockOpname['id']) ?>" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="date" class="form-label">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="date" name="date" value="<?= old('date', $stockOpname['date']) ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Barang</label>
                        <input type="text" class="form-control" value="<?= $stockOpname['item_code'] ?> - <?= $stockOpname['item_name'] ?>" readonly>
                        <input type="hidden" name="item_id" value="<?= $stockOpname['item_id'] ?>">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Stok Sistem</label>
                        <input type="text" class="form-control" value="<?= $stockOpname['stock_system'] ?>" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label for="stock_actual" class="form-label">Stok Fisik <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="stock_actual" name="stock_actual" value="<?= old('stock_actual', $stockOpname['stock_actual']) ?>" min="0" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="note" class="form-label">Catatan</label>
                <textarea class="form-control" id="note" name="note" rows="3"><?= old('note', $stockOpname['note']) ?></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('/stock-opname') ?>" class="btn btn-secondary">
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