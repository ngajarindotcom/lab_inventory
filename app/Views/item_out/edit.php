<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Barang Keluar</h6>
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

        <form action="<?= base_url('/item-out/update/' . $itemOut['id']) ?>" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="date" class="form-label">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="date" name="date" value="<?= old('date', $itemOut['date']) ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Barang</label>
                        <input type="text" class="form-control" value="<?= $itemOut['item_code'] ?> - <?= $itemOut['item_name'] ?>" readonly>
                        <input type="hidden" name="item_id" value="<?= $itemOut['item_id'] ?>">
                        <div class="form-text">Stok saat ini: <?= $currentStock ?></div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="<?= old('quantity', $itemOut['quantity']) ?>" min="1" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="recipient" class="form-label">Penerima <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="recipient" name="recipient" value="<?= old('recipient', $itemOut['recipient']) ?>" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="note" class="form-label">Catatan</label>
                <textarea class="form-control" id="note" name="note" rows="2"><?= old('note', $itemOut['note']) ?></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('/item-out') ?>" class="btn btn-secondary">
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