<!DOCTYPE html>
<html>
<head>
    <title>Laporan Barang Keluar</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; }
        .period { font-size: 14px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; }
        th { background-color: #f2f2f2; text-align: center; }
        .footer { margin-top: 20px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">LAPORAN BARANG KELUAR</div>
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
                <th width="10%">Jumlah</th>
                <th width="15%">Penerima</th>
                <th width="20%">Catatan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itemOuts as $index => $itemOut): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= date('d/m/Y', strtotime($itemOut['date'])) ?></td>
                <td><?= $itemOut['item_code'] ?></td>
                <td><?= $itemOut['item_name'] ?></td>
                <td><?= $itemOut['quantity'] ?></td>
                <td><?= $itemOut['recipient'] ?></td>
                <td><?= $itemOut['note'] ?? '-' ?></td>
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