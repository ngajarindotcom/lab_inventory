<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Stok Opname</h6>
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

        <form action="<?= base_url('/stock-opname/store') ?>" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="date" class="form-label">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="date" name="date" value="<?= old('date', date('Y-m-d')) ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="item_id" class="form-label">Barang <span class="text-danger">*</span></label>
                        <select class="form-select" id="item_id" name="item_id" required>
                            <option value="">Pilih Barang</option>
                            <?php foreach ($items as $item): ?>
                                <option value="<?= $item['id'] ?>" <?= old('item_id') == $item['id'] ? 'selected' : '' ?> data-stock="<?= $item['stock'] ?>">
                                    <?= $item['code'] ?> - <?= $item['name'] ?> (Stok: <?= $item['stock'] ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Stok Sistem</label>
                        <input type="text" class="form-control" id="stock_system" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label for="stock_actual" class="form-label">Stok Fisik <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="stock_actual" name="stock_actual" value="<?= old('stock_actual') ?>" min="0" required>
                        <div class="form-text">Masukkan jumlah stok yang terhitung secara fisik</div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="note" class="form-label">Catatan</label>
                <textarea class="form-control" id="note" name="note" rows="3"><?= old('note') ?></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('/stock-opname') ?>" class="btn btn-secondary">
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
        $('#date').focus();
        
        // Update stock system when item changes
        $('#item_id').change(function() {
            const selectedOption = $(this).find('option:selected');
            const stock = selectedOption.data('stock') || 0;
            $('#stock_system').val(stock);
        }).trigger('change');
    });
</script>
<?= $this->endSection() ?>