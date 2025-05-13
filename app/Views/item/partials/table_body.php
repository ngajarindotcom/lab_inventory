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