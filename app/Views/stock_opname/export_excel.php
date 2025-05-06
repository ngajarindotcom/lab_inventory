<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Stok_Opname.xls");
?>

<table border="1">
    <tr>
        <th colspan="8" style="text-align: center; font-size: 16px;">LAPORAN STOK OPNAME</th>
    </tr>
    <tr>
        <th colspan="8">
            <?php if ($startDate && $endDate): ?>
                Periode: <?= date('d/m/Y', strtotime($startDate)) ?> - <?= date('d/m/Y', strtotime($endDate)) ?>
            <?php else: ?>
                Semua Data
            <?php endif; ?>
        </th>
    </tr>
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
    <?php foreach ($stockOpnames as $index => $opname): ?>
    <tr>
        <td><?= $index + 1 ?></td>
        <td><?= date('d/m/Y', strtotime($opname['date'])) ?></td>
        <td><?= $opname['item_code'] ?></td>
        <td><?= $opname['item_name'] ?></td>
        <td><?= $opname['stock_system'] ?></td>
        <td><?= $opname['stock_actual'] ?></td>
        <td style="color: <?= $opname['difference'] < 0 ? 'red' : ($opname['difference'] > 0 ? 'green' : 'black') ?>">
            <?= $opname['difference'] ?>
        </td>
        <td><?= $opname['note'] ?? '-' ?></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="8" style="text-align: right;">
            Dicetak pada: <?= date('d/m/Y H:i:s') ?> oleh <?= session()->get('name') ?>
        </td>
    </tr>
</table>