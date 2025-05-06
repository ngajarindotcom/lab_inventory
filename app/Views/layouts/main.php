<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Lab Asset Management' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #212529;
            color: white;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.75);
        }
        .sidebar .nav-link:hover {
            color: rgba(255, 255, 255, 1);
        }
        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .main-content {
            padding: 20px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .form-group {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <a href="<?= base_url('/dashboard') ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none px-3">
                        <span class="fs-4">Lab Asset</span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="<?= base_url('/dashboard') ?>" class="nav-link <?= uri_string() == 'dashboard' ? 'active' : '' ?>">
                                <i class="bi bi-speedometer2 me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <?php if (session()->get('role') == 'admin'): ?>
                        <li>
                            <a href="<?= base_url('/users') ?>" class="nav-link <?= strpos(uri_string(), 'users') !== false ? 'active' : '' ?>">
                                <i class="bi bi-people me-2"></i>
                                Users
                            </a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <a href="<?= base_url('/categories') ?>" class="nav-link <?= strpos(uri_string(), 'categories') !== false ? 'active' : '' ?>">
                                <i class="bi bi-tags me-2"></i>
                                Kategori
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('/item-types') ?>" class="nav-link <?= strpos(uri_string(), 'item-types') !== false ? 'active' : '' ?>">
                                <i class="bi bi-grid me-2"></i>
                                Tipe Barang
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('/power-types') ?>" class="nav-link <?= strpos(uri_string(), 'power-types') !== false ? 'active' : '' ?>">
                                <i class="bi bi-lightning-charge me-2"></i>
                                Jenis Daya
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('/item-kinds') ?>" class="nav-link <?= strpos(uri_string(), 'item-kinds') !== false ? 'active' : '' ?>">
                                <i class="bi bi-box-seam me-2"></i>
                                Jenis Barang
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('/units') ?>" class="nav-link <?= strpos(uri_string(), 'units') !== false ? 'active' : '' ?>">
                                <i class="bi bi-rulers me-2"></i>
                                Satuan
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('/items') ?>" class="nav-link <?= strpos(uri_string(), 'items') !== false ? 'active' : '' ?>">
                                <i class="bi bi-boxes me-2"></i>
                                Barang
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('/item-in') ?>" class="nav-link <?= strpos(uri_string(), 'item-in') !== false ? 'active' : '' ?>">
                                <i class="bi bi-box-arrow-in-down me-2"></i>
                                Barang Masuk
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('/item-out') ?>" class="nav-link <?= strpos(uri_string(), 'item-out') !== false ? 'active' : '' ?>">
                                <i class="bi bi-box-arrow-up me-2"></i>
                                Barang Keluar
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('/stock-opname') ?>" class="nav-link <?= strpos(uri_string(), 'stock-opname') !== false ? 'active' : '' ?>">
                                <i class="bi bi-clipboard-check me-2"></i>
                                Stok Opname
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown px-3">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-2"></i>
                            <strong><?= session()->get('name') ?></strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= base_url('/logout') ?>">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>