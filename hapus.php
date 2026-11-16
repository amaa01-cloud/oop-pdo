<?php
// hapus.php
require_once "Database.php";
require_once "Produk.php";

$db = new Database();
$produk = new Produk($db->getConnection());

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $produk->hapus($id);
}

// Kembali ke halaman utama setelah menghapus
header("Location: index.php");
exit;