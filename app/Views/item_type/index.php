<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Tipe Barang</h6>
        <a href="<?= base_url('/item-types/create') ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah Tipe
        </a>
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
                        <th>Nama Tipe</th>
                        <th>Deskripsi</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($itemTypes as $index => $itemType): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $itemType['name'] ?></td>
                        <td><?= $itemType['description'] ?? '-' ?></td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="<?= base_url('/item-types/edit/' . $itemType['id']) ?>" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= base_url('/item-types/delete/' . $itemType['id']) ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus tipe barang ini?')">
                                    <i class="fas fa-trash"></i>
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
            columnDefs: [
                { orderable: false, targets: [0, 3] }
            ],
            order: [[1, 'asc']]
        });
    });
</script>
<?= $this->endSection() ?>