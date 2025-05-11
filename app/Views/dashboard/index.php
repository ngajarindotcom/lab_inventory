<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <div class="row">
        <!-- Total Items Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalItems ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-box-seam fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Item In Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Barang Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalItemIn ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-box-arrow-in-down fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Item Out Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Barang Keluar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalItemOut ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-box-arrow-up fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stock Opname Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Stok Opname</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalStockOpname ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-clipboard-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Items -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Barang Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <?php foreach ($recentItems as $item): ?>
                        <a href="<?= base_url('/items/detail/' . $item['id']) ?>" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1"><?= $item['name'] ?></h6>
                                <small><?= date('d M Y', strtotime($item['created_at'])) ?></small>
                            </div>
                            <p class="mb-1"><?= $item['code'] ?></p>
                            <small>Stok: <?= $item['stock'] ?></small>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Item In -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-success">Barang Masuk Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <?php foreach ($recentItemIn as $itemIn): ?>
                        <a href="<?= base_url('/items/detail/' . $item['id']) ?>" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">
                                    <?= isset($itemIn['item_name']) ? $itemIn['item_name'] : 'Nama tidak tersedia' ?>
                                </h6>
                                <small><?= date('d M Y', strtotime($itemIn['date'])) ?></small>
                            </div>
                            <p class="mb-1">Kode: <?= $itemIn['item_code'] ?></p>
                            <small>Qty: <?= $itemIn['quantity'] ?></small>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Item Out -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-info">Barang Keluar Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <?php foreach ($recentItemOut as $itemOut): ?>
                        <a href="<?= base_url('/items/detail/' . $item['id']) ?>" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1"><?= $itemOut['item_name'] ?></h6>
                                <small><?= date('d M Y', strtotime($itemOut['date'])) ?></small>
                            </div>
                            <p class="mb-1">Kode: <?= $itemOut['item_code'] ?></p>
                            <small>Qty: <?= $itemOut['quantity'] ?></small>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>