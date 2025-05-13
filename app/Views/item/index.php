<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Barang Laboratorium</h6>
        <div>
            <a href="<?= base_url('/items/create') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Tambah Barang
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

        <form method="GET" action="<?= base_url('/items') ?>" class="row g-3 mb-4">
    <div class="col-md-3">
        <input type="text" name="keyword" class="form-control" placeholder="Cari nama, kode, atau spesifikasi" value="<?= esc($_GET['keyword'] ?? '') ?>">
    </div>
    <div class="col-md-2">
        <select name="category_id" class="form-select">
            <option value="">Semua Kategori</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= isset($_GET['category_id']) && $_GET['category_id'] == $cat['id'] ? 'selected' : '' ?>>
                    <?= esc($cat['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-2">
        <select name="item_type_id" class="form-select">
            <option value="">Semua Tipe</option>
            <?php foreach ($itemTypes as $type): ?>
                <option value="<?= $type['id'] ?>" <?= isset($_GET['item_type_id']) && $_GET['item_type_id'] == $type['id'] ? 'selected' : '' ?>>
                    <?= esc($type['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-2">
        <select name="power_type_id" class="form-select">
            <option value="">Semua Jenis Daya</option>
            <?php foreach ($powerTypes as $power): ?>
                <option value="<?= $power['id'] ?>" <?= isset($_GET['power_type_id']) && $_GET['power_type_id'] == $power['id'] ? 'selected' : '' ?>>
                    <?= esc($power['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-2">
        <select name="item_kind_id" class="form-select">
            <option value="">Semua Jenis Barang</option>
            <?php foreach ($itemKinds as $kind): ?>
                <option value="<?= $kind['id'] ?>" <?= isset($_GET['item_kind_id']) && $_GET['item_kind_id'] == $kind['id'] ? 'selected' : '' ?>>
                    <?= esc($kind['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-1">
        <button type="submit" class="btn btn-primary w-100">Cari</button>
    </div>
</form>


        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="table-primary">
                    <tr>
                        <th width="5%">No</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $item['code'] ?></td>
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['category_name'] ?></td>
                        <td>
                            <span class="badge bg-<?= $item['stock'] > 0 ? 'success' : 'danger' ?>">
                                <?= $item['stock'] ?>
                            </span>
                        </td>
                        <td><?= $item['unit_name'] ?></td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="<?= base_url('/items/detail/' . $item['id']) ?>" class="btn btn-info btn-sm" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?= base_url('/items/edit/' . $item['id']) ?>" class="btn btn-warning btn-sm" title="Edit">
                                <i class="bi bi-pencil"></i>
                                </a>
                                <a href="<?= base_url('/items/delete/' . $item['id']) ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus ini?')">
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
            columnDefs: [
                { orderable: false, targets: [0, 6] }
            ],
            order: [[1, 'asc']]
        });
    });
</script>
<?= $this->endSection() ?>