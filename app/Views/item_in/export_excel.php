<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Barang_Masuk.xls");
?>

<table border="1">
    <tr>
        <th colspan="7" style="text-align: center; font-size: 16px;">LAPORAN BARANG MASUK</th>
    </tr>
    <tr>
        <th colspan="7">
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
        <th>Jumlah</th>
        <th>Catatan</th>
        <th>Input Oleh</th>
    </tr>
    <?php foreach ($itemIns as $index => $itemIn): ?>
    <tr>
        <td><?= $index + 1 ?></td>
        <td><?= date('d/m/Y', strtotime($itemIn['date'])) ?></td>
        <td><?= $itemIn['item_code'] ?></td>
        <td><?= $itemIn['item_name'] ?></td>
        <td><?= $itemIn['quantity'] ?></td>
        <td><?= $itemIn['note'] ?? '-' ?></td>
        <td><?= $itemIn['created_by_name'] ?></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="7" style="text-align: right;">
            Dicetak pada: <?= date('d/m/Y H:i:s') ?> oleh <?= session()->get('name') ?>
        </td>
    </tr>
</table>