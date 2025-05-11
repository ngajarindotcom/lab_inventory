<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Barang Masuk</h6>
        <div>
            <a href="<?= base_url('/item-in/create') ?>" class="btn btn-primary btn-sm me-2">
                <i class="fas fa-plus me-1"></i> Tambah Barang Masuk
            </a>
            <a href="<?= base_url('/item-in/report') ?>" class="btn btn-info btn-sm">
                <i class="fas fa-file-alt me-1"></i> Laporan
            </a>
        </div>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-<?= session()->getFlashdata('type') ?> alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('message') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="table-primary">
                    <tr>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Catatan</th>
                        <th>Input Oleh</th>
                        <th width="12%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($itemIns as $index => $itemIn): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= date('d/m/Y', strtotime($itemIn['date'])) ?></td>
                        <td><?= $itemIn['item_code'] ?></td>
                        <td><?= $itemIn['item_name'] ?></td>
                        <td><?= $itemIn['quantity'] ?></td>
                        <td><?= $itemIn['note'] ?? '-' ?></td>
                        <td><?= $itemIn['created_by_name'] ?></td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="<?= base_url('/item-in/edit/' . $itemIn['id']) ?>" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="<?= base_url('/item-in/delete/' . $itemIn['id']) ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            responsive: true,
            order: [[1, 'desc']],
            columnDefs: [
                { orderable: false, targets: [0, 7] }
            ]
        });
    });
</script>
<?= $this->endSection() ?>