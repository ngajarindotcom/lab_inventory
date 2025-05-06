<!DOCTYPE html>
<html>
<head>
    <title>Laporan Stok Opname</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; }
        .period { font-size: 14px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; }
        th { background-color: #f2f2f2; text-align: center; }
        .negative { color: red; }
        .positive { color: green; }
        .footer { margin-top: 20px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">LAPORAN STOK OPNAME</div>
        <div class="period">
            <?php if ($startDate && $endDate): ?>
                Periode: <?= date('d/m/Y', strtotime($startDate)) ?> - <?= date('d/m/Y', strtotime($endDate)) ?>
            <?php else: ?>
                Semua Data
            <?php endif; ?>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tanggal</th>
                <th width="15%">Kode Barang</th>
                <th width="20%">Nama Barang</th>
                <th width="10%">Stok Sistem</th>
                <th width="10%">Stok Fisik</th>
                <th width="10%">Selisih</th>
                <th width="15%">Catatan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stockOpnames as $index => $opname): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= date('d/m/Y', strtotime($opname['date'])) ?></td>
                <td><?= $opname['item_code'] ?></td>
                <td><?= $opname['item_name'] ?></td>
                <td><?= $opname['stock_system'] ?></td>
                <td><?= $opname['stock_actual'] ?></td>
                <td class="<?= $opname['difference'] < 0 ? 'negative' : ($opname['difference'] > 0 ? 'positive' : '') ?>">
                    <?= $opname['difference'] ?>
                </td>
                <td><?= $opname['note'] ?? '-' ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">
        <div>Dicetak pada: <?= date('d/m/Y H:i:s') ?></div>
        <div>Oleh: <?= session()->get('name') ?></div>
    </div>
</body>
</html>