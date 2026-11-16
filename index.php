<?php
// index.php
require_once "Database.php";
require_once "Produk.php";
$db = new Database(); // ambil kunci
$produk = new Produk($db->getConnection()); // beri kunci ke petugas
$data = $produk->semua(); // minta data
?>
<h2>Koperasi Sekolah</h2>
<a href="tambah.php">+ Tambah Produk</a>
<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($data as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['nama']) ?></td>
            <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
            <td><?= $p['stok'] ?></td>
            <td>
                <a href="edit.php?id=<?= $p['id'] ?>">Edit</a> |
                <a href="hapus.php?id=<?= $p['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>