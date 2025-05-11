<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Detail Barang</h6>
        <a href="<?= base_url('/items') ?>" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Kode Barang</th>
                            <td><?= $item['code'] ?></td>
                        </tr>
                        <tr>
                            <th>Nama Barang</th>
                            <td><?= $item['name'] ?></td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td><?= $item['category_name'] ?></td>
                        </tr>
                        <tr>
                            <th>Tipe Barang</th>
                            <td><?= $item['item_type_name'] ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Daya</th>
                            <td><?= $item['power_type_name'] ?? '-' ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Barang</th>
                            <td><?= $item['item_kind_name'] ?? '-' ?></td>
                        </tr>
                        <tr>
                            <th>Merek</th>
                            <td><?= $item['brand'] ?? '-' ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Stok Tersedia</th>
                            <td>
                                <span class="badge bg-<?= $item['stock'] > 0 ? 'success' : 'danger' ?>">
                                    <?= $item['stock'] ?> <?= $item['unit_name'] ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Satuan</th>
                            <td><?= $item['unit_name'] ?> (<?= $item['symbol'] ?>)</td>
                        </tr>
                        <tr>
                            <th>Spesifikasi</th>
                            <td><?= $item['specification'] ?? '-' ?></td>
                        </tr>
                        <tr>
                            <th>Dibuat Pada</th>
                            <td><?= date('d/m/Y H:i', strtotime($item['created_at'])) ?></td>
                        </tr>
                        <tr>
                            <th>Diupdate Pada</th>
                            <td><?= date('d/m/Y H:i', strtotime($item['updated_at'])) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Keterangan</h6>
                    </div>
                    <div class="card-body">
                        <?= $item['note'] ? nl2br($item['note']) : '-' ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-end">
            <a href="<?= base_url('/items/edit/' . $item['id']) ?>" class="btn btn-warning me-2">
                <i class="fas fa-edit me-1"></i> Edit
            </a>
            <a href="<?= base_url('/items') ?>" class="btn btn-secondary">
                <i class="fas fa-list me-1"></i> Daftar Barang
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>