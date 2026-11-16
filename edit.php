<?php
// edit.php
require_once "Database.php";
require_once "Produk.php";

$db = new Database();
$produk = new Produk($db->getConnection());

// Pastikan ada parameter id di URL
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$data = $produk->cari($id); // Ambil data lama berdasarkan id

// Jika data tidak ditemukan, kembalikan ke index.php
if (!$data) {
    header("Location: index.php");
    exit;
}

// Proses saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    if ($produk->ubah($id, $nama, $harga, $stok)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal mengubah data produk.";
    }
}
?>

<h2>Edit Produk</h2>
<form method="POST">
    <p>
        <label>Nama Produk:</label><br>
        <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>
    </p>
    <p>
        <label>Harga:</label><br>
        <input type="number" name="harga" value="<?= $data['harga'] ?>" required>
    </p>
    <p>
        <label>Stok:</label><br>
        <input type="number" name="stok" value="<?= $data['stok'] ?>" required>
    </p>
    <button type="submit">Simpan Perubahan</button>
    <a href="index.php">Batal</a>
</form>