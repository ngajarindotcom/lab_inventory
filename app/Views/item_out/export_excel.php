<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Barang_Keluar.xls");
?>

<table border="1">
    <tr>
        <th colspan="7" style="text-align: center; font-size: 16px;">LAPORAN BARANG KELUAR</th>
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
        <th>Penerima</th>
        <th>Catatan</th>
    </tr>
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
    <tr>
        <td colspan="7" style="text-align: right;">
            Dicetak pada: <?= date('d/m/Y H:i:s') ?> oleh <?= session()->get('name') ?>
        </td>
    </tr>
</table>