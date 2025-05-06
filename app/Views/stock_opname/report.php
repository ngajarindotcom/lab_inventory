<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Laporan Stok Opname</h6>
        <div>
            <a href="<?= base_url('/stock-opname/export-pdf?' . $_SERVER['QUERY_STRING']) ?>" class="btn btn-danger btn-sm me-2" target="_blank">
                <i class="fas fa-file-pdf me-1"></i> PDF
            </a>
            <a href="<?= base_url('/stock-opname/export-excel?' . $_SERVER['QUERY_STRING']) ?>" class="btn btn-success btn-sm" target="_blank">
                <i class="fas fa-file-excel me-1"></i> Excel
            </a>
        </div>
    </div>
    <div class="card-body">
        <form method="get" action="<?= base_url('/stock-opname/report') ?>" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Dari Tanggal</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="<?= $startDate ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Sampai Tanggal</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="<?= $endDate ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="item_id" class="form-label">Filter Barang</label>
                        <select class="form-select" id="item_id" name="item_id">
                            <option value="">Semua Barang</option>
                            <?php foreach ($items as $item): ?>
                                <option value="<?= $item['id'] ?>" <?= $itemId == $item['id'] ? 'selected' : '' ?>>
                                    <?= $item['code'] ?> - <?= $item['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <a href="<?= base_url('/stock-opname/report') ?>" class="btn btn-secondary">
                        Reset
                    </a>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Stok Sistem</th>
                        <th>Stok Fisik</th>
                        <th>Selisih</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($stockOpnames)): ?>
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($stockOpnames as $index => $opname): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= date('d/m/Y', strtotime($opname['date'])) ?></td>
                            <td><?= $opname['item_code'] ?></td>
                            <td><?= $opname['item_name'] ?></td>
                            <td><?= $opname['stock_system'] ?></td>
                            <td><?= $opname['stock_actual'] ?></td>
                            <td class="<?= $opname['difference'] < 0 ? 'text-danger' : ($opname['difference'] > 0 ? 'text-success' : '') ?>">
                                <?= $opname['difference'] ?>
                            </td>
                            <td><?= $opname['note'] ?? '-' ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>