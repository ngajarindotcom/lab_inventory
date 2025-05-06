<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Barang</h6>
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

        <form action="<?= base_url('/items/store') ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="code" class="form-label">Kode Barang <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="code" name="code" value="<?= old('code') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>" <?= old('category_id') == $category['id'] ? 'selected' : '' ?>>
                                    <?= $category['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="item_type_id" class="form-label">Tipe Barang <span class="text-danger">*</span></label>
                        <select class="form-select" id="item_type_id" name="item_type_id" required>
                            <option value="">Pilih Tipe Barang</option>
                            <?php foreach ($itemTypes as $itemType): ?>
                                <option value="<?= $itemType['id'] ?>" <?= old('item_type_id') == $itemType['id'] ? 'selected' : '' ?>>
                                    <?= $itemType['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="power_type_id" class="form-label">Jenis Daya</label>
                        <select class="form-select" id="power_type_id" name="power_type_id">
                            <option value="">Pilih Jenis Daya</option>
                            <?php foreach ($powerTypes as $powerType): ?>
                                <option value="<?= $powerType['id'] ?>" <?= old('power_type_id') == $powerType['id'] ? 'selected' : '' ?>>
                                    <?= $powerType['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="item_kind_id" class="form-label">Jenis Barang</label>
                        <select class="form-select" id="item_kind_id" name="item_kind_id">
                            <option value="">Pilih Jenis Barang</option>
                            <?php foreach ($itemKinds as $itemKind): ?>
                                <option value="<?= $itemKind['id'] ?>" <?= old('item_kind_id') == $itemKind['id'] ? 'selected' : '' ?>>
                                    <?= $itemKind['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="unit_id" class="form-label">Satuan <span class="text-danger">*</span></label>
                        <select class="form-select" id="unit_id" name="unit_id" required>
                            <option value="">Pilih Satuan</option>
                            <?php foreach ($units as $unit): ?>
                                <option value="<?= $unit['id'] ?>" <?= old('unit_id') == $unit['id'] ? 'selected' : '' ?>>
                                    <?= $unit['name'] ?> (<?= $unit['symbol'] ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stok Awal <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="stock" name="stock" value="<?= old('stock', 0) ?>" min="0" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="brand" class="form-label">Merek</label>
                        <input type="text" class="form-control" id="brand" name="brand" value="<?= old('brand') ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="specification" class="form-label">Spesifikasi</label>
                        <input type="text" class="form-control" id="specification" name="specification" value="<?= old('specification') ?>">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="note" class="form-label">Keterangan</label>
                <textarea class="form-control" id="note" name="note" rows="3"><?= old('note') ?></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('/items') ?>" class="btn btn-secondary">
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
        // Auto generate code if empty
        $('#code').on('blur', function() {
            if ($(this).val() === '') {
                // Generate simple code based on timestamp
                const timestamp = Date.now().toString().slice(-6);
                $(this).val('BRG-' + timestamp);
            }
        });
    });
</script>
<?= $this->endSection() ?>